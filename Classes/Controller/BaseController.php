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

use IWAG\IwImmo\Service\Exception\ServiceException;
use IWAG\IwImmo\Utility\ImmoUtility;
use TYPO3\CMS\Core\Log\Logger;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class BaseController
 *
 * @package IWAG\IwImmo\Controller
 */
class BaseController extends ActionController {

  /**
   * @var Logger
   */
  protected $logger;

  public function injectLogger(LogManager $logManager) {
    $this->logger = $logManager->getLogger(__CLASS__);
  }

  /**
   * @param ConfigurationManagerInterface $configurationManager
   *
   * @return void
   */
  public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager) {
    $this->configurationManager = $configurationManager;
    $this->settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);

    $this->settings = ImmoUtility::evaluateSettingsWithStdWrap($this->settings);

  }

  /**
   * @return string|void
   */
  public function errorAction(): string {

  }

  /**
   * Alle ServiceExceptions (ausser ApiKeyMissingException) abfangen und zur
   * ErrorArction weiterleiten
   */
  protected function callActionMethod() {
    try {
      parent::callActionMethod();

    } catch (ServiceException $e) {
      if (get_class($e) != 'IWAG\IwImmo\Service\Exception\ApiKeyMissingException') {
//        $this->logger->error($e->getCode() . ': ' . $e->getMessage());
        $this->forward('error');
      }
      else {
        throw new $e;
      }
    }
  }

  /**
   * @return string
   */
  protected function getDisclaimer(): string {
    return '<div class="poweredby"><a href="http://www.immowelt.de" title="Immobilienportal Immowelt.de" rel="nofollow">Immobilien-Daten bereitgestellt von Immowelt.de</a> <img src="typo3conf/ext/iw_immo/Resources/Public/Images/powered-by-iw.jpg" alt="immowelt.de"></div><div class="clearfix"></div>';
  }

}
