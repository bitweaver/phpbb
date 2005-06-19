<?php
global $gBitInstaller;
$gBitInstaller->registerPackageInfo( 'phpbb', array(
	'description' => "phpBB is a high powered, fully scalable, and highly customizable Open Source bulletin board package. phpBB has a user-friendly interface, simple and straightforward administration panel, and helpful FAQ.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
	'version' => '2.0.15',
	'state' => 'external package',
	'dependencies' => '',
	'install' => array(
		'package' => 'phpbb',
		'file' => 'install/install.php'
	)
) );
?>
