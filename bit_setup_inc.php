<?php
global $gBitSystem;

$gBitSystem->registerPackage( 'phpbb', dirname( __FILE__ ).'/' );
if( $gBitSystem->isPackageActive( 'phpbb' ) ) {
	$gBitSystem->registerAppMenu( PHPBB_PKG_DIR, 'Forums', PHPBB_PKG_URL.'index.php', 'bitpackage:phpbb/menu_phpbb.tpl' );
	if( file_exists( PHPBB_PKG_PATH.'config.php' ) ) {
		require_once( PHPBB_PKG_PATH.'config.php' );
	}
}
?>
