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

namespace IWAG\IwImmo\Utility;

use TYPO3\CMS\Backend\Form\FormEngine;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class FlexformUtility
 *
 * @package IWAG\IwImmo\Utility
 */
class FlexformUtility {

  /**
   * @param array $config
   */
  public function getListsSorting(array &$config) {

    $config['items'][] = [
      LocalizationUtility::translate('sorting.default', 'IwImmo'),
      '',
    ];

    foreach (ImmoUtility::getListsSorting() as $key => $value) {
      $config['items'][] = [
        $value,
        $key,
      ];

    }
  }

  /**
   * @param array $config
   */
  public function getAvailableCountries(array &$config) {
    $config['items'][] = ['TS-Einstellung übernehmen', ''];
    foreach (ImmoUtility::getAvailableCountries() as $key => $value) {
      $config['items'][] = [
        $value,
        $key,
      ];
    }
  }

}