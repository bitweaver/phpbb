<?php

class PhpBBLib {
	function PhpBBLib() {
		global $gBitSmarty, $gBitThemes, $gBitSystem, $gQueryUser, $module_rows, $module_params, $wikilib, $db, $phpbb_root_path, $phpEx;
		if( !defined( 'IN_PHPBB' ) ) {
			define ('IN_PHPBB', TRUE);
		}
		$phpbb_root_path = PHPBB_PKG_PATH;
		$phpEx = 'php';

		// common.php sets up everything we need to acccess the phpbb database
		if( empty( $db ) ) {
			require_once( PHPBB_PKG_PATH.'common.php');
		}
	}

	function getListPosts( &$pListHash ) {
		global $db;
		$whereSql = '';
		if( !empty( $pListHash['forum_id'] ) ) {
			$whereSql .= ' AND f.forum_id='.$pListHash['forum_id'];
		}
		if( !empty( $pListHash['user_id'] ) ) {
			$whereSql .= ' AND p.poster_id='.$pListHash['user_id'];
		}

		$sql = "SELECT p.*, pt.*, t.topic_title, f.forum_name
				FROM ".POSTS_TABLE." p, ".POSTS_TEXT_TABLE." pt, ".FORUMS_TABLE." f, ".TOPICS_TABLE." t
				WHERE p.post_id = pt.post_id AND p.forum_id = f.forum_id AND t.topic_id = p.topic_id $whereSql
				ORDER BY p.post_time DESC
				LIMIT $pListHash[max_records];";

		if (!($result = $db->sql_query($sql)) ) {
			print("Unable to query forum posts: $sql");
		}

		return( $db->sql_fetchrowset( $result ) );
	}

	function getListTopics( &$pListHash ) {
		global $db;
		$whereSql = '';
		if( !empty( $pListHash['forum_id'] ) ) {
			$whereSql .= ' AND f.forum_id='.$pListHash['forum_id'];
		}
		if( !empty( $pListHash['user_id'] ) ) {
			$whereSql .= ' AND t.topic_poster='.$gQueryUser->mUserId;
		}

		$sql = "SELECT t.topic_title, t.topic_id, f.forum_name, f.forum_id
				FROM ".FORUMS_TABLE." f, ".TOPICS_TABLE." t
				WHERE f.forum_id = t.forum_id $whereSql
				ORDER BY t.topic_time DESC
				LIMIT $pListHash[max_records];";

		if (!($result = $db->sql_query($sql)) ) {
			print("Unable to query forum posts: $sql");
		}

		return( $db->sql_fetchrowset($result) );

	}

}

$phpbbLib = new PhpBBLib();

?>
