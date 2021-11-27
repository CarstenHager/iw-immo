<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014
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

namespace IWAG\IwImmo\ResultObjects\Exposes;

use IWAG\IwImmo\ResultObjects\AbstractResultObject;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ExposeItem
 *
 * @package IWAG\IwImmo\ResultObjects\Exposes
 */
class Expose extends AbstractResultObject {

  /**
   * @var array adressFormRequiredFields
   */
  protected $adressFormRequiredFields;

  /**
   * @var array attachments
   */
  protected $attachments;

  /**
   * @var string commission
   */
  protected $commission;

  // ****************************************************************************

  /**
   * @var int createDate
   */
  protected $createDate;

  /**
   * @var array descriptions
   */
  protected $descriptions;

  /**
   * @var array energyPerformanceList
   */
  protected $energyPerformanceList;

  // ****************************************************************************

  /**
   * @var array equipment
   */
  protected $equipment;

  /**
   * @var string externalLink
   */
  protected $externalLink;

  /**
   * @var array financeCalculator
   */
  protected $financeCalculator;

  // ****************************************************************************

  /**
   * @var string floor
   */
  protected $floor;

  /**
   * @var array geoData
   */
  protected $geoData;

  /**
   * @var string id
   */
  protected $id;

  // ****************************************************************************

  /**
   * @var array images
   */
  protected $images;

  /**
   * @var bool isFurnitured
   */
  protected $isFurnitured;

  /**
   * @var string landArea
   */
  protected $landArea;


  // ****************************************************************************

  /**
   * @var string livingArea
   */
  protected $livingArea;

  /**
   * @var array location
   */
  protected $location;

  /**
   * @var array category
   */
  protected $category;

  // ****************************************************************************

  /**
   * @var array offerContact
   */
  protected $offerContact;

  /**
   * @var string onlineId
   */
  protected $onlineId;

  /**
   * @var int parkingSlots
   */
  protected $parkingSlots;

  // ****************************************************************************

  /**
   * @var int personsMax
   */
  protected $personsMax;

  /**
   * @var string preferredRoommateGender
   */
  protected $preferredRoommateGender;

  /**
   * @var array price
   */
  protected $price;

  // ****************************************************************************

  /**
   * @var string referenceNumber
   */
  protected $referenceNumber;

  /**
   * @var string rentFactor
   */
  protected $rentFactor;

  /**
   * @var string rentTimeMin
   */
  protected $rentTimeMin;

  // ****************************************************************************

  /**
   * @var float rooms
   */
  protected $rooms;

  /**
   * @var int seatCount
   */
  protected $seatCount;

  /**
   * @var string title
   */
  protected $title;

  // ****************************************************************************

  /**
   * @var string vacant
   */
  protected $vacant;

  /**
   * @var string windowFront
   */
  protected $windowFront;

  /**
   * @var string guid
   */
  protected $guid;

  // ****************************************************************************

  /**
   * Liefert die Variable attachments
   *
   * @return array
   */
  public function getAttachments() {
    return $this->attachments;
  }

  /**
   * Setzt Variable attachments
   *
   * @var array $attachments
   *
   * @return self
   */
  public function setAttachments($attachments) {
    $this->attachments = $attachments;

    return $this;
  }

  /**
   * Liefert die Variable commission
   *
   * @return string
   */
  public function getCommission() {
    return $this->commission;
  }

  // ****************************************************************************

  /**
   * Setzt Variable commission
   *
   * @var string $commission
   *
   * @return self
   */
  public function setCommission($commission) {
    $this->commission = $commission;

    return $this;
  }

  /**
   * Liefert die Variable createDate
   *
   * @return int
   */
  public function getCreateDate() {
    return $this->createDate;
  }

