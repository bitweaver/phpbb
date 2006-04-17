<?php
global $gBitSystem;

$registerHash = array(
	'package_name' => 'phpbb',
	'package_path' => dirname( __FILE__ ).'/',
);
$gBitSystem->registerPackage( $registerHash );

if( $gBitSystem->isPackageActive( 'phpbb' ) ) {
	$gBitSystem->registerAppMenu( PHPBB_PKG_NAME, ucfirst( PHPBB_PKG_DIR ), PHPBB_PKG_URL.'index.php', 'bitpackage:phpbb/menu_phpbb.tpl' );
	if( file_exists( PHPBB_PKG_PATH.'config.php' ) ) {
		require_once( PHPBB_PKG_PATH.'config.php' );
	}
}
?>
