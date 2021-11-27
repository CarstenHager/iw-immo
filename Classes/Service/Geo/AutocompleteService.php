<?php

namespace IWAG\IwImmo\Service\Geo;


use IWAG\IwImmo\Service\Exception\ServiceException;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

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
class AutocompleteService extends AbstractLocationService {

  /**
   * @var string
   */
  protected $functionName = 'autocomplete';

  /**
   * @var array
   */
  protected $defaultParameters = [
    'name' => '',
    'validonly' => TRUE,
    'onlycities' => TRUE,
    'countrygeoid' => '108',
    'limit' => 10,

  ];

  /**
   * Setzt Variable name
   *
   * @param string $name
   *
   * @return self
   *
   */
  public function setName($name) {
    $this->parameters['name'] = (string) $name;

    return $this;
  }

  /**
   * Setzt Variable validOnly
   *
   * @param bool $validOnly
   *
   * @return self
   *
   */
  public function setValidOnly($validOnly) {
    $this->parameters['validonly'] = (bool) $validOnly;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable validOnly
   *
   * @return bool
   */
  public function getValidOnly() {
    return $this->parameters['validonly'];
  }

  /**
   * Setzt Variable onlyCities
   *
   * @param bool $onlyCities
   *
   * @return self
   *
   */
  public function setOnlyCities($onlyCities) {
    $this->parameters['onlycities'] = (bool) $onlyCities;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable onlyCities
   *
   * @return bool
   */
  public function getOnlyCities() {
    return $this->parameters['onlycities'];
  }

  /**
   * Setzt Variable countryGeoId
   *
   * @param int $countryGeoId
   *
   * @return self
   * @throws ServiceException
   */
  public function setCountryGeoId($countryGeoId) {

    $this->parameters['countrygeoid'] = (int) $countryGeoId;

    return $this;
  }



  // ****************************************************************************

  /**
   * Liefert die Variable countryGeoId
   *
   * @return int
   */
  public function getCountryGeoId() {
    return $this->parameters['countrygeoid'];
  }

  /**
   * @return array
   * @throws \IWAG\IwImmo\Service\Exception\InvalidResultException
   * @throws \IWAG\IwImmo\Service\Exception\NoConnectionException
   * @throws ServiceException
   */
  public function execute() {

    if ($this->getName() == '') {
      throw new ServiceException(
        'Der Parameter "name" darf nicht leer sein',
        1412920677
      );
    }

    $this->parameters['limit'] = $this->getLimit();

    return parent::execute();
  }

  // ****************************************************************************

  /**
   * Liefert die Variable name
   *
   * @return string
   */
  public function getName() {
    return $this->parameters['name'];
  }

}