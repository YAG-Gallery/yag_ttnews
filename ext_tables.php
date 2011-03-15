<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
*            
*           
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * TCA Configuration for adding field to tt_news
 */
if (!defined ('TYPO3_MODE'))    die ('Access denied.');

require_once(t3lib_extMgm::extPath('yag').'Classes/Utility/Flexform/RecordSelector.php');
require_once(t3lib_extMgm::extPath($_EXTKEY).'class.tx_yagttnews_albumselector.php');

$tempColumns = Array (
/*
    "tx_yagttnews_album_uid" => Array (        
        "exclude" => 1,     
        "label" => "LLL:EXT:yag_ttnews/Resources/Private/Language/locallang_db.xml:tt_news.yag_album_uid",      
        "config" => Array (
            "eval" => 'int',
            "type" => "input",  
            "size" => "5"
        )
    ),*/
    'tx_yagttnews_album_uid' => Array (
        'label' => 'LLL:EXT:yag_ttnews/Resources/Private/Language/locallang_db.xml:tt_news.yag_album_uid',
        'config' => Array (
            'type' => 'user',
            'userFunc' => 'tx_yagttnews_albumselector->userAlbumSelectorRenderer',
        )
    )
);

// Add field to tt_news
t3lib_div::loadTCA("tt_news");
t3lib_extMgm::addTCAcolumns("tt_news",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("tt_news","tx_yagttnews_album_uid,TEST02;;;;1-1-1", '', 'after:image');



// Configure static template for this extension
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', '[yag] tt_news integration');

?>