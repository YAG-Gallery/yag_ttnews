<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
*  All rights reserved
*
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

require_once(t3lib_extMgm::extPath('yag').'Classes/Utility/Flexform/RecordSelector.php');

/**
 * Class renders a album selector for tt_news entries
 *
 * @package yag_ttnews
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class tx_yagttnews_albumselector extends user_Tx_Yag_Utility_Flexform_RecordSelector {

	public function userAlbumSelectorRenderer($PA, $fobj) {
		
		return $this->renderAlbumSelector($PA, $fobj);
		
	}
	
}
 
?>