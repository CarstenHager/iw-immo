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

namespace IWAG\IwImmo\ResultObjects\Lists;

use IWAG\IwImmo\ResultObjects\AbstractResultObject;
use IWAG\IwImmo\ResultObjects\Lists\Properties\PriceValues;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class ListItem
 *
 * @package IWAG\IwImmo\Domain\Model
 */
class ListItem extends AbstractResultObject {

  /**
   * @var array category
   */
  protected $category;

  /**
   * @var string createDate
   */
  protected $createDate;

  /**
   * @var array equipment
   */
  protected $equipment;

  // ****************************************************************************

  /**
   * @var string exposeUrl
   */
  protected $exposeUrl;

  /**
   * @var array geoData
   */
  protected $geoData;

  /**
   * @var string guid
   */
  protected $guid;

  // ****************************************************************************

  /**
   * @var int id
   */
  protected $id;

  /**
   * @var array landArea
   */
  protected $landArea;

  /**
   * @var array livingArea
   */
  protected $livingArea;

  // ****************************************************************************

  /**
   * @var array location
   */
  protected $location;

  /**
   * @var string onlineId
   */
  protected $onlineId;

  /**
   * @var string personsMax
   */
  protected $personsMax;

  // ****************************************************************************

  /**
   * @var PriceValues priceValues
   */
  protected $priceValues;

  /**
   * @var int rooms
   */
  protected $rooms;

  /**
   * @var string thumbnailUrl
   */
  protected $thumbnailUrl;

  // ****************************************************************************

  /**
   * @var string title
   */
  protected $title;

  /**
   * @var string vacant
   */
  protected $vacant;

  /**
   * Liefert die Variable category
   *
   * @return array
   */
  public function getCategory() {
    return $this->category;
  }

  // ****************************************************************************

  /**
   * Setzt Variable category
   *
   * @param array $category
   *
   * @return self
   *
   */
  public function setCategory($category) {
    $this->category = $category;

    return $this;
  }

  /**
   * Liefert die Variable createDate
   *
   * @return string
   */
  public function getCreateDate() {
    return $this->createDate;
  }

