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

namespace IWAG\IwImmo\ResultObjects\Lists\Properties;

use IWAG\IwImmo\ResultObjects\AbstractResultProperty;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class PriceValues
 *
 * @package IWAG\IwImmo\Domain\Model\Property
 */
class PriceValues extends AbstractResultProperty {

  /**
   * @var string currency
   */
  protected $currency;

  /**
   * @var int price
   */
  protected $price;

  /**
   * @var bool priceSpecified
   */
  protected $priceSpecified;

  /**
   * @var string priceText
   */
  protected $priceText;

  // ****************************************************************************

  /**
   * @var int sqareMeterPrice
   */
  protected $sqareMeterPrice;

  /**
   * @var bool sqareMeterPriceSpecified
   */
  protected $sqareMeterPriceSpecified;

  /**
   * Liefert die Variable currency
   *
   * @return string
   */
  public function getCurrency() {
    return $this->currency;
  }

  // ****************************************************************************

  /**
   * Setzt Variable currency
   *
   * @param string $currency
   *
   * @return self
   *
   */
  public function setCurrency($currency) {
    $this->currency = $currency;

    return $this;
  }

  /**
   * @return string
   */
  public function getCurrencySymbol() {

    $symbol = '';

    switch ($this->currency) {
      case 'EUR':
        $symbol = '€';
        break;

    }

    return $symbol;
  }

  /**
   * Liefert die Variable price
   *
   * @return int
   */
  public function getPrice() {
    return $this->price;
  }

  // ****************************************************************************

  /**
   * Setzt Variable price
   *
   * @param int $price
   *
   * @return self
   *
   */
  public function setPrice($price) {
    $this->price = $price;

    return $this;
  }

  /**
   * Liefert die Variable priceSpecified
   *
   * @return bool
   */
  public function getPriceSpecified() {
    return $this->priceSpecified;
  }

  /**
   * Setzt Variable priceSpecified
   *
   * @param bool $priceSpecified
   *
   * @return self
   *
   */
  public function setPriceSpecified($priceSpecified) {
    $this->priceSpecified = $priceSpecified;

    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable priceText
   *
   * @return string
   */
  public function getPriceText() {
    return $this->priceText;
  }

  /**
   * Setzt Variable priceText
   *
   * @param string $priceText
   *
   * @return self
   *
   */
  public function setPriceText($priceText) {
    $this->priceText = $priceText;

    return $this;
  }

  /**
   * Liefert die Variable sqareMeterPrice
   *
   * @return int
   */
  public function getSqareMeterPrice() {
    return $this->sqareMeterPrice;
  }

  // ****************************************************************************

  /**
   * Setzt Variable sqareMeterPrice
   *
   * @param int $sqareMeterPrice
   *
   * @return self
   *
   */
  public function setSqareMeterPrice($sqareMeterPrice) {
    $this->sqareMeterPrice = $sqareMeterPrice;

    return $this;
  }

  /**
   * Liefert die Variable sqareMeterPriceSpecified
   *
   * @return bool
   */
  public function getSqareMeterPriceSpecified() {
    return $this->sqareMeterPriceSpecified;
  }

  /**
   * Setzt Variable sqareMeterPriceSpecified
   *
   * @param bool $sqareMeterPriceSpecified
   *
   * @return self
   *
   */
  public function setSqareMeterPriceSpecified($sqareMeterPriceSpecified) {
    $this->sqareMeterPriceSpecified = $sqareMeterPriceSpecified;

    return $this;
  }

  // ****************************************************************************


}