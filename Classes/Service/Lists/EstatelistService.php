<?php

namespace IWAG\IwImmo\Service\Lists;

use TYPO3\CMS\Core\Utility\ArrayUtility;

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

/**
 * Class EstatelistService
 *
 * @package IWAG\IwImmo\Service\Lists
 */
class EstatelistService extends AbstractListsService {

  /**
   * @var array
   */
  protected $defaultParameters = [
    'pattern' => 1,
    'bigimage' => TRUE,
  ];

  /**
   * @var string
   */
  protected $functionName = 'estatelist';

  /**
   * @var string
   */
  protected $itemObjectClassName = 'IWAG\IwImmo\ResultObjects\Lists\ListItem';

  /**
   * @var array
   */
  protected $propertyObjectClassNames = [
    'priceValues' => 'IWAG\IwImmo\ResultObjects\Lists\Properties\PriceValues',
  ];

  /**
   * @var bool customerprojects
   */
  protected $customerprojects;

  /**
   * @var bool includeiwobj
   */
  protected $includeiwobj = FALSE;

  /**
   * Default Parameter aus den Settings ergänzen
   */
  public function initializeObject() {
    parent::initializeObject();

    ArrayUtility::mergeRecursiveWithOverrule(
      $this->defaultParameters,
      $this->settings['list']['parameters']
    );
    $this->initializeDefaultConfig();
  }

  // ****************************************************************************

  /**
   * GeoID
   *
   * @param string $geoid
   *
   * @return self
   *
   */
  public function setGeoid($geoid) {
    $this->parameters['geoid'] = $geoid;

    return $this;
  }

  /**
   * @return string
   */
  public function getGeoid() {
    $this->parameters['geoid'];
  }

  // ****************************************************************************

  /**
   * Latitude / Breitengrad
   *
   * @param string $lat
   *
   * @return self
   *
   */
  public function setLat($lat) {
    $this->parameters['lat'] = $lat;

    return $this;
  }

  /**
   * @return string
   */
  public function getLat() {
    $this->parameters['lat'];
  }

  // ****************************************************************************

  /**
   * @param string $etypes
   *
   * @return self
   *
   */
  public function setEtypes($etypes) {
    $this->parameters['etypes'] = $etypes;

    return $this;
  }

  /**
   * @return string
   */
  public function getEtypes() {
    $this->parameters['etypes'];
  }

  // ****************************************************************************

  /**
   * Longitude / Längengrad
   *
   * @param string $lon
   *
   * @return self
   *
   */
  public function setLon($lon) {
    $this->parameters['lon'] = $lon;

    return $this;
  }

  /**
   * @return string
   */
  public function getLon() {
    $this->parameters['lon'];
  }

  // ****************************************************************************

  /**
   * Umkreis / Radius
   *
   * @param int $sr
   *
   * @return self
   *
   */
  public function setSr($sr) {
    $this->parameters['sr'] = $sr;

    return $this;
  }

  /**
   * @return int
   */
  public function getSr() {
    $this->parameters['sr'];
  }

  // ****************************************************************************

  /**
   * Immobilienart
   *
   * @param int $etype
   *
   * @return self
   *
   */
  public function setEtype($etype) {
    $this->parameters['etype'] = $etype;

    return $this;
  }

  /**
   * @return int
   */
  public function getEtype() {
    $this->parameters['etype'];
  }

  // ****************************************************************************

  /**
   * Immobilienkategorie
   *
   * @param int $ecat
   *
   * @return self
   *
   */
  public function setEcat($ecat) {
    $this->parameters['ecat'] = $ecat;

    return $this;
  }

  /**
   * @return int
   */
  public function getEcat() {
    $this->parameters['ecat'];
  }

  // ****************************************************************************

  /**
   * Mindestanzahl an Zimmern
   *
   * @param int $roomi
   *
   * @return self
   *
   */
  public function setRoomi($roomi) {
    $this->parameters['roomi'] = $roomi;

    return $this;
  }

  /**
   * @return int
   */
  public function getRoomi() {
    $this->parameters['roomi'];
  }

  // ****************************************************************************

