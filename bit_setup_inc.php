<?php
global $gBitSystem;

$registerHash = array(
	'package_name' => 'phpbb',
	'package_path' => dirname( __FILE__ ).'/',
	'homeable' => TRUE,
);
$gBitSystem->registerPackage( $registerHash );

if( $gBitSystem->isPackageActive( 'phpbb' ) ) {
	$menuHash = array(
		'package_name'  => PHPBB_PKG_NAME,
		'index_url'     => PHPBB_PKG_URL.'index.php',
		'menu_template' => 'bitpackage:phpbb/menu_phpbb.tpl',
	);
	$gBitSystem->registerAppMenu( $menuHash );

	if( file_exists( PHPBB_PKG_PATH.'config.php' ) ) {
		require_once( PHPBB_PKG_PATH.'config.php' );
	}
}
?>
