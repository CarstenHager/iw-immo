<?php

namespace IWAG\IwImmo\Utility;

use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
class ImmoUtility {

  /**
   * @return \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface
   * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException
   */
  public static function getCache() {
    static $apiCache = NULL;

    if (!$apiCache) {
      /** @var \TYPO3\CMS\Core\Cache\CacheManager $cacheManager */
      $cacheManager = GeneralUtility::makeInstance('TYPO3\CMS\Core\Cache\CacheManager');
      $apiCache = $cacheManager->getCache('iw_immo_api');
    }

    return $apiCache;
  }

  /**
   * @param array $settings
   *
   * @return array
   */
  public static function evaluateSettingsWithStdWrap(array $settings) {
    $settings['list']['parameters'] = self::evaluateArrayAsTypoScriptWithStdWrap($settings['list']['parameters']);
    $settings['list']['properties'] = self::evaluateArrayAsTypoScriptWithStdWrap($settings['list']['properties']);
    $settings['list']['pid'] = reset(self::evaluateArrayAsTypoScriptWithStdWrap([$settings['list']['pid']]));
    $settings['detail']['pid'] = reset(self::evaluateArrayAsTypoScriptWithStdWrap([$settings['detail']['pid']]));
    $settings['detail']['defaultExposeId'] = reset(self::evaluateArrayAsTypoScriptWithStdWrap([$settings['detail']['defaultExposeId']]));
    $settings['contact']['defaultExposeId'] = reset(self::evaluateArrayAsTypoScriptWithStdWrap([$settings['contact']['defaultExposeId']]));
    $settings['calculator']['pid'] = reset(self::evaluateArrayAsTypoScriptWithStdWrap([$settings['calculator']['pid']]));
    $settings['contact']['confirmation']['pid'] = reset(self::evaluateArrayAsTypoScriptWithStdWrap([$settings['contact']['confirmation']['pid']]));

    return $settings;
  }

  /**
   * @param array $array
   *
   * @return array
   */
  protected static function evaluateArrayAsTypoScriptWithStdWrap($array = []) {

    static $internalCache = [];
    $internalCacheKey = md5(serialize($array));

    if (isset($internalCache[$internalCacheKey])) {
      $evaluated = $internalCache[$internalCacheKey];
    }
    else {
      $evaluated = $array;

      $settingsAsTs = self::getTypoScriptService()
        ->convertPlainArrayToTypoScriptArray((array) $array);

      foreach ($settingsAsTs as $key => $value) {

        $key = rtrim($key, '.');

        if (isset($settingsAsTs[$key . '.'])) {
          $evaluated[$key] = self::getCObject()
            ->stdWrap($settingsAsTs[$key], $settingsAsTs[$key . '.']);
        }
      }

      $internalCache[$internalCacheKey] = $evaluated;
    }


    return $evaluated;
  }

  /**
   * @return \TYPO3\CMS\Core\TypoScript\TypoScriptService
   */
  protected static function getTypoScriptService(): TypoScriptService {
    /** @var \TYPO3\CMS\Core\TypoScript\TypoScriptService $typoscriptService */
    static $typoscriptService = NULL;
    if ($typoscriptService == NULL) {
      $typoscriptService = GeneralUtility::makeInstance(TypoScriptService::class);
    }

    return $typoscriptService;
  }

  /**
   * @return \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
   */
  protected static function getCObject() {
    if (TYPO3_MODE == 'FE') {
      $cObj = $GLOBALS['TSFE']->cObj;
    }
    else {
      $cObj = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
    }

    return $cObj;
  }

  /**
   * @param int $etype
   *
   * @return string
   */
  public static function getEtypeName($etype) {
    $etypeArray = self::getEtypes();
    return $etypeArray[$etype] ?: '';
  }

