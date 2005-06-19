<?php
global $gBitSystem;

$gBitSystem->registerPackage( 'phpbb', dirname( __FILE__ ).'/' );
if( $gBitSystem->isPackageActive( 'phpbb' ) ) {
	$gBitSystem->registerAppMenu( 'phpbb', 'Forums', PHPBB_PKG_URL.'index.php', 'bitpackage:phpbb/menu_phpbb.tpl' );
}
?>
