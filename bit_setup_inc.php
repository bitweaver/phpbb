<?php
global $gBitSystem;

$gBitSystem->registerPackage( 'phpbb', dirname( __FILE__ ).'/' );

if( $gBitSystem->isPackageActive( 'phpbb' ) ) {
	$menuHash = array(
		'package_name' => PHPBB_PKG_NAME,
		'menu_title' => ucfirst( PHPBB_PKG_DIR ),
		'url_index' => PHPBB_PKG_URL.'index.php',
		'menu_template' => 'bitpackage:phpbb/menu_phpbb.tpl',
	);
	$gBitSystem->registerAppMenu( $menuHash );
	if( file_exists( PHPBB_PKG_PATH.'config.php' ) ) {
		require_once( PHPBB_PKG_PATH.'config.php' );
	}
}
?>
