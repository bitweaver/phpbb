<?php
// Set up some defines we need to be able to access the phpbb db object
define ('IN_PHPBB', TRUE);
$phpbb_root_path = PHPBB_PKG_PATH;
$phpEx = 'php';

global $gBitSmarty, $modlib, $gBitSystem, $gQueryUser, $module_rows, $module_params, $wikilib, $db;

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

$forumTopics = $phpbbLib->getListTopics( $listHash );
$gBitSmarty->assign_by_ref('forumTopics', $forumTopics);

if( $forumSpecific && !empty( $forumTopics[0] ) ) {
	$linkTitle = '<a href="'.PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'].'">'.$forumTopics[0]['forum_name'].'</a>';
	$gBitSmarty->assign_by_ref('forumTitle', $linkTitle );
	$gBitSmarty->assign( 'forumUrl', PHPBB_PKG_URL.'viewforum.php?f='.$module_params['f'] );
}


?>
