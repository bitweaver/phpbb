<?php
/***************************************************************************
 *                                sessions.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id$
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Adds/updates a new session to the database for the given userid.
// Returns the new session ID on success.
//
function session_begin($user_id, $user_ip, $page_id, $auto_create = 0, $enable_autologin = 0, $admin = 0)
{
	global $db, $board_config;
	global $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $SID;

	$cookiename = $board_config['cookie_name'];
	$cookiepath = $board_config['cookie_path'];
	$cookiedomain = $board_config['cookie_domain'];
	$cookiesecure = $board_config['cookie_secure'];

	if ( isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) || isset($HTTP_COOKIE_VARS[$cookiename . '_data']) )
	{
		$session_id = isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) ? $HTTP_COOKIE_VARS[$cookiename . '_sid'] : '';
		$sessiondata = isset($HTTP_COOKIE_VARS[$cookiename . '_data']) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$cookiename . '_data'])) : array();
		$sessionmethod = SESSION_METHOD_COOKIE;
	}
	else
	{
		$sessiondata = array();
		$session_id = ( isset($HTTP_GET_VARS['sid']) ) ? $HTTP_GET_VARS['sid'] : '';
		$sessionmethod = SESSION_METHOD_GET;
	}

	//
	if (!preg_match('/^[A-Za-z0-9]*$/', $session_id)) 
	{
		$session_id = '';
	}

	$page_id = (int) $page_id;

	$last_visit = 0;
	$current_time = time();

	//
	// Are auto-logins allowed?
	// If allow_autologin is not set or is true then they are
	// (same behaviour as old 2.0.x session code)
	//
	if (isset($board_config['allow_autologin']) && !$board_config['allow_autologin'])
	{
		$enable_autologin = $sessiondata['autologinid'] = false;
	}

	// 
	// First off attempt to join with the autologin value if we have one
	// If not, just use the user_id value
	//
	$userdata = array();

	if ($user_id != ANONYMOUS)
	{
		// {{{ BIT_MOD
		// we always force auto login
		$auto_create = FALSE;
		// }}} BIT_MOD

		if (isset($sessiondata['autologinid']) && (string) $sessiondata['autologinid'] != '' && $user_id)
		{
			$sql = 'SELECT u.* 
				FROM ' . USERS_TABLE . ' u, ' . SESSIONS_KEYS_TABLE . ' k
				WHERE u.user_id = ' . (int) $user_id . "
					AND u.user_active = 1
					AND k.user_id = u.user_id
					AND k.key_id = '" . md5($sessiondata['autologinid']) . "'";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
			}

			$userdata = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		
			$enable_autologin = $login = 1;
		}
		else if (!$auto_create)
		{
			$sessiondata['autologinid'] = '';
			$sessiondata['userid'] = $user_id;

			$sql = 'SELECT *
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $user_id . '
					AND user_active = 1';
			if (!($result = $db->sql_query($sql)))
			{
				message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
			}

			$userdata = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			$login = 1;
		}
	}

	//
	// At this point either $userdata should be populated or
	// one of the below is true
	// * Key didn't match one in the DB
	// * User does not exist
	// * User is inactive
	//
	if (!sizeof($userdata) || !is_array($userdata) || !$userdata)
	{
		$sessiondata['autologinid'] = '';
		$sessiondata['userid'] = $user_id = ANONYMOUS;
		$enable_autologin = $login = 0;

		$sql = 'SELECT *
			FROM ' . USERS_TABLE . '
			WHERE user_id = ' . (int) $user_id;
		if (!($result = $db->sql_query($sql)))
		{
			message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
		}

		$userdata = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}


	//
	// Initial ban check against user id, IP and email address
	//
	preg_match('/(..)(..)(..)(..)/', $user_ip, $user_ip_parts);

	$sql = "SELECT ban_ip, ban_userid, ban_email 
		FROM " . BANLIST_TABLE . " 
		WHERE ban_ip IN ('" . $user_ip_parts[1] . $user_ip_parts[2] . $user_ip_parts[3] . $user_ip_parts[4] . "', '" . $user_ip_parts[1] . $user_ip_parts[2] . $user_ip_parts[3] . "ff', '" . $user_ip_parts[1] . $user_ip_parts[2] . "ffff', '" . $user_ip_parts[1] . "ffffff')
			OR ban_userid = $user_id";
	if ( $user_id != ANONYMOUS )
	{
		$sql .= " OR ban_email LIKE '" . str_replace("\'", "''", $userdata['user_email']) . "' 
			OR ban_email LIKE '" . substr(str_replace("\'", "''", $userdata['user_email']), strpos(str_replace("\'", "''", $userdata['user_email']), "@")) . "'";
	}
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not obtain ban information', '', __LINE__, __FILE__, $sql);
	}

	if ( $ban_info = $db->sql_fetchrow($result) )
	{
		if ( $ban_info['ban_ip'] || $ban_info['ban_userid'] || $ban_info['ban_email'] )
		{
			message_die(CRITICAL_MESSAGE, 'You_been_banned');
		}
	}

	//
	// Create or update the session
	//
	$sql = "UPDATE " . SESSIONS_TABLE . "
		SET session_user_id = $user_id, session_start = $current_time, session_time = $current_time, session_page = $page_id, session_logged_in = $login, session_admin = $admin
		WHERE session_id = '" . $session_id . "' 
			AND session_ip = '$user_ip'";
	if ( !$db->sql_query($sql) || !$db->sql_affectedrows() )
	{
		$session_id = md5(dss_rand());

		$sql = "INSERT INTO " . SESSIONS_TABLE . "
			(session_id, session_user_id, session_start, session_time, session_ip, session_page, session_logged_in, session_admin)
			VALUES ('$session_id', $user_id, $current_time, $current_time, '$user_ip', $page_id, $login, $admin)";
		if ( !$db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, 'Error creating new session', '', __LINE__, __FILE__, $sql);
		}
	}

	if ( $user_id != ANONYMOUS )
	{
		$last_visit = ( $userdata['user_session_time'] > 0 ) ? $userdata['user_session_time'] : $current_time; 

		if (!$admin)
		{
			$sql = "UPDATE " . USERS_TABLE . " 
				SET user_session_time = $current_time, user_session_page = $page_id, user_lastvisit = $last_visit
				WHERE user_id = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(CRITICAL_ERROR, 'Error updating last visit time', '', __LINE__, __FILE__, $sql);
			}
		}

		$userdata['user_lastvisit'] = $last_visit;

		//
		// Regenerate the auto-login key
		//
		if ($enable_autologin)
		{
			$auto_login_key = dss_rand() . dss_rand();
			
			if (isset($sessiondata['autologinid']) && (string) $sessiondata['autologinid'] != '')
			{
				$sql = 'UPDATE ' . SESSIONS_KEYS_TABLE . "
					SET last_ip = '$user_ip', key_id = '" . md5($auto_login_key) . "', last_login = $current_time
					WHERE key_id = '" . md5($sessiondata['autologinid']) . "'";
			}
			else
			{
				$sql = 'INSERT INTO ' . SESSIONS_KEYS_TABLE . "(key_id, user_id, last_ip, last_login)
					VALUES ('" . md5($auto_login_key) . "', $user_id, '$user_ip', $current_time)";
			}

			if ( !$db->sql_query($sql) )
			{
				message_die(CRITICAL_ERROR, 'Error updating session key', '', __LINE__, __FILE__, $sql);
			}
			
			$sessiondata['autologinid'] = $auto_login_key;
			unset($auto_login_key);
		}
		else
		{
			$sessiondata['autologinid'] = '';
		}

//		$sessiondata['autologinid'] = (!$admin) ? (( $enable_autologin && $sessionmethod == SESSION_METHOD_COOKIE ) ? $auto_login_key : '') : $sessiondata['autologinid'];
		$sessiondata['userid'] = $user_id;
	}

	$userdata['session_id'] = $session_id;
	$userdata['session_ip'] = $user_ip;
	$userdata['session_user_id'] = $user_id;
	$userdata['session_logged_in'] = $login;
	$userdata['session_page'] = $page_id;
	$userdata['session_start'] = $current_time;
	$userdata['session_time'] = $current_time;
	$userdata['session_admin'] = $admin;
	$userdata['session_key'] = $sessiondata['autologinid'];

	setcookie($cookiename . '_data', serialize($sessiondata), $current_time + 31536000, $cookiepath, $cookiedomain, $cookiesecure);
	setcookie($cookiename . '_sid', $session_id, 0, $cookiepath, $cookiedomain, $cookiesecure);

	$SID = 'sid=' . $session_id;

	return $userdata;
}

//
// Checks for a given user session, tidies session table and updates user
// sessions at each page refresh
//
function session_pagestart($user_ip, $thispage_id)
{
	global $db, $lang, $board_config;
	global $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $SID;

	$cookiename = $board_config['cookie_name'];
	$cookiepath = $board_config['cookie_path'];
	$cookiedomain = $board_config['cookie_domain'];
	$cookiesecure = $board_config['cookie_secure'];

	$current_time = time();
	unset($userdata);

	if ( isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) || isset($HTTP_COOKIE_VARS[$cookiename . '_data']) )
	{
		$sessiondata = isset( $HTTP_COOKIE_VARS[$cookiename . '_data'] ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$cookiename . '_data'])) : array();
		$session_id = isset( $HTTP_COOKIE_VARS[$cookiename . '_sid'] ) ? $HTTP_COOKIE_VARS[$cookiename . '_sid'] : '';
		$sessionmethod = SESSION_METHOD_COOKIE;
	}
	else
	{
		$sessiondata = array();
		$session_id = ( isset($HTTP_GET_VARS['sid']) ) ? $HTTP_GET_VARS['sid'] : '';
		$sessionmethod = SESSION_METHOD_GET;
	}

	// 
	if (!preg_match('/^[A-Za-z0-9]*$/', $session_id))
	{
		$session_id = '';
	}

	$thispage_id = (int) $thispage_id;

	//
	// Does a session exist?
	//
	if ( !empty($session_id) )
	{
		//
		// session_id exists so go ahead and attempt to grab all
		// data in preparation
		//
		$sql = "SELECT u.*, s.*
			FROM " . SESSIONS_TABLE . " s, " . USERS_TABLE . " u
			WHERE s.session_id = '$session_id'
				AND u.user_id = s.session_user_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
		}

		$userdata = $db->sql_fetchrow($result);

		//
		// Did the session exist in the DB?
		//
		if ( isset($userdata['user_id']) )
		{

			// {{{ BEGIN BIT_MOD
			$userdata['session_ip'] = $user_ip;
			check_bit_user( $userdata );
			// }}} END BIT_MOD

			//
			// Do not check IP assuming equivalence, if IPv4 we'll check only first 24
			// bits ... I've been told (by vHiker) this should alleviate problems with 
			// load balanced et al proxies while retaining some reliance on IP security.
			//
			$ip_check_s = substr($userdata['session_ip'], 0, 6);
			$ip_check_u = substr($user_ip, 0, 6);

			if ($ip_check_s == $ip_check_u)
			{
				$SID = ($sessionmethod == SESSION_METHOD_GET || defined('IN_ADMIN')) ? 'sid=' . $session_id : '';

				//
				// Only update session DB a minute or so after last update
				//
				if ( $current_time - $userdata['session_time'] > 60 )
				{
					// A little trick to reset session_admin on session re-usage
					$update_admin = (!defined('IN_ADMIN') && $current_time - $userdata['session_time'] > ($board_config['session_length']+60)) ? ', session_admin = 0' : '';

					$sql = "UPDATE " . SESSIONS_TABLE . " 
						SET session_time = $current_time, session_page = $thispage_id$update_admin
						WHERE session_id = '" . $userdata['session_id'] . "'";
					if ( !$db->sql_query($sql) )
					{
						message_die(CRITICAL_ERROR, 'Error updating sessions table', '', __LINE__, __FILE__, $sql);
					}

					if ( $userdata['user_id'] != ANONYMOUS )
					{
						$sql = "UPDATE " . USERS_TABLE . " 
							SET user_session_time = $current_time, user_session_page = $thispage_id
							WHERE user_id = " . $userdata['user_id'];
						if ( !$db->sql_query($sql) )
						{
							message_die(CRITICAL_ERROR, 'Error updating sessions table', '', __LINE__, __FILE__, $sql);
						}
					}

					session_clean($userdata['session_id']);

					setcookie($cookiename . '_data', serialize($sessiondata), $current_time + 31536000, $cookiepath, $cookiedomain, $cookiesecure);
					setcookie($cookiename . '_sid', $session_id, 0, $cookiepath, $cookiedomain, $cookiesecure);
				}

				return $userdata;
			}
		}
	}

	// {{{ BEGIN BIT_MOD
	// make sure we keep copy a few variables over if we automatically start a new bit_session
	$userdata = $sessiondata;
	$userdata['session_page'] = $thispage_id;
	$userdata['session_ip'] = $user_ip;
	$userdata['user_id'] = $userdata['userid'];
	check_bit_user( $userdata );

/*
	//
	// If we reach here then no (valid) session exists. So we'll create a new one,
	// using the cookie user_id if available to pull basic user prefs.
	//
	$user_id = ( isset($sessiondata['userid']) ) ? intval($sessiondata['userid']) : ANONYMOUS;

	if ( !($userdata = session_begin($user_id, $user_ip, $thispage_id, TRUE)) )
	{
		message_die(CRITICAL_ERROR, 'Error creating user session', '', __LINE__, __FILE__, $sql);
	}
*/
	// {{{ END BIT_MOD

	return $userdata;

}

