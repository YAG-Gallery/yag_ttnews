<?php

########################################################################
# Extension Manager/Repository config file for ext "yag_ttnews".
#
# Auto generated 03-04-2011 08:27
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'YAG tt_news integration',
	'description' => 'YAG integration for tt_news. Enables inserting albums into news records.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.1.2',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Michael Knoll,Daniel Lienert',
	'author_email' => 'mimi@kaktusteam.de,daniel@lienert.cc',
	'author_company' => ',',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
			'yag' => '1.1.2',
			'tt_news' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:10:{s:36:"class.tx_yagttnews_albumrenderer.php";s:4:"9d03";s:36:"class.tx_yagttnews_albumselector.php";s:4:"5091";s:12:"ext_icon.gif";s:4:"fef0";s:17:"ext_localconf.php";s:4:"2052";s:14:"ext_tables.php";s:4:"788e";s:14:"ext_tables.sql";s:4:"6187";s:38:"Configuration/TypoScript/constants.txt";s:4:"c0ac";s:34:"Configuration/TypoScript/setup.txt";s:4:"7f02";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"9865";s:14:"doc/manual.sxw";s:4:"cfee";}',
);

?>