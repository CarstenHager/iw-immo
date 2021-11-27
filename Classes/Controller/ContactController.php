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
class ContactController extends BaseController {

  /**
   *
   */
  public function initializeIndexAction() {
    $get = GeneralUtility::_GET('tx_iwimmo_detail');
    if (isset($get['expose'])) {
      $this->request->setArgument('expose', $get['expose']);
    }
    elseif ($this->settings['contact']['defaultExposeId']) {
      $this->request->setArgument('expose', $this->settings['contact']['defaultExposeId']);
    }

  }

  /**
   * @param \IWAG\IwImmo\ResultObjects\Exposes\Expose $expose
   * @param array $contact
   */
  public function indexAction(Expose $expose, $contact = NULL) {
    $this->view->assign('expose', $expose);
    $this->view->assign('contact', $contact);
  }

  /**
   * @param array $contact
   *
   */
  public function sendAction(array $contact) {
    /** @var \IWAG\IwImmo\Service\Expose\ExposeService $exposeService */
    $exposeService = $this->objectManager->get('IWAG\IwImmo\Service\Expose\ExposeService');

    $exposeService->setOnlineId($contact['expose']);
    $exposeService->sendInquiry($contact);

    $this->redirect('confirmation',
      NULL,
      NULL,
      [
        'contact' => $contact,
        'expose' => $contact['expose'],
      ],
      $this->settings['contact']['confirmation']['pid']
    );


  }

  /**
   * @param array $contact
   * @param Expose $expose
   */
  public function confirmationAction($contact, Expose $expose = NULL) {
    $this->view->assign('contact', $contact);
    $this->view->assign('expose', $expose);
  }

}