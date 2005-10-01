<?php
// Set up some defines we need to be able to access the phpbb db object
// PARAMETER: take a module parameter 'f=1234' where 1234 is the id of forum

global $gBitSmarty, $modlib, $gBitSystem, $gQueryUser, $module_rows, $module_params, $wikilib, $db, $phpbbLib;

require_once( PHPBB_PKG_PATH.'phpbb_lib.php' );
$forumSpecific = FALSE;

$listHash['max_records'] = $module_rows;
if( !empty( $module_params['f'] ) ) {
	$listHash['forum_id'] = $module_params['f'];
	$forumSpecific = TRUE;
} elseif( !empty( $module_params['forum'] ) ) {
	$listHash['forum_id'] = $module_params['forum'];
	$forumSpecific = TRUE;
}
if( !empty( $gQueryUser->mUserId ) ) {
	$listHash['user_id'] = $gQueryUser->mUserId;
}

// only show forum name if desired.
if( !empty( $module_params['show_forum_name'] ) ) {
	$gBitSmarty->assign( 'show_forum_name', TRUE );
}

//vd($forumPosts);
$forumPosts = $phpbbLib->getListPosts( $listHash );
$gBitSmarty->assign_by_ref('forumPosts', $forumPosts);

if( $forumSpecific && !empty( $forumPosts[0] ) ) {
	$linkTitle = '<a href="'.PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'].'">'.$forumPosts[0]['forum_name'].'</a>';
	$gBitSmarty->assign_by_ref('forumTitle', $linkTitle );
	$gBitSmarty->assign( 'forumUrl', PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'] );
}

?>
