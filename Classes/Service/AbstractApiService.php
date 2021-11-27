<?php

namespace IWAG\IwImmo\Service;

use ErrorException;
use IWAG\IwImmo\Service\Exception\ApiKeyMissingException;
use IWAG\IwImmo\Service\Exception\InvalidResultException;
use IWAG\IwImmo\Service\Exception\NoConnectionException;
use IWAG\IwImmo\Utility\ImmoUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
abstract class AbstractApiService {

  /**
   * @var ConfigurationManagerInterface
   */
  protected $configurationManager;

  /**
   * @var array
   */
  protected $settings = [];

  /**
   * @var string
   */
  protected $serviceName = '';

  /**
   * @var string
   */
  protected $functionName = '';

  /**
   * @var string
   */
  protected $itemObjectClassName = '';

  /**
   * @var array
   */
  protected $propertyObjectClassNames = [];

  /**
   * @var array
   */
  protected $configuration = [];

  /**
   * @var array
   */
  protected $parameters = [];

  /**
   * @var array
   */
  protected $defaultParameters = [];

  /**
   * @var array
   */
  protected $results = [];

  /**
   * @var bool
   */
  protected $resultIsCollection = TRUE;

  /**
   * @var \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface
   */
  protected $cache;

  /**
   * @var int limit
   */
  protected $limit = 10;

  /**
   * @var int offset
   */
  protected $offset = 0;

  /**
   * @var int count
   */
  protected $count = 0;

  /**
   * @var int totalCount
   */
  protected $totalCount = 0;

  // ****************************************************************************

  public function __construct(ConfigurationManagerInterface $configurationManager) {
    $this->configurationManager = $configurationManager;
    $this->configuration = GeneralUtility::removeDotsFromTS(
      GeneralUtility::makeInstance(ExtensionConfiguration::class)
        ->get('iw_immo')
    );

    if (!isset($this->configuration['apiKey']) || empty($this->configuration['apiKey'])) {
      throw new ApiKeyMissingException();
    }

    if (empty($this->serviceName)) {
      throw new ErrorException('Kein Service Name gesetzt in ' . __CLASS__, 1412920863);
    }

    if (empty($this->functionName)) {
      throw new ErrorException('Keine Service Function gesetzt in ' . __CLASS__, 1412920879);
    }

    $this->cache = ImmoUtility::getCache();

    $this->initializeDefaultConfig();
  }

  /**
   *
   */
  public function initializeDefaultConfig() {
    foreach ($this->defaultParameters as $parameterName => $parameterValue) {
      $setterName = 'set' . ucfirst($parameterName);

      if (method_exists($this, $setterName)) {
        $this->$setterName($parameterValue);
      }
      else {
        $this->parameters[$parameterName] = $parameterValue;
      }
    }

    $this->limit = 10;
  }

  /**
   *
   */
  public function initializeObject() {
    $this->settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);

