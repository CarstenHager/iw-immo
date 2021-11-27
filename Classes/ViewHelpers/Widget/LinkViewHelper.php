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

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class LinkViewHelper
 *
 * @package IWAG\IwImmo\ViewHelpers\Widget
 */
class LinkViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Widget\LinkViewHelper {

  /**
   * @return string
   */
  protected function getWidgetUri() {
    $uriBuilder = $this->renderingContext->getControllerContext()->getUriBuilder();
    $argumentPrefix = $this->renderingContext->getControllerContext()->getRequest()
      ->getArgumentPrefix();
    $arguments = $this->hasArgument('arguments') ? $this->arguments['arguments'] : [];
    if ($this->hasArgument('action')) {
      $arguments['action'] = $this->arguments['action'];
    }
    if ($this->hasArgument('format') && $this->arguments['format'] !== '') {
      $arguments['format'] = $this->arguments['format'];
    }
    //			if ($this->hasArgument('addQueryStringMethod') && $this->arguments['addQueryStringMethod'] !== '') {
    //				$arguments['addQueryStringMethod'] = $this->arguments['addQueryStringMethod'];
    //			}

    if ($this->renderingContext->getControllerContext()->getRequest()->hasArgument('sorting')) {
      $arguments['sorting'] = $this->renderingContext->getControllerContext()->getRequest()
        ->getArgument('sorting');
    }

    // die formularparameter mit ausschließen
    $excludeArguments = [
      $argumentPrefix,
      'cHash',
      'tx_iwimmo_list[__referrer]',
      'tx_iwimmo_list[__trustedProperties]',
    ];

    return $uriBuilder->reset()
      ->setArguments([$argumentPrefix => $arguments])
      ->setSection($this->arguments['section'])
      ->setAddQueryString(TRUE)
      ->setAddQueryStringMethod($this->arguments['addQueryStringMethod'])
      ->setArgumentsToBeExcludedFromQueryString($excludeArguments)
      ->setFormat($this->arguments['format'])
      ->build();
  }

}