  /**
   * Höchstanzahl an Zimmern
   *
   * @param int $rooma
   *
   * @return self
   *
   */
  public function setRooma($rooma) {
    $this->parameters['rooma'] = $rooma;

    return $this;
  }

  /**
   * @return int
   */
  public function getRooma() {
    $this->parameters['rooma'];
  }

  // ****************************************************************************

  /**
   * Minimaler Kaufpreis / Miete
   *
   * @param int $primi
   *
   * @return self
   *
   */
  public function setPrimi($primi) {
    $this->parameters['primi'] = $primi;

    return $this;
  }

  /**
   * @return int
   */
  public function getPrimi() {
    $this->parameters['primi'];
  }

  // ****************************************************************************

  /**
   * Maximaler Kaufpreis / Miete
   *
   * @param int $prima
   *
   * @return self
   *
   */
  public function setPrima($prima) {
    $this->parameters['prima'] = $prima;

    return $this;
  }

  /**
   * @return int
   */
  public function getPrima() {
    $this->parameters['prima'];
  }

  // ****************************************************************************

  /**
   * Minimale Fläche
   *
   * @param int $wflmi
   *
   * @return self
   *
   */
  public function setWflmi($wflmi) {
    $this->parameters['wflmi'] = $wflmi;

    return $this;
  }

  /**
   * @return int
   */
  public function getWflmi() {
    $this->parameters['wflmi'];
  }

  // ****************************************************************************

  /**
   * Maximale Fläche
   *
   * @param int $wflma
   *
   * @return self
   *
   */
  public function setWflma($wflma) {
    $this->parameters['wflma'] = $wflma;

    return $this;
  }

  /**
   * @return int
   */
  public function getWflma() {
    $this->parameters['wflma'];
  }

  // ****************************************************************************

  /**
   * Minimale Grundstücksfläche
   *
   * @param int $gflmi
   *
   * @return self
   *
   */
  public function setGflmi($gflmi) {
    $this->parameters['gflmi'] = $gflmi;

    return $this;
  }

  /**
   * @return int
   */
  public function getGflmi() {
    $this->parameters['gflmi'];
  }

  // ****************************************************************************

  /**
   * Maximale Grundstücksfläche
   *
   * @param int $gflma
   *
   * @return self
   *
   */
  public function setGflma($gflma) {
    $this->parameters['gflma'] = $gflma;

    return $this;
  }

  /**
   * @return int
   */
  public function getGflma() {
    $this->parameters['gflma'];
  }

  // ****************************************************************************

  /**
   * Minimaler Quadratmeter-Preis
   *
   * @param int $qprimi
   *
   * @return self
   *
   */
  public function setQprimi($qprimi) {
    $this->parameters['qprimi'] = $qprimi;

    return $this;
  }

  /**
   * @return int
   */
  public function getQprimi() {
    $this->parameters['qprimi'];
  }

  // ****************************************************************************

  /**
   * Maximale Quadratmeter-Preis
   *
   * @param int $qprima
   *
   * @return self
   *
   */
  public function setQprima($qprima) {
    $this->parameters['qprima'] = $qprima;

    return $this;
  }

  /**
   * @return int
   */
  public function getQprima() {
    $this->parameters['qprima'];
  }

  // ****************************************************************************

  /**
   * Minimale Fensterfront (Ladenflächen)
   *
   * @param int $fromi
   *
   * @return self
   *
   */
  public function setFromi($fromi) {
    $this->parameters['fromi'] = $fromi;

    return $this;
  }

  /**
   * @return int
   */
  public function getFromi() {
    $this->parameters['fromi'];
  }

  // ****************************************************************************

  /**
   * Maximale Fensterfront (Ladenflächen)
   *
   * @param int $froma
   *
   * @return self
   *
   */
  public function setFroma($froma) {
    $this->parameters['froma'] = $froma;

    return $this;
  }

  /**
   * @return int
   */
  public function getFroma() {
    $this->parameters['froma'];
  }

  // ****************************************************************************

  /**
   * Minimale x-fache Miete (Rendieteobjekte)
   *
   * @param int $xfami
   *
   * @return self
   *
   */
  public function setXfami($xfami) {
    $this->parameters['xfami'] = $xfami;

    return $this;
  }