// {{{ BEGIN BIT_MOD
function check_bit_user( &$p_user_data ) {
	// We have a valid bitweaver user, however we do not have a phpBB user
	global $db, $gBitSystem, $gBitUser, $userlib, $HTTP_GET_VARS;

	$anon = $p_user_data['user_id'] == ANONYMOUS;
	if( empty($p_user_data['user_id']) || $anon
		|| ( $gBitUser->isRegistered() && $gBitUser->mUserId != $p_user_data['user_id'] )
	) {
		if( $gBitUser->isRegistered() ) {
			//
			// Try and pull the last time stored in a cookie, if it exists
			//
			$sql = "SELECT *
				FROM " . USERS_TABLE . "
				WHERE user_id = '".$gBitUser->mUserId."'";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, 'Could not obtain bitweaver user from phpBB user table', '', __LINE__, __FILE__, $sql);
			}
			$user_row = $db->sql_fetchrow($result);
//vd( $user_row );
			$md5 = $gBitSystem->isFeatureActive( 'users_clear_passwords' );
			$phpbb_password = ( $md5 ? $gBitUser->mInfo['password'] : md5( $gBitUser->mInfo['password'] ) );
			// nuke their existing session cause it stores anonymous_id (-1) initially
			$sql = "DELETE FROM " . SESSIONS_TABLE . "
					WHERE session_id = '".$p_user_data['session_id']."'";
			if ( !$db->sql_query($sql) )
			{
				message_die(CRITICAL_ERROR, 'Error clearing sessions table', '', __LINE__, __FILE__, $sql);
			}
			if( empty( $user_row['user_id'] ) ) {
				$sql = "INSERT INTO ". USERS_TABLE ." (user_id, username, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_sig_bbcode_uid, user_avatar, user_avatar_type, user_viewemail, user_aim, user_yim, user_msnm, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_timezone, user_dateformat, user_lang, user_style, user_level, user_allow_pm, user_active, user_actkey)
						VALUES ( ".$gBitUser->mInfo['user_id'].", ".$gBitSystem->mDb->qstr( $gBitUser->mInfo['login'], get_magic_quotes_gpc() ).", ".strtotime('now').", ".$gBitSystem->mDb->qstr( $phpbb_password, get_magic_quotes_gpc() ).", '".$gBitUser->mInfo['email']."',
					NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 1, 0, 1, 1, 0, 1, 1, 0, 'd M Y h:i a', 'english', 1, ".(int)$gBitUser->isAdmin().", 0, 1, NULL)";

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, 'Could not create bitweaver user for phpBB', '', __LINE__, __FILE__, $sql);
				}
			} else {
				// Has user data changed?
				if( ($user_row['user_email'] != $gBitUser->mInfo['email'])
					|| ($user_row['user_password'] != $phpbb_password)
					|| ($user_row['username'] != $gBitUser->mInfo['login'])
				)
				{
					$sql = "UPDATE ". USERS_TABLE ." SET username=".$gBitSystem->mDb->qstr( $gBitUser->mInfo['login'], get_magic_quotes_gpc() ).", user_email = ".$gBitSystem->mDb->qstr( $gBitUser->mInfo['email'], get_magic_quotes_gpc() ).", user_password=".$gBitSystem->mDb->qstr( $phpbb_password, get_magic_quotes_gpc() )."
							WHERE  user_id = ".$user_row['user_id'];
					if ( !($result = $db->sql_query($sql)) )
					{
						message_die(CRITICAL_ERROR, 'Could not create bitweaver user for phpBB', '', __LINE__, __FILE__, $sql);
						die;
					}
				}
			}
			// Restart the session because somehow we lost it.
			$p_user_data = session_begin( $gBitUser->mUserId, $p_user_data['session_ip'], $p_user_data['session_page'], TRUE, TRUE, (int)$gBitUser->isAdmin() );
		} else {
			// We have an anonymous session
			$user_id = ( isset($p_user_data['user_id']) ) ? intval($p_user_data['user_id']) : ANONYMOUS;

			if ( !($p_user_data = session_begin($user_id, $p_user_data['user_ip'], $p_user_data['session_page'], TRUE, TRUE )) )
			{
				message_die(CRITICAL_ERROR, 'Error creating user session', '', __LINE__, __FILE__, $sql);
			}
		}
	} elseif( $gBitUser->isRegistered() ) {
		if( empty( $p_user_data['session_id'] ) ) {
			// we need a session
			$p_user_data = session_begin( $gBitUser->mUserId, $p_user_data['session_ip'], $p_user_data['session_page'], TRUE, TRUE, (int)$gBitUser->isAdmin() );
		}
	} else {
		if( $p_user_data['session_logged_in'] ) {
			//our Tiki session has ended before our phpBB session
			session_end( $p_user_data['session_id'], $p_user_data['user_id'] );
			$p_user_data = session_begin( ANONYMOUS, $p_user_data['session_ip'], $p_user_data['session_page'] );
		}
	}
}
// }}} END BIT_MOD

