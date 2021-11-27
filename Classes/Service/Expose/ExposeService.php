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

namespace IWAG\IwImmo\Service\Expose;

use IWAG\IwImmo\Service\Exception\ServiceException;

/**
 * Class ExposeService
 *
 * @package IWAG\IwImmo\Service\Expose
 */
class ExposeService extends AbstractExposeService { // Es kann nur eins geben!

  /**
   * @var string
   */
  protected $onlineId;

  /**
   * @return array
   * @throws \IWAG\IwImmo\Service\Exception\InvalidResultException
   * @throws \IWAG\IwImmo\Service\Exception\NoConnectionException
   */
  public function execute() {
    return parent::execute();
  }

  /**
   * @param array $form
   *
   * @throws ServiceException
   */
  public function sendInquiry(array $form) {

    if (!$this->getOnlineId()) {
      throw new ServiceException('Für die Expose-Anfrage muss eine OnlineId Gesetzt sein.', 1414489683);
    }

    $ch = curl_init();

    curl_setopt_array(
      $ch,
      [
        CURLOPT_URL => $this->buildRequestUrl() . '/inquiry',
        CURLOPT_POST => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POSTFIELDS => $this->getInquiryRequestData($form),
        CURLOPT_HTTPHEADER => $this->getRequestHeaders(),
      ]
    );

    $result = curl_exec($ch);

    curl_close($ch);

    if ($result != 'true') {
      throw new ServiceException('Kontaktanfrage konnte nicht verschickt werden', 1414761744);
    }
  }

  /**
   * @return string
   */
  public function getOnlineId() {
    return $this->onlineId;
  }

  /**
   * @param string $onlineId
   *
   * @return $this
   */
  public function setOnlineId($onlineId) {
    $this->onlineId = $onlineId;

    /** Workaroud weil guid kein parameter ist, sondern teil der URL */
    $this->functionName .= '/' . $this->onlineId;

    return $this;
  }

  /**
   * @param array $form
   *
   * @return string
   */
  protected function getInquiryRequestData(array $form) {

    $requestArray = [];

    $allowedFields = [
      'salutation',
      'lastName',
      'firstName',
      'email',
      'phone',
      'street',
      'zip',
      'city',
      'mobile',
      'fax',
      'message',
    ];

    foreach ($allowedFields as $fieldName) {
      if (isset($form[$fieldName]) && !empty($form[$fieldName])) {
        $requestArray[$fieldName] = $form[$fieldName];
      }
    }


    $requestArray['domain'] = $this->settings['contact']['domain'] ?: '';

    return json_encode($requestArray);
  }

}