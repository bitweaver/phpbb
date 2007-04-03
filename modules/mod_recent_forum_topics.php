<?php
if( defined( 'PHPBB_INSTALLED' ) ) {
	// Set up some defines we need to be able to access the phpbb db object
	define ('IN_PHPBB', TRUE);
	$phpbb_root_path = PHPBB_PKG_PATH;
	$phpEx = 'php';

	global $gBitSmarty, $gBitThemes, $gBitSystem, $gQueryUser, $moduleParams, $wikilib, $db;
	
	// common.php sets up everything we need to acccess the phpbb database
	if( empty( $db ) ) {
		require_once( PHPBB_PKG_PATH.'common.php');
	}

	$whereSql = '';
	$forumSpecific = FALSE;
	if( !empty( $module_params['forum'] ) ) {
		$whereSql = ' AND f.forum_id='.$module_params['forum'];
		$forumSpecific = TRUE;
	} elseif( !empty( $module_params['f'] ) ) {
		$whereSql = ' AND f.forum_id='.$module_params['f'];
		$forumSpecific = TRUE;
	}

	if( !empty( $gQueryUser->mUserId ) ) {
		$whereSql .= ' AND t.topic_poster='.$gQueryUser->mUserId;
	}

	$sql = "SELECT t.topic_title, t.topic_id, f.forum_name, f.forum_id
			FROM ".FORUMS_TABLE." f, ".TOPICS_TABLE." t
			WHERE f.forum_id = t.forum_id $whereSql
			ORDER BY t.topic_time DESC
			LIMIT $moduleParams[module_rows];";

	if (!($result = $db->sql_query($sql)) ) {
		print("Unable to query forum posts: $sql");
	}

	$forumTopics = $db->sql_fetchrowset($result);
	$gBitSmarty->assign_by_ref('forumTopics', $forumTopics);

	if( $forumSpecific && !empty( $forumTopics[0] ) ) {
		$linkTitle = '<a href="'.PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'].'">'.$forumTopics[0]['forum_name'].'</a>';
		$gBitSmarty->assign_by_ref('forumTitle', $linkTitle );
		$gBitSmarty->assign( 'forumUrl', PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'] );
	} else {
		$gBitSmarty->assign( 'forumUrl', PHPBB_PKG_URL );
	}
}

?>