//
// session_end closes out a session
// deleting the corresponding entry
// in the sessions table
//
function session_end($session_id, $user_id)
{
	global $db, $lang, $board_config, $userdata;
	global $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $SID;

	$cookiename = $board_config['cookie_name'];
	$cookiepath = $board_config['cookie_path'];
	$cookiedomain = $board_config['cookie_domain'];
	$cookiesecure = $board_config['cookie_secure'];

	$current_time = time();

	if (!preg_match('/^[A-Za-z0-9]*$/', $session_id))
	{
		return;
	}
	
	//
	// Delete existing session
	//
	$sql = 'DELETE FROM ' . SESSIONS_TABLE . " 
		WHERE session_id = '$session_id' 
			AND session_user_id = $user_id";
	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error removing user session', '', __LINE__, __FILE__, $sql);
	}

	//
	// Remove this auto-login entry (if applicable)
	//
	if ( isset($userdata['session_key']) && $userdata['session_key'] != '' )
	{
		$autologin_key = md5($userdata['session_key']);
		$sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
			WHERE user_id = ' . (int) $user_id . "
				AND key_id = '$autologin_key'";
		if ( !$db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, 'Error removing auto-login key', '', __LINE__, __FILE__, $sql);
		}
	}

	//
	// We expect that message_die will be called after this function,
	// but just in case it isn't, reset $userdata to the details for a guest
	//
	$sql = 'SELECT *
		FROM ' . USERS_TABLE . '
		WHERE user_id = ' . ANONYMOUS;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Error obtaining user details', '', __LINE__, __FILE__, $sql);
	}
	if ( !($userdata = $db->sql_fetchrow($result)) )
	{
		message_die(CRITICAL_ERROR, 'Error obtaining user details', '', __LINE__, __FILE__, $sql);
	}
	$db->sql_freeresult($result);


	setcookie($cookiename . '_data', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
	setcookie($cookiename . '_sid', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);

	return true;
}

