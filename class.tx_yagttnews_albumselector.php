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

		/**
		 * So this is how it works:
		 *
		 * renderSourceSelector renders the 3 col box for gallery, album, item
		 * if a gallery is selected, this is passed to the FLUID template and the selected gallery is rendered in first col
		 * selected gallery has to be passed to HTML output in hidden fields, as ajax reloads selected album
		 * that's why we have to use renderSelectedGallery and renderSelectedAlbum
		 */
		return $this->renderTtnewsSourceSelector($PA, $fobj) . ' ' .
				$this->renderSelectedAlbum($PA, $fobj);

	}



	/**
	 * Render a source selector to select gallery / album / item at once
	 *
	 * @param unknown_type $PA
	 * @param unknown_type $fobj
	 */
	public function renderTtnewsSourceSelector(&$PA, &$fobj) {
		$this->determineCurrentPID($PA['row']['pid']);
		$this->init();

		$template = t3lib_div::getFileAbsFileName('EXT:yag_ttnews/Resources/Private/Templates/Backend/FlexForm/FlexFormSource.html');
		$renderer = $this->getFluidRenderer();

		$renderer->setTemplatePathAndFilename($template);

		$galleryRepository = $this->objectManager->get('Tx_Yag_Domain_Repository_GalleryRepository'); /* @var $galleryRepository Tx_Yag_Domain_Repository_GalleryRepository */
		$galleries = $galleryRepository->findAll();

		$pages = $this->pidDetector->getPageRecords();

		$selectedAlbumUid = intval($PA['row']['tx_yagttnews_album_uid']);

		if($selectedAlbumUid) {

			$albumRepository = $this->objectManager->get('Tx_Yag_Domain_Repository_AlbumRepository'); /* @var $albumRepository Tx_Yag_Domain_Repository_AlbumRepository */
			$selectedAlbum = $albumRepository->findByUid($selectedAlbumUid); /* @var $selectedAlbum Tx_Yag_Domain_Model_Album */
			$selectedGallery = $selectedAlbum->getGallery();

			if($selectedAlbum) {
				$renderer->assign('selectedPage', $selectedAlbum->getPid());
				$renderer->assign('selectedAlbum', $selectedAlbum);
				$renderer->assign('selectedGallery', $selectedGallery);
				$renderer->assign('selectedGalleryUid', $selectedGallery->getUid());

				$renderer->assign('albums', $selectedGallery->getAlbums());
				$renderer->assign('images', $selectedAlbum->getItems());
			}
		}

		$renderer->assign('pages', $pages);
		$renderer->assign('galleries', $galleries);
		$renderer->assign('PA', $PA);

		$content = $renderer->render();

		$this->extbaseShutdown();

		return $content;
	}
	
}
?>