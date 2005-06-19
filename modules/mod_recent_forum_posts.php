<?php
// Set up some defines we need to be able to access the phpbb db object
// PARAMETER: take a module parameter 'f=1234' where 1234 is the id of forum

define ('IN_PHPBB', TRUE);
$phpbb_root_path = PHPBB_PKG_PATH;
$phpEx = 'php';

global $smarty, $modlib, $gBitSystem, $gQueryUser, $module_rows, $module_params, $wikilib, $db;

// common.php sets up everything we need to acccess the phpbb database
if( empty( $db ) ) {
	require_once( PHPBB_PKG_PATH.'common.php');
}

$whereSql = '';
$forumSpecific = FALSE;
if( !empty( $module_params['f'] ) || !empty( $module_params['forum'] ) ) {
	$whereSql = ' AND f.forum_id='.$module_params['f'];
	$forumSpecific = TRUE;
}

if( !empty( $gQueryUser->mUserId ) ) {
	$whereSql .= ' AND p.poster_id='.$gQueryUser->mUserId;
}

$sql = "SELECT p.*, pt.*, t.topic_title, f.forum_name
		FROM ".POSTS_TABLE." p, ".POSTS_TEXT_TABLE." pt, ".FORUMS_TABLE." f, ".TOPICS_TABLE." t
		WHERE p.post_id = pt.post_id AND p.forum_id = f.forum_id AND t.topic_id = p.topic_id $whereSql
		ORDER BY p.post_time DESC
		LIMIT $module_rows;";

if (!($result = $db->sql_query($sql)) ) {
	print("Unable to query forum posts: $sql");
}

$forumPosts = $db->sql_fetchrowset($result);
//vd($forumPosts);
$smarty->assign_by_ref('forumPosts', $forumPosts);

if( $forumSpecific && !empty( $forumPosts[0] ) ) {
	$linkTitle = '<a href="'.PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'].'">'.$forumPosts[0]['forum_name'].'</a>';
	$smarty->assign_by_ref('forumTitle', $linkTitle );
	$smarty->assign( 'forumUrl', PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'] );
}

?>