/**
* Removes expired sessions and auto-login keys from the database
*/
function session_clean($session_id)
{
	global $board_config, $db;

	//
	// Delete expired sessions
	//
	$sql = 'DELETE FROM ' . SESSIONS_TABLE . ' 
		WHERE session_time < ' . (time() - (int) $board_config['session_length']) . " 
			AND session_id <> '$session_id'";
	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error clearing sessions table', '', __LINE__, __FILE__, $sql);
	}

	//
	// Delete expired auto-login keys
	// If max_autologin_time is not set then keys will never be deleted
	// (same behaviour as old 2.0.x session code)
	//
	if (!empty($board_config['max_autologin_time']) && $board_config['max_autologin_time'] > 0)
	{
		$sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
			WHERE last_login < ' . (time() - (86400 * (int) $board_config['max_autologin_time']));
		$db->sql_query($sql);
	}

	return true;
}

/**
* Reset all login keys for the specified user
* Called on password changes
*/
function session_reset_keys($user_id, $user_ip)
{
	global $db, $userdata;

	$key_sql = ($user_id == $userdata['user_id'] && !empty($userdata['session_key'])) ? "AND key_id != '" . md5($userdata['session_key']) . "'" : '';

	$sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
		WHERE user_id = ' . (int) $user_id . "
			$key_sql";

	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error removing auto-login keys', '', __LINE__, __FILE__, $sql);
	}

	$where_sql = 'session_user_id = ' . (int) $user_id;
	$where_sql .= ($user_id == $userdata['user_id']) ? " AND session_id <> '" . $userdata['session_id'] . "'" : '';
	$sql = 'DELETE FROM ' . SESSIONS_TABLE . "
		WHERE $where_sql";
	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error removing user session(s)', '', __LINE__, __FILE__, $sql);
	}

	if ( !empty($key_sql) )
	{
		$auto_login_key = dss_rand() . dss_rand();

		$current_time = time();
		
		$sql = 'UPDATE ' . SESSIONS_KEYS_TABLE . "
			SET last_ip = '$user_ip', key_id = '" . md5($auto_login_key) . "', last_login = $current_time
			WHERE key_id = '" . md5($userdata['session_key']) . "'";
		
		if ( !$db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, 'Error updating session key', '', __LINE__, __FILE__, $sql);
		}

		// And now rebuild the cookie
		$sessiondata['userid'] = $user_id;
		$sessiondata['autologinid'] = $autologin_id;
		$cookiename = $board_config['cookie_name'];
		$cookiepath = $board_config['cookie_path'];
		$cookiedomain = $board_config['cookie_domain'];
		$cookiesecure = $board_config['cookie_secure'];

		setcookie($cookiename . '_data', serialize($sessiondata), $current_time + 31536000, $cookiepath, $cookiedomain, $cookiesecure);
		
		$userdata['session_key'] = $auto_login_key;
		unset($sessiondata);
		unset($auto_login_key);
	}
}

//
// Append $SID to a url. Borrowed from phplib and modified. This is an
// extra routine utilised by the session code above and acts as a wrapper
// around every single URL and form action. If you replace the session
// code you must include this routine, even if it's empty.
//
function append_sid($url, $non_html_amp = false)
{
	global $SID;

	if ( !empty($SID) && !preg_match('#sid=#', $url) )
	{
		$url .= ( ( strpos($url, '?') !== false ) ?  ( ( $non_html_amp ) ? '&' : '&amp;' ) : '?' ) . $SID;
	}

	return $url;
}

?>
