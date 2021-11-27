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

namespace IWAG\IwImmo\ViewHelpers\Widget;

use IWAG\IwImmo\ViewHelpers\Widget\Controller\AutocompleteController;

/**
 * Class AutocompleteViewHelper
 *
 * @package IWAG\IwImmo\ViewHelpers
 */
class AutocompleteViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Widget\AutocompleteViewHelper {

  /**
   * @var AutocompleteViewHelper
   */
  protected $controller;

  public function injectController(AutocompleteController $controller) {
    $this->controller = $controller;
  }

  public function initializeArguments() {
    parent::initializeArguments();
    $this->registerArgument('service', 'mixed', '', TRUE);
    $this->overrideArgument('objects', QueryResultInterface::class, 'Objects to auto-complete', FALSE);
    $this->overrideArgument('searchProperty', 'string', 'Property to search within when filtering list', FALSE);
  }

  public function render() {
    return $this->initiateSubRequest();
  }

}