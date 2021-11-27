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

namespace IWAG\IwImmo\Demand;

use IWAG\IwImmo\Utility\ImmoUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class SearchDemand
 *
 * @package IWAG\IwImmo\Domain\Model
 */
class ListsSearchDemand {

  /**
   * @var ConfigurationManagerInterface
   */
  protected $configurationManager;

  /**
   * @var ObjectManager
   */
  protected $objectManager;

  /**
   * @var array
   */
  protected $settings = [];

  /**
   * @var string geoid
   */
  protected $geoid;

  /**
   * @var int roomi
   */
  protected $roomi;

  /**
   * @var int rooma
   */
  protected $rooma;

  /**
   * @var int prima
   */
  protected $prima;

  /**
   * @var int primi
   */
  protected $primi;

  // ****************************************************************************

  /**
   * @var int esr
   */
  protected $esr;

  /**
   * @var int etype
   */
  protected $etype;

  /**
   * @var string where
   */
  protected $where;

  // ****************************************************************************

  public function __construct(
    ConfigurationManagerInterface $configurationManager,
    ObjectManager $objectManager
  ) {
    $this->configurationManager = $configurationManager;
    $this->objectManager = $objectManager;
  }

  /**
   * Mit Defaultwerten aus settings/flexform befüllen
   */
  public function initializeObject() {
    $this->settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);

    $this->settings = ImmoUtility::evaluateSettingsWithStdWrap($this->settings);

    foreach ($this->settings['list']['parameters'] as $parameterName => $parameterValue) {
      $setterName = 'set' . ucfirst($parameterName);

      if (!empty($parameterValue) && method_exists($this, $setterName)) {
        $this->$setterName($parameterValue);
      }
    }
  }

  /**
   * Liefert die Variable roomi
   *
   * @return int
   */
  public function getRoomi() {
    return $this->roomi;
  }

  // ****************************************************************************

  /**
   * Setzt Variable roomi
   *
   * @param int $roomi
   *
   * @return self
   *
   */
  public function setRoomi($roomi) {
    $this->roomi = $roomi;

    return $this;
  }

  /**
   * Liefert die Variable rooma
   *
   * @return int
   */
  public function getRooma() {
    return $this->rooma;
  }

  /**
   * Setzt Variable rooma
   *
   * @param int $rooma
   *
   * @return self
   *
   */
  public function setRooma($rooma) {
    $this->rooma = $rooma;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable prima
   *
   * @return int
   */
  public function getPrima() {
    return $this->prima;
  }

  /**
   * Setzt Variable prima
   *
   * @param int $prima
   *
   * @return self
   *
   */
  public function setPrima($prima) {
    $this->prima = $prima;

    return $this;
  }

  /**
   * Liefert die Variable primi
   *
   * @return int
   */
  public function getPrimi() {
    return $this->primi;
  }

  // ****************************************************************************

  /**
   * Setzt Variable primi
   *
   * @param int $primi
   *
   * @return self
   *
   */
  public function setPrimi($primi) {
    $this->primi = $primi;

    return $this;
  }

  /**
   * Liefert die Variable esr
   *
   * @return int
   */
  public function getEsr() {
    return $this->esr;
  }

  /**
   * Setzt Variable esr
   *
   * @param int $esr
   *
   * @return self
   *
   */
  public function setEsr($esr) {
    $this->esr = $esr;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable etype
   *
   * @return int
   */
  public function getEtype() {
    return $this->etype;
  }

  /**
   * Setzt Variable etype
   *
   * @param int $etype
   *
   * @return self
   *
   */
  public function setEtype($etype) {
    $this->etype = $etype;

    return $this;
  }

  /**
   * @return array
   */
  public function getGeoDataForLocation() {

    $locationsArray = [];

    if ($this->hasLocationRestriction()) {
      /** @var \IWAG\IwImmo\Service\Geo\LocationsService $locationsService */
      $locationsService = $this->objectManager->get('IWAG\IwImmo\Service\Geo\LocationsService');

      $locationsService->setName($this->getWhere());
      if ($this->getGeoid()) {
        $locationsService->setCountryGeoId($this->getGeoid());

        $locationsArray = $locationsService->execute();

      }

    }

    return $locationsArray;
  }

  // ****************************************************************************

  /**
   * @return bool
   */
  public function hasLocationRestriction() {
    return !empty($this->where);
  }

  /**
   * Liefert die Variable where
   *
   * @return string
   */
  public function getWhere() {
    return $this->where;
  }

  /**
   * Setzt Variable where
   *
   * @param string $where
   *
   * @return self
   *
   */
  public function setWhere($where) {
    $this->where = $where;

    return $this;
  }

  /**
   * Liefert die Variable geoid
   *
   * @return string
   */
  public function getGeoid() {
    return $this->geoid;
  }

  // ****************************************************************************

  /**
   * Setzt Variable geoid
   *
   * @param string $geoid
   *
   * @return self
   *
   */
  public function setGeoid($geoid) {
    $this->geoid = $geoid;

    return $this;
  }

}