    $this->settings = ImmoUtility::evaluateSettingsWithStdWrap($this->settings);
  }

  // ****************************************************************************

  /**
   * Setzt alle Daten zurück
   */
  public function reset() {
    $this->initializeDefaultConfig();
    $this->cache->flush();
  }

  /**
   * Liefert die Variable offset
   *
   * @return int
   */
  public function getOffset() {
    return $this->offset;
  }

  /**
   * Setzt Variable offset
   *
   * @param int $offset
   *
   * @return self
   *
   */
  public function setOffset($offset) {
    $this->offset = $offset;
    return $this;
  }

  // ****************************************************************************

  /**
   * Liefert die Variable count
   *
   * @return int
   */
  public function getCount() {
    $this->execute();
    return $this->count;
  }

  /**
   * Setzt Variable count
   *
   * @param int $count
   *
   * @return self
   *
   */
  public function setCount($count) {
    $this->count = $count;
    return $this;
  }

  /**
   *
   * @return array|object
   * @throws NoConnectionException
   * @throws InvalidResultException
   */
  public function execute() {

    $requestUrl = $this->buildRequestUrl();

    $cacheKey = md5($requestUrl);

    if ($this->cache->has($cacheKey)) {
      $resultData = $this->cache->get($cacheKey);
    }
    else {
      $result = GeneralUtility::getUrl($requestUrl, 0, $this->getRequestHeaders());

      // fehler beim aufruf
      if ($result === FALSE) {
        throw new NoConnectionException();
      }

      $resultArray = json_decode($result, TRUE);

      // fehler beim decodieren
      if (json_last_error() != JSON_ERROR_NONE) {
        throw new InvalidResultException();
      }

      $resultData = $this->getResultData($resultArray);
      $this->cache->set($cacheKey, $resultData);

    }

    $this->setTotalCount($resultData['totalCount']);
    $this->setCount($resultData['count']);
    $this->setOffset($resultData['offset']);

    $this->results = $resultData['results'];

    return $resultData['results'];
  }

  // ****************************************************************************

  /**
   *Erzeugt aus dem Parametern eine vollständige URL
   *
   *
   * @return string
   */
  protected function buildRequestUrl() {

    $parameterArray = [];

    foreach ($this->parameters as $key => $value) {
      // bool als string liefern
      if (is_bool($value)) {
        $parameterArray[$key] = $value ? 'true' : 'false';
      }
      elseif (!empty($value)) {
        $parameterArray[$key] = $value;
      }
    }

    $urlParts = [
      $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'],
      'rest',
      'v2.0',
      $this->serviceName,
      $this->functionName,
    ];

    $url = implode('/', $urlParts);

    return GeneralUtility::linkThisUrl($url, $parameterArray);

  }

  /**
   * @return array
   */
  protected function getRequestHeaders() {
    return [
      'Authorization: IW ' . $this->configuration['apiKey'],
      'Accept: application/json',
      'Content-Type: application/json',
    ];
  }

  /**
   * @param array $resultArray
   *
   * @return array
   */
  protected function getResultData(array $resultArray) {


    // ist browsable (estatelist etc)
    if (isset($resultArray['items'])) {
      $results = $this->mapResultItemsToObjects($resultArray['items']);
      $totalCount = $resultArray['totalCount'];
      $count = $resultArray['pageSize'];
      $offset = ($resultArray['currentPage'] - 1) * $this->getLimit();
    } // reine ergebnisse (autocomplete)
    else {
      if ($this->resultIsCollection) {
        $results = $this->mapResultItemsToObjects($resultArray);
        $totalCount = count($resultArray);
        $count = count($resultArray);
        $offset = 0;
      }
      else {
        $results = $this->mapSingleItemToObject($resultArray);
        $totalCount = 1;
        $count = 1;
        $offset = 0;
      }

    }

    return [
      'results' => $results,
      'totalCount' => $totalCount,
      'count' => $count,
      'offset' => $offset,
    ];
  }

  // ****************************************************************************

  /**
   * @param array $resultArray
   *
   * @return array
   */
  protected function mapResultItemsToObjects(array $resultArray) {
    if (empty($this->itemObjectClassName)) {
      return $resultArray;
    }
    else {
      $mappedResultArray = [];

      foreach ($resultArray as $key => $item) {
        $mappedObject = GeneralUtility::makeInstance($this->itemObjectClassName);
        $mappedObject->setSettings($this->settings);

        foreach ($item as $property => $value) {
          $setterName = 'set' . ucfirst($property);

          if (method_exists($mappedObject, $setterName)) {
            if (isset($this->propertyObjectClassNames[$property])) {
              $mappedObject->$setterName($this->mapPropertyToObject($property, $value));
            }
            else {
              $mappedObject->$setterName($value);
            }

          }

        }

        $mappedResultArray[] = $mappedObject;
      }

      return $mappedResultArray;
    }
  }

  /**
   * @param array $data
   *
   * @return object
   */
  protected function mapPropertyToObject($propertyName, array $data) {
    $objectClassName = $this->propertyObjectClassNames[$propertyName];

    $propertyObject = GeneralUtility::makeInstance($objectClassName);

    foreach ($data as $property => $value) {
      $setterName = 'set' . ucfirst($property);

      if (method_exists($propertyObject, $setterName)) {
        $propertyObject->$setterName($value);
      }
    }

    return $propertyObject;
  }

  /**
   * Liefert die Variable limit
   *
   * @return int
   */
  public function getLimit() {
    return $this->limit;
  }

  /**
   * Setzt Variable limit
   *
   * @param int $limit
   *
   * @return self
   *
   */
  public function setLimit($limit) {
    $this->limit = $limit;
    return $this;
  }

  /**
   * @param array $resultArray
   *
   * @return object
   */
  protected function mapSingleItemToObject(array $resultArray) {
    if (empty($this->itemObjectClassName)) {
      return $resultArray;
    }
    else {
      $mappedObject = GeneralUtility::makeInstance($this->itemObjectClassName);
      $mappedObject->setSettings($this->settings);

      foreach ($resultArray as $property => $value) {
        $setterName = 'set' . ucfirst($property);

        if (method_exists($mappedObject, $setterName)) {
          if (isset($this->propertyObjectClassNames[$property])) {
            $mappedObject->$setterName($this->mapPropertyToObject($property, $value));
          }
          else {
            $mappedObject->$setterName($value);
          }
        }
      }
      return $mappedObject;
    }
  }

  /**
   * Liefert die Variable totalCount
   *
   * @return int
   */
  public function getTotalCount() {
    $this->execute();
    return $this->totalCount;
  }

  /**
   * Setzt Variable totalCount
   *
   * @param int $totalCount
   *
   * @return self
   *
   */
  public function setTotalCount($totalCount) {
    $this->totalCount = $totalCount;
    return $this;
  }

}
