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

namespace IWAG\IwImmo\Service\Geo;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class LocationsService
 *
 * @package IWAG\IwImmo\Service\Geo
 */
class LocationsService extends AbstractLocationService {

  /**
   * @var string
   */
  protected $functionName = 'locations';

  /**
   * @var array
   */
  protected $defaultParameters = [
    'name' => '',
    'countrygeoid' => '108',

  ];

  /**
   * @param string $name
   *
   * @return self
   *
   */
  public function setName($name) {
    $this->parameters['name'] = $name;

    return $this;
  }

  /**
   * @return string
   */
  public function getName() {
    $this->parameters['name'];
  }

  // ****************************************************************************

  /**
   * @param string $countryGeoId
   *
   * @return self
   *
   */
  public function setCountryGeoId($countryGeoId) {
    $this->parameters['countrygeoid'] = $countryGeoId;

    return $this;
  }

  /**
   * @return string
   */
  public function getCountryGeoId() {
    $this->parameters['countrygeoid'];
  }

  // ****************************************************************************


}