  /**
   * Setzt Variable createDate
   *
   * @param string $createDate
   *
   * @return self
   *
   */
  public function setCreateDate($createDate) {
    $this->createDate = $createDate;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable equipment
   *
   * @return array
   */
  public function getEquipment() {
    if (isset($this->settings['list']['properties']['equipmentLimit'])
      && $this->settings['list']['properties']['equipmentLimit'] > 0) {
      $temp = array_chunk($this->equipment, $this->settings['list']['properties']['equipmentLimit'], TRUE);
      return $temp[0];
    }
    else {
      return $this->equipment;
    }
  }

  /**
   * Setzt Variable equipment
   *
   * @param array $equipment
   *
   * @return self
   *
   */
  public function setEquipment($equipment) {
    $this->equipment = $equipment;

    return $this;
  }

  /**
   * Liefert die Variable exposeUrl
   *
   * @return string
   */
  public function getExposeUrl() {
    return $this->exposeUrl;
  }

  // ****************************************************************************

  /**
   * Setzt Variable exposeUrl
   *
   * @param string $exposeUrl
   *
   * @return self
   *
   */
  public function setExposeUrl($exposeUrl) {
    $this->exposeUrl = $exposeUrl;

    return $this;
  }

  /**
   * Liefert die Variable geoData
   *
   * @return array
   */
  public function getGeoData() {
    return $this->geoData;
  }

  /**
   * Setzt Variable geoData
   *
   * @param array $geoData
   *
   * @return self
   *
   */
  public function setGeoData($geoData) {
    $this->geoData = $geoData;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable guid
   *
   * @return string
   */
  public function getGuid() {
    return $this->guid;
  }

  /**
   * Setzt Variable guid
   *
   * @param string $guid
   *
   * @return self
   *
   */
  public function setGuid($guid) {
    $this->guid = $guid;

    return $this;
  }

  /**
   * Liefert die Variable id
   *
   * @return int
   */
  public function getId() {
    return $this->id;
  }

  // ****************************************************************************

  /**
   * Setzt Variable id
   *
   * @param int $id
   *
   * @return self
   *
   */
  public function setId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Liefert die Variable landArea
   *
   * @return array
   */
  public function getLandArea() {
    return $this->landArea;
  }

  /**
   * Setzt Variable landArea
   *
   * @param array $landArea
   *
   * @return self
   *
   */
  public function setLandArea($landArea) {
    $this->landArea = $landArea;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable livingArea
   *
   * @return array
   */
  public function getLivingArea() {
    return $this->livingArea;
  }

  /**
   * Setzt Variable livingArea
   *
   * @param array $livingArea
   *
   * @return self
   *
   */
  public function setLivingArea($livingArea) {
    $this->livingArea = $livingArea;

    return $this;
  }

  /**
   * Liefert die Variable location
   *
   * @return array
   */
  public function getLocation() {
    return $this->location;
  }

  // ****************************************************************************

  /**
   * Setzt Variable location
   *
   * @param array $location
   *
   * @return self
   *
   */
  public function setLocation($location) {
    $this->location = $location;

    return $this;
  }

  /**
   * Liefert die Variable personsMax
   *
   * @return string
   */
  public function getPersonsMax() {
    return $this->personsMax;
  }

  /**
   * Setzt Variable personsMax
   *
   * @param string $personsMax
   *
   * @return self
   *
   */
  public function setPersonsMax($personsMax) {
    $this->personsMax = $personsMax;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable priceValues
   *
   * @return PriceValues
   */
  public function getPriceValues() {
    return $this->priceValues;
  }

  /**
   * Setzt Variable priceValues
   *
   * @param PriceValues $priceValues
   *
   * @return self
   *
   */
  public function setPriceValues(PriceValues $priceValues) {
    $this->priceValues = $priceValues;

    return $this;
  }

  /**
   * Liefert die Variable rooms
   *
   * @return int
   */
  public function getRooms() {
    return $this->rooms;
  }

  // ****************************************************************************

  /**
   * Setzt Variable rooms
   *
   * @param int $rooms
   *
   * @return self
   *
   */
  public function setRooms($rooms) {
    $this->rooms = $rooms;

    return $this;
  }

  /**
   * Liefert die Variable thumbnailUrl
   *
   * @return string
   */
  public function getThumbnailUrl() {
    return $this->thumbnailUrl ?: $this->configuration['defaultListImage'];
  }

  /**
   * Setzt Variable thumbnailUrl
   *
   * @param string $thumbnailUrl
   *
   * @return self
   *
   */
  public function setThumbnailUrl($thumbnailUrl) {
    $this->thumbnailUrl = $thumbnailUrl;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable title
   *
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Setzt Variable title
   *
   * @param string $title
   *
   * @return self
   *
   */
  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  /**
   * Liefert die Variable vacant
   *
   * @return string
   */
  public function getVacant() {
    return $this->vacant;
  }

  // ****************************************************************************

  /**
   * Setzt Variable vacant
   *
   * @param string $vacant
   *
   * @return self
   *
   */
  public function setVacant($vacant) {
    $this->vacant = $vacant;

    return $this;
  }

  /**
   * Settings kommen aus der Flexform
   *
   * @return bool
   */
  public function getIsPremium() {
    if (in_array($this->getOnlineId(), GeneralUtility::trimExplode(',', $this->settings['list']['properties']['premium']))) {
      return TRUE;
    }
    else {
      return FALSE;
    }

  }

  /**
   * Liefert die Variable onlineId
   *
   * @return string
   */
  public function getOnlineId() {
    return $this->onlineId;
  }

  // ****************************************************************************

  /**
   * Setzt Variable onlineId
   *
   * @param string $onlineId
   *
   * @return self
   *
   */
  public function setOnlineId($onlineId) {
    $this->onlineId = $onlineId;

    return $this;
  }

}