  /**
   * Setzt Variable createDate
   *
   * @var int $createDate
   *
   * @return self
   */
  public function setCreateDate($createDate) {
    $this->createDate = $createDate;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable descriptions
   *
   * @return array
   */
  public function getDescriptions() {
    return $this->descriptions;
  }

  /**
   * Setzt Variable descriptions
   *
   * @var array $descriptions
   *
   * @return self
   */
  public function setDescriptions($descriptions) {
    $this->descriptions = $descriptions;

    return $this;
  }

  /**
   * Liefert die Variable energyPerformanceList
   *
   * @return array
   */
  public function getEnergyPerformanceList() {
    return $this->energyPerformanceList;
  }

  // ****************************************************************************

  /**
   * Setzt Variable energyPerformanceList
   *
   * @var array $energyPerformanceList
   *
   * @return self
   */
  public function setEnergyPerformanceList($energyPerformanceList) {
    $this->energyPerformanceList = $energyPerformanceList;

    return $this;
  }

  /**
   * Liefert die Variable equipment
   *
   * @return array
   */
  public function getEquipment() {
    return $this->equipment;
  }

  /**
   * Setzt Variable equipment
   *
   * @var array $equipment
   *
   * @return self
   */
  public function setEquipment($equipment) {
    $this->equipment = $equipment;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable externalLink
   *
   * @return string
   */
  public function getExternalLink() {
    return $this->externalLink;
  }

  /**
   * Setzt Variable externalLink
   *
   * @var string $externalLink
   *
   * @return self
   */
  public function setExternalLink($externalLink) {
    $this->externalLink = $externalLink;

    return $this;
  }

  /**
   * Liefert die Variable financeCalculator
   *
   * @return array
   */
  public function getFinanceCalculator() {
    return $this->financeCalculator;
  }

  // ****************************************************************************

  /**
   * Setzt Variable financeCalculator
   *
   * @var array $financeCalculator
   *
   * @return self
   */
  public function setFinanceCalculator($financeCalculator) {
    $this->financeCalculator = $financeCalculator;

    return $this;
  }

  /**
   * Liefert die Variable floor
   *
   * @return string
   */
  public function getFloor() {
    return $this->floor;
  }

  /**
   * Setzt Variable floor
   *
   * @var string $floor
   *
   * @return self
   */
  public function setFloor($floor) {
    $this->floor = $floor;

    return $this;
  }

  // ****************************************************************************

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
   * @var array $geoData
   *
   * @return self
   */
  public function setGeoData($geoData) {
    $this->geoData = $geoData;

    return $this;
  }

  /**
   * Liefert die Variable id
   *
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  // ****************************************************************************

  /**
   * Setzt Variable id
   *
   * @var string $id
   *
   * @return self
   */
  public function setId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Liefert die Variable images
   *
   * @return array
   */
  public function getImages() {
    return $this->images;
  }

  /**
   * Setzt Variable images
   *
   * @var array $images
   *
   * @return self
   */
  public function setImages($images) {
    $this->images = $images;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable isFurnitured
   *
   * @return bool
   */
  public function getIsFurnitured() {
    return $this->isFurnitured;
  }

  /**
   * Setzt Variable isFurnitured
   *
   * @var bool $isFurnitured
   *
   * @return self
   */
  public function setIsFurnitured($isFurnitured) {
    $this->isFurnitured = $isFurnitured;

    return $this;
  }

  /**
   * Liefert die Variable landArea
   *
   * @return string
   */
  public function getLandArea() {
    return $this->landArea;
  }

  // ****************************************************************************

  /**
   * Setzt Variable landArea
   *
   * @var string $landArea
   *
   * @return self
   */
  public function setLandArea($landArea) {
    $this->landArea = $landArea;

    return $this;
  }

  /**
   * Liefert die Variable livingArea
   *
   * @return string
   */
  public function getLivingArea() {
    return $this->livingArea;
  }

  /**
   * Setzt Variable livingArea
   *
   * @var string $livingArea
   *
   * @return self
   */
  public function setLivingArea($livingArea) {
    $this->livingArea = $livingArea;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable location
   *
   * @return array
   */
  public function getLocation() {
    return $this->location;
  }

  /**
   * Setzt Variable location
   *
   * @var array $location
   *
   * @return self
   */
  public function setLocation($location) {
    $this->location = $location;

    return $this;
  }

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
   * Liefert die Variable offerContact
   *
   * @return array
   */
  public function getOfferContact() {
    return $this->offerContact;
  }

  /**
   * Setzt Variable offerContact
   *
   * @var array $offerContact
   *
   * @return self
   */
  public function setOfferContact($offerContact) {
    $this->offerContact = $offerContact;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable onlineId
   *
   * @return string
   */
  public function getOnlineId() {
    return $this->onlineId;
  }

  /**
   * Setzt Variable onlineId
   *
   * @var string $onlineId
   *
   * @return self
   */
  public function setOnlineId($onlineId) {
    $this->onlineId = $onlineId;

    return $this;
  }

  /**
   * Liefert die Variable parkingSlots
   *
   * @return int
   */
  public function getParkingSlots() {
    return $this->parkingSlots;
  }

  // ****************************************************************************

  /**
   * Setzt Variable parkingSlots
   *
   * @var int $parkingSlots
   *
   * @return self
   */
  public function setParkingSlots($parkingSlots) {
    $this->parkingSlots = $parkingSlots;

    return $this;
  }

  /**
   * Liefert die Variable personsMax
   *
   * @return int
   */
  public function getPersonsMax() {
    return $this->personsMax;
  }

  /**
   * Setzt Variable personsMax
   *
   * @var int $personsMax
   *
   * @return self
   */
  public function setPersonsMax($personsMax) {
    $this->personsMax = $personsMax;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable preferredRoommateGender
   *
   * @return string
   */
  public function getPreferredRoommateGender() {
    return $this->preferredRoommateGender;
  }

  /**
   * Setzt Variable preferredRoommateGender
   *
   * @var string $preferredRoommateGender
   *
   * @return self
   */
  public function setPreferredRoommateGender($preferredRoommateGender) {
    $this->preferredRoommateGender = $preferredRoommateGender;

    return $this;
  }

  /**
   * Liefert die Variable price
   *
   * @return array
   */
  public function getPrice() {
    return $this->price;
  }

  // ****************************************************************************

  /**
   * Setzt Variable price
   *
   * @var array $price
   *
   * @return self
   */
  public function setPrice($price) {
    $this->price = $price;

    return $this;
  }

  /**
   * Liefert die Variable referenceNumber
   *
   * @return string
   */
  public function getReferenceNumber() {
    return $this->referenceNumber;
  }

  /**
   * Setzt Variable referenceNumber
   *
   * @var string $referenceNumber
   *
   * @return self
   */
  public function setReferenceNumber($referenceNumber) {
    $this->referenceNumber = $referenceNumber;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable rentFactor
   *
   * @return string
   */
  public function getRentFactor() {
    return $this->rentFactor;
  }

  /**
   * Setzt Variable rentFactor
   *
   * @var string $rentFactor
   *
   * @return self
   */
  public function setRentFactor($rentFactor) {
    $this->rentFactor = $rentFactor;

    return $this;
  }

  /**
   * Liefert die Variable rentTimeMin
   *
   * @return string
   */
  public function getRentTimeMin() {
    return $this->rentTimeMin;
  }

  // ****************************************************************************

  /**
   * Setzt Variable rentTimeMin
   *
   * @var string $rentTimeMin
   *
   * @return self
   */
  public function setRentTimeMin($rentTimeMin) {
    $this->rentTimeMin = $rentTimeMin;

    return $this;
  }

  /**
   * Liefert die Variable rooms
   *
   * @return float
   */
  public function getRooms() {
    return $this->rooms;
  }

  /**
   * Setzt Variable rooms
   *
   * @var float $rooms
   *
   * @return self
   */
  public function setRooms($rooms) {
    $this->rooms = $rooms;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable seatCount
   *
   * @return int
   */
  public function getSeatCount() {
    return $this->seatCount;
  }

  /**
   * Setzt Variable seatCount
   *
   * @var int $seatCount
   *
   * @return self
   */
  public function setSeatCount($seatCount) {
    $this->seatCount = $seatCount;

    return $this;
  }

  /**
   * Liefert die Variable title
   *
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  // ****************************************************************************

  /**
   * Setzt Variable title
   *
   * @var string $title
   *
   * @return self
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

  /**
   * Setzt Variable vacant
   *
   * @var string $vacant
   *
   * @return self
   */
  public function setVacant($vacant) {
    $this->vacant = $vacant;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable windowFront
   *
   * @return string
   */
  public function getWindowFront() {
    return $this->windowFront;
  }

  /**
   * Setzt Variable windowFront
   *
   * @var string $windowFront
   *
   * @return self
   */
  public function setWindowFront($windowFront) {
    $this->windowFront = $windowFront;

    return $this;
  }

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
   * @var string $guid
   *
   * @return self
   */
  public function setGuid($guid) {
    $this->guid = $guid;

    return $this;
  }

  /**
   * @return int
   */
  public function getImagesCount() {
    return count($this->images);
  }

  /**
   * @return array
   */
  public function getRequiredFormFields() {

    $requiredFields = [];

    foreach ($this->getAdressFormRequiredFields() as $fieldConfig) {
      $requiredFields[lcfirst($fieldConfig['fieldName'])] = [
        'required' => TRUE,
        'fieldId' => $fieldConfig['fieldId'],
      ];
    }


    return $requiredFields;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable adressFormRequiredFields
   *
   * @return array
   */
  public function getAdressFormRequiredFields() {
    return $this->adressFormRequiredFields;
  }

  // ****************************************************************************

  /**
   * Setzt Variable adressFormRequiredFields
   *
   * @var array $adressFormRequiredFields
   *
   * @return self
   */
  public function setAdressFormRequiredFields($adressFormRequiredFields) {
    $this->adressFormRequiredFields = $adressFormRequiredFields;

    return $this;
  }

  // ****************************************************************************

  /**
   * @return bool
   */
  public function getHasAdditionalLinks() {
    return $this->financeCalculator['visible'] || count($this->attachments) || count($this->externalLink);
  }

  /**
   * @return float
   */
  public function getFloatPrice() {
    $tempPrice = GeneralUtility::trimExplode(',', $this->price['price']);
    return (float) str_replace('.', '', $tempPrice[0]);
  }

}