<?php

namespace IWAG\IwImmo\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Immowelt AG <support@immowelt.de>
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

use IWAG\IwImmo\ResultObjects\Exposes\Expose;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DetailController
 *
 * @package IWAG\IwImmo\Controller
 */
class DetailController extends BaseController {

  public function initializeShowAction() {
    if (!$this->request->hasArgument('expose') && isset($this->settings['detail']['defaultExposeId'])) {
      $this->request->setArgument('expose', $this->settings['detail']['defaultExposeId']);
    }
  }

  /**
   * @param Expose $expose
   *
   * @return string
   */
  public function showAction(Expose $expose) {
    $this->setAdditionalData($expose);

    $this->view->assign('expose', $expose);

    $content = $this->view->render();
    $content .= $this->getDisclaimer();
    return $content;
  }

  /**
   * @param Expose $expose
   */
  protected function setAdditionalData(Expose $expose) {

    // TODO: Use new title API
    // $pageRenderer->setTitle($expose->getTitle());

//    GeneralUtility::makeInstance(MetaTagManagerRegistry::class)
//      ->getManagerForProperty('canonical')
//      ->addProperty('canonical', 'http://www.immowelt.de/expose/' . $expose->getId() . '');
  }

}
