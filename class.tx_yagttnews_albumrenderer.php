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
 * Class implements hook that renders yag albums within tt_news records
 * 
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @author Daniel Lienert <daniel@lienert.cc>
 * @package yag_ttnews
 */
class tx_yagttnews_classes_albumrenderer {
	
	const ALBUM_UID_FIELDNAME = 'tx_yagttnews_album_uid';
	const TTNEWS_MARKER       = '###YAGGALLERY_ALBUM###';
	const EXTENSION_NAME      = 'Yag'; 
    const PLUGIN_NAME         = 'Pi1';
    
    
    
    /**
     * Holds an instance of Extbase bootstrap
     *
     * @var Tx_Extbase_Core_Bootstrap
     */
    protected $bootstrap;
    
    
    
    /**
     * Holds an instance of yag configuration builder
     *
     * @var Tx_Yag_Domain_Configuration_ConfigurationBuilder
     */
    protected $configurationBuilder;
    
    
    
    /**
     * Holds selected album uid
     *
     * @var int
     */
    protected $albumUid;
    
    
    
    /**
     * Holds YAG TS settings of this page
     *
     * @var array
     */
    protected $tsSettings;
    
	
	
	/**
	 * Adds a marker to tt_news's markers and fills it with rendered album
	 * if an album uid for tt_news record is given. 
	 *
	 * @param unknown_type $markerArray
	 * @param unknown_type $row
	 * @param unknown_type $lConf
	 * @param unknown_type $pObj
	 * @return unknown
	 */
	public function extraItemMarkerProcessor($markerArray, $row, $lConf, &$pObj) {
		$markerArray[self::TTNEWS_MARKER] = '';
		$this->albumUid = $this->getAlbumUidFromRow($row);
		if ($this->albumUid != 0) {
			$markerArray[self::TTNEWS_MARKER] = $this->getRenderedAlbumStringByAlbumUid($this->albumUid);
		}
		return $markerArray;
	}
	
	
	
	/**
	 * Returns uid of album, if set in tt_news record, or 0 if none is given;
	 *
	 * @param array $row
	 * @return unknown
	 */
	protected function getAlbumUidFromRow(array $row) {
		if (array_key_exists(self::ALBUM_UID_FIELDNAME, $row)) {
			return $row[self::ALBUM_UID_FIELDNAME];
		}
		return 0;
	}
	
	
	
	/**
	 * Returns rendered html string for album
	 *
	 * @param int $albumUid
	 * @return string Rendered album
	 */
	protected function getRenderedAlbumStringByAlbumUid($albumUid) {
		$this->initBootstrap();
		$configuration = array(
            'extensionName' => self::EXTENSION_NAME,
            'pluginName' => self::PLUGIN_NAME,
            'controller' => 'ItemList',
            'action' => 'lists',
            'switchableControllerActions' => array(
                'ItemList' => array('list')
            )
        );
		return $this->bootstrap->run('', $configuration);
	}
	
	
	
    /**
     * Init the extbase Context and the configurationBuilder
     * 
     * @param integer $pid
     * @throws Exception
     */
    protected function initBootstrap() {
        $configuration = array();
        $configuration['extensionName'] = self::EXTENSION_NAME;
        $configuration['pluginName'] = self::PLUGIN_NAME;
        
        $this->bootstrap = t3lib_div::makeInstance('Tx_Extbase_Core_Bootstrap');
        $this->bootstrap->initialize($configuration);
        
        if(!$this->configurationBuilder) {
            
            $this->objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager'); 
            
            try {
                // try to get the instance from factory cache
                $this->configurationBuilder = Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance($this->getContextIdentifier(), $this->tsSettings['theme']);
            } catch (Exception $e) {
                if(!$this->getCurrentPid()) throw new Exception('Need PID for initialation - No PID given! 1298928835');
                    
                $this->tsSettings = $this->getTyposcriptSettings($this->getCurrentPid());
                Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::injectSettings($this->tsSettings);
                // We set the theme here!
                $this->configurationBuilder = Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance($this->getContextIdentifier(), $this->tsSettings['theme']);
                // We do an ugly fake for setting contextIdentifier
            }
        }
        $this->configurationBuilder->buildAlbumConfiguration()->setSelectedAlbumUid($this->albumUid);
    }
    
    
    protected function getContextIdentifier() {
    	return 'tt_news_albumUid_' . $this->albumUid;
    }
    
    
    
    /**
     * Get the typoscript loaded on the current page
     * 
     * @param $pid
     */
    protected function getTyposcriptSettings($pid) {
        $typoScript = tx_pttools_div::returnTyposcriptSetup($pid, 'plugin.tx_yag.settings.');

        if(!is_array($typoScript) || empty($typoScript)) {
            throw new Exception('No TypoScript configuration could be found for YAG. Make sure to include static templates for YAG! 1300206220');
        }
        
        return  Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($typoScript);
    } 

    
    
    /**
     * Returns PID of current page
     *
     * @return int
     */
    protected function getCurrentPid() {
    	return $GLOBALS['TSFE']->id;
    }
	
}

?>