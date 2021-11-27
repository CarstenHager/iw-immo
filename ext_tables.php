<?php
/* * *******************************************************************************************************************
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
 *
 * *********************************************************************************************************************
 *
 * @author Immowelt AG <support@immowelt.de>
 *
 * ****************************************************************************************************************** */


$extensionName = TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('iw_immo');

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('iw_immo', 'Configuration/TypoScript', 'iw_immo');

// Suche
TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('iw_immo', 'search', 'LLL:EXT:iw_immo/Resources/Private/Language/locallang.xlf:plugin.search.label');
$pluginSignature = strtolower($extensionName) . '_search';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . 'iw_immo' . '/Configuration/FlexForms/Search.xml');

// Liste
TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('iw_immo', 'list', 'LLL:EXT:iw_immo/Resources/Private/Language/locallang.xlf:plugin.list.label');
$pluginSignature = strtolower($extensionName) . '_list';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . 'iw_immo' . '/Configuration/FlexForms/List.xml');

// Detail
TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('iw_immo', 'detail', 'LLL:EXT:iw_immo/Resources/Private/Language/locallang.xlf:plugin.detail.label');
$pluginSignature = strtolower($extensionName) . '_detail';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . 'iw_immo' . '/Configuration/FlexForms/Detail.xml');

// Contact
TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('iw_immo', 'contact', 'LLL:EXT:iw_immo/Resources/Private/Language/locallang.xlf:plugin.contact.label');
$pluginSignature = strtolower($extensionName) . '_contact';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . 'iw_immo' . '/Configuration/FlexForms/Contact.xml');

// Rechner
TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('iw_immo', 'calculator', 'LLL:EXT:iw_immo/Resources/Private/Language/locallang.xlf:plugin.calculator.label');
$pluginSignature = strtolower($extensionName) . '_calculator';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . 'iw_immo' . '/Configuration/FlexForms/Calculator.xml');

// iwcontent direkt bei plugin hinzufügen als icon anzeigen
if (TYPO3_MODE == 'BE') {
  TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '
			mod.wizards.newContentElement.wizardItems {
				iwImmo {
					show = *
					header = LLL:EXT:iw_immo/Resources/Private/Language/locallang.xlf:plugin.wizardLabel
				}
			}
			'
  );

  $GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['IWAG\IwImmo\Hooks\NewContentElementController'] = TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('iw_immo') . 'Classes/Hooks/NewContentElementController.php';
}