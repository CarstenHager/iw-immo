<?php
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

namespace IWAG\IwImmo\Controller;

use IWAG\IwImmo\ResultObjects\Exposes\Expose;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class ContactController
 *
 * @package IWAG\IwImmo\Controller
 */
class CalculatorController extends BaseController {

  /**
   * @param Expose $expose
   *
   * @return string
   */
  public function indexAction() {

    $get = GeneralUtility::_GET('tx_iwimmo_detail');

    if ($get['calculator']) {
      $this->request->setArgument('calculator', $get['calculator']);
    }
    $this->view->assign('calculator', $this->request->getArguments());


    $content = $this->view->render();
    $content .= $this->getDisclaimer();
    return $content;
  }

}
