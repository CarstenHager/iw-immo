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

namespace IWAG\IwImmo\Hooks;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class NewContentElementController
 *
 * @package IWAG\IwImmo\Hooks
 */
class NewContentElementController {

  /**
   * Processing the wizard items array
   *
   * @param array $wizardItems : The wizard items
   *
   * @return    array Modified array with wizard items
   */
  function proc(array $wizardItems) {

    $configuredPlugins = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['extensions']['IwImmo']['plugins'];

    foreach ($configuredPlugins as $key => $value) {
      $wizardItems['iwImmo_' . $key] = $this->getWizardConfigForPlugin($key);
    }

    return $wizardItems;
  }

  /**
   * @param $pluginKey
   *
   * @return array
   */
  protected function getWizardConfigForPlugin($pluginKey) {
    $config = [
      'icon' => 'EXT:iw_immo/ext_icon.gif',
      'title' => LocalizationUtility::translate('plugin.' . $pluginKey . '.wizardName', 'iw_immo'),
      'description' => LocalizationUtility::translate('plugin.' . $pluginKey . '.wizardDescription', 'iw_immo'),
      'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=iwimmo_' . $pluginKey,
    ];

    return $config;
  }

}
