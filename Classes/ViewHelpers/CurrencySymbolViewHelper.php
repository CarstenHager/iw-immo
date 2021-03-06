<?php

namespace IWAG\IwImmo\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

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
class CurrencySymbolViewHelper extends AbstractViewHelper {

  /**
   *
   * @return string
   */
  public function render()
  {
    $currency = $this->arguments['currency'];
    if ($currency == '') {
      $currency = $this->renderChildrenClosure;
    }
    switch ($currency) {
      case 'EUR':
        $currency = '€';
        break;

      // todo: welche noch?
    }
    return $currency;
  }

  public function initializeArguments(): void
  {
    parent::initializeArguments();
    $this->registerArgument('currency', 'string', '', false, '');
  }

}