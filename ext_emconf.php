<?php

########################################################################
# Extension Manager/Repository config file for ext "yag_ttnews".
#
# Auto generated 24-11-2012 20:40
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
	'version' => '1.0.0',
	'dependencies' => 'cms,extbase,fluid,yag,tt_news',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Daniel Lienert, Michael Knoll',
	'author_email' => 'daniel@lienert.cc, mimi@kaktusteam.de',
	'author_company' => ',',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
			'yag' => '1.5.2',
			'tt_news' => '',
			'typo3' => '4.6.0-6.1.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:16:{s:36:"class.tx_yagttnews_albumrenderer.php";s:4:"1ca3";s:36:"class.tx_yagttnews_albumselector.php";s:4:"61ef";s:12:"ext_icon.gif";s:4:"fef0";s:17:"ext_localconf.php";s:4:"e078";s:14:"ext_tables.php";s:4:"e580";s:14:"ext_tables.sql";s:4:"7703";s:38:"Configuration/TypoScript/constants.txt";s:4:"9e06";s:34:"Configuration/TypoScript/setup.txt";s:4:"b6bf";s:40:"Resources/Private/Language/locallang.xml";s:4:"aba7";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"49d2";s:42:"Resources/Private/Partials/ImageThumb.html";s:4:"8a2d";s:37:"Resources/Private/Partials/Pager.html";s:4:"6134";s:64:"Resources/Private/Templates/Backend/FlexForm/FlexFormSource.html";s:4:"71a9";s:46:"Resources/Private/Templates/ItemList/List.html";s:4:"f397";s:31:"Resources/Public/CSS/styles.css";s:4:"ca0d";s:14:"doc/manual.sxw";s:4:"f41a";}',
	'suggests' => array(
	),
);

?>