  /**
   * @return int
   */
  public function getXfami() {
    $this->parameters['xfami'];
  }

  // ****************************************************************************

  /**
   * Maximale x-fache Miete (Rendieteobjekte)
   *
   * @param int $xfama
   *
   * @return self
   *
   */
  public function setXfama($xfama) {
    $this->parameters['xfama'] = $xfama;

    return $this;
  }

  /**
   * @return int
   */
  public function getXfama() {
    $this->parameters['xfama'];
  }

  // ****************************************************************************

  /**
   * 1: Kauf-Objekte 2: Miet-Objekte
   *
   * @param int $esr
   *
   * @return self
   *
   */
  public function setEsr($esr) {
    $this->parameters['esr'] = $esr;

    return $this;
  }

  /**
   * @return int
   */
  public function getEsr() {
    $this->parameters['esr'];
  }

  // ****************************************************************************

  /**
   * Lage des Objekts
   *
   * @param int $epos
   *
   * @return self
   *
   */
  public function setEpos($epos) {
    $this->parameters['epos'] = $epos;

    return $this;
  }

  /**
   * @return int
   */
  public function getEpos() {
    $this->parameters['epos'];
  }

  // ****************************************************************************

  /**
   * Ausstattungsmerkmale
   *
   * @param int $eqid
   *
   * @return self
   *
   */
  public function setEqid($eqid) {
    $this->parameters['eqid'] = $eqid;

    return $this;
  }

  /**
   * @return int
   */
  public function getEqid() {
    $this->parameters['eqid'];
  }

  // ****************************************************************************

  /**
   * Sortierung der Liste
   *
   * @param string $sort
   *
   * @return self
   *
   */
  public function setSort($sort) {
    $this->parameters['sort'] = $sort;

    $this->setSorting($sort);

    return $this;
  }

  /**
   * @return string
   */
  public function getSort() {
    $this->parameters['sort'];
  }

  // ****************************************************************************

  /**
   * Response-Templates für die ListItems
   *
   * @param int $pattern
   *
   * @return self
   *
   */
  public function setPattern($pattern) {
    $this->parameters['pattern'] = $pattern;

    return $this;
  }

  /**
   * @return int
   */
  public function getPattern() {
    $this->parameters['pattern'];
  }

  /**
   * Liefert die Variable customerprojects
   *
   * @return bool
   */
  public function getCustomerprojects() {
    return $this->parameters['customerprojects'];
  }

  // ****************************************************************************

  /**
   * Setzt Variable customerprojects
   *
   * @param bool $customerprojects
   *
   * @return self
   *
   */
  public function setCustomerprojects($customerprojects) {
    $this->parameters['customerprojects'] = (bool) $customerprojects;

    return $this;
  }

  /**
   * Liefert die Variable includeiwobj
   *
   * @return bool
   */
  public function getIncludeiwobj() {
    return $this->parameters['includeiwobj'];
  }

  /**
   * Setzt Variable includeiwobj
   *
   * @param bool $includeiwobj
   *
   * @return self
   *
   */
  public function setIncludeiwobj($includeiwobj) {
    $this->parameters['includeiwobj'] = (bool) $includeiwobj;

    return $this;
  }

  // ****************************************************************************

  /**
   * @param string $intranet
   *
   * @return self
   *
   */
  public function setIntranet($intranet) {
    $this->parameters['intranet'] = $intranet;

    return $this;
  }

  /**
   * @return string
   */
  public function getIntranet() {
    $this->parameters['intranet'];
  }

  // ****************************************************************************


  /**
   * @return array
   * @throws \IWAG\IwImmo\Service\Exception\InvalidResultException
   * @throws \IWAG\IwImmo\Service\Exception\NoConnectionException
   */
  public function execute() {

    $this->parameters['ps'] = $this->getLimit();
    $this->parameters['cp'] = ceil($this->getOffset() / $this->getLimit()) + 1;
    $this->parameters['sort'] = $this->getSorting();

    // diese parameter nur wenn customerprojects aktiviert
    if (!$this->parameters['customerprojects']) {
      $this->parameters['intranet'] = NULL;
      $this->parameters['includeiwobj'] = NULL;
    }

    return parent::execute();
  }

}