  /**
   * @return array
   */
  public static function getEtypes() {
    return [
      0 => 'alle',
      1 => 'Wohnungen',
      2 => 'Häuser',
      3 => 'Grundstücke',
      4 => 'Büro-/Praxisflächen',
      5 => 'Ladenflächen',
      6 => 'Hallen/Industrieflächen',
      7 => 'Gewerbe-Grundstücke',
      8 => 'Renditeobjekte',
      9 => 'Sonstiges',
      10 => 'Gastronomie/Hotels',
      11 => 'Land-/Forstwirtschaft',
      12 => 'Ferienimmobilien',
      13 => 'Garage/Stellplatz',
      15 => 'Wohnen auf Zeit',
      16 => 'Wohngemeinschaften',
      17 => 'Typenhäuser',
      19 => 'Dachflächen',
    ];
  }

  /**
   * @param int $esr
   *
   * @return string
   */
  public static function getEsrName($esr) {
    $esrArray = self::getEsr();
    return $esrArray[$esr] ?: '';
  }

  /**
   * @return array
   */
  public static function getEsr() {
    return [
      0 => 'alle',
      1 => 'Kauf-Objekte',
      2 => 'Miet-Objekte',
    ];
  }

  /**
   * @return array
   */
  public static function getListsSorting() {
    return [
      'createdate desc' => LocalizationUtility::translate('sorting.createdate_desc', 'IwImmo'),
      'price' => LocalizationUtility::translate('sorting.price', 'IwImmo'),
      'price desc' => LocalizationUtility::translate('sorting.price_desc', 'IwImmo'),
      'wohnflaeche' => LocalizationUtility::translate('sorting.wohnflaeche', 'IwImmo'),
      'wohnflaeche desc' => LocalizationUtility::translate('sorting.wohnflaeche_desc', 'IwImmo'),
      'city' => LocalizationUtility::translate('sorting.city', 'IwImmo'),
      'city desc' => LocalizationUtility::translate('sorting.city_desc', 'IwImmo'),
    ];
  }

  /**
   * @return array
   */
  public static function getAvailableCountries() {
    return [
      '108' => LocalizationUtility::translate('settings.list.parameters.geoid.108', 'IwImmo'),
      '104' => LocalizationUtility::translate('settings.list.parameters.geoid.104', 'IwImmo'),
      '107' => LocalizationUtility::translate('settings.list.parameters.geoid.107', 'IwImmo'),
      '110' => LocalizationUtility::translate('settings.list.parameters.geoid.110', 'IwImmo'),
      '111' => LocalizationUtility::translate('settings.list.parameters.geoid.111', 'IwImmo'),
      '112' => LocalizationUtility::translate('settings.list.parameters.geoid.112', 'IwImmo'),
      '114' => LocalizationUtility::translate('settings.list.parameters.geoid.114', 'IwImmo'),
      '115' => LocalizationUtility::translate('settings.list.parameters.geoid.115', 'IwImmo'),
      '113' => LocalizationUtility::translate('settings.list.parameters.geoid.113', 'IwImmo'),
      '118' => LocalizationUtility::translate('settings.list.parameters.geoid.118', 'IwImmo'),
      '126' => LocalizationUtility::translate('settings.list.parameters.geoid.126', 'IwImmo'),
      '127' => LocalizationUtility::translate('settings.list.parameters.geoid.127', 'IwImmo'),
      '103' => LocalizationUtility::translate('settings.list.parameters.geoid.103', 'IwImmo'),
      '128' => LocalizationUtility::translate('settings.list.parameters.geoid.128', 'IwImmo'),
      '134' => LocalizationUtility::translate('settings.list.parameters.geoid.134', 'IwImmo'),
      '136' => LocalizationUtility::translate('settings.list.parameters.geoid.136', 'IwImmo'),
      '137' => LocalizationUtility::translate('settings.list.parameters.geoid.137', 'IwImmo'),
      '138' => LocalizationUtility::translate('settings.list.parameters.geoid.138', 'IwImmo'),
      '139' => LocalizationUtility::translate('settings.list.parameters.geoid.139', 'IwImmo'),
    ];
  }

}