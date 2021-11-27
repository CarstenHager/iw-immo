<?php

namespace IWAG\IwImmo\Controller;

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

use IWAG\IwImmo\Demand\ListsSearchDemand;
use IWAG\IwImmo\Service\Lists\EstatelistService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * List
 *
 * @author  Immowelt AG <support@immowelt.de>
 * @version 1.0 2014-10-09
 */
class ListController extends BaseController {

  /**
   * @param ListsSearchDemand $listsSearchDemand
   *
   * @return string
   */
  public function indexAction(ListsSearchDemand $listsSearchDemand = NULL) {
    if ($this->settings['list']['image'] > 0) {
      $resourceFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');
      $fileReference = $resourceFactory->getFileReferenceObject($this->settings['list']['image']);

      $this->view->assign('defaultListImage', $fileReference);

    }

    $this->view->assign('listsSearchDemand', $listsSearchDemand);
    $this->view->assign('service', $this->getListsService($listsSearchDemand));

    $content = $this->view->render();
    $content .= $this->getDisclaimer();
    return $content;
  }

  /**
   * @param ListsSearchDemand $listsSearchDemand
   *
   * @return EstatelistService
   */
  protected function getListsService(ListsSearchDemand $listsSearchDemand = NULL) {
    /** @var EstatelistService $listsService */
    $listsService = $this->objectManager->get('IWAG\IwImmo\Service\Lists\EstatelistService');

    if ($listsSearchDemand) {
      $this->initializeListServiceWithData($listsService, $listsSearchDemand);

      if ($listsSearchDemand->hasLocationRestriction()) {
        if (MathUtility::canBeInterpretedAsInteger($listsSearchDemand->getWhere())) {
          $listsService->setGeoid($listsSearchDemand->getWhere());
        }
        else {
          $listsService->setGeoid(
            $this->switchLocationResult($listsService, $listsSearchDemand)
          );
        }
      }
    }

    if (count($listsService->execute()) == 0) {
      $this->forward(
        'noResult',
        NULL,
        NULL,
        [
          'listsService' => $listsService,
          'listsSearchDemand' => $listsSearchDemand,
        ]
      );
    }

    return $listsService;
  }

  /**
   * @param EstatelistService $listsService
   * @param ListsSearchDemand $listsSearchDemand
   */
  protected function initializeListServiceWithData(EstatelistService &$listsService, ListsSearchDemand &$listsSearchDemand) {
    if ($listsSearchDemand->getEsr()) {
      $listsService->setEsr($listsSearchDemand->getEsr());
    }

    if ($listsSearchDemand->getGeoid()) {
      $listsService->setGeoid($listsSearchDemand->getGeoid());
    }

    if ($listsSearchDemand->getEtype()) {
      $listsService->setEtype($listsSearchDemand->getEtype());
    }

    if ($listsSearchDemand->getPrima()) {
      $listsService->setPrima($listsSearchDemand->getPrima());
    }

    if ($listsSearchDemand->getPrimi()) {
      $listsService->setPrimi($listsSearchDemand->getPrimi());
    }

    if ($listsSearchDemand->getRooma()) {
      $listsService->setRooma($listsSearchDemand->getRooma());
    }

    if ($listsSearchDemand->getRoomi()) {
      $listsService->setRoomi($listsSearchDemand->getRoomi());
    }
  }

  /**
   * @param EstatelistService $listsService
   * @param ListsSearchDemand $listsSearchDemand
   *
   * @return null
   * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
   */
  protected function switchLocationResult(EstatelistService &$listsService, ListsSearchDemand &$listsSearchDemand) {
    $locationsResult = $listsSearchDemand->getGeoDataForLocation();
    // genau ein ergebnis
    if (count($locationsResult) == 1) {
      $geoData = reset($locationsResult);
      return $geoData['geoId'];
    } // keine Ergebnisse
    elseif (count($locationsResult) == 0) {
      $this->forward(
        'noResult',
        NULL,
        NULL,
        [
          'listsService' => $listsService,
          'listsSearchDemand' => $listsSearchDemand,
        ]
      );
    } // mehr als ein ergebnis
    else {
      $this->forward(
        'multipleLocations',
        NULL,
        NULL,
        [
          'listsService' => $listsService,
          'listsSearchDemand' => $listsSearchDemand,
        ]
      );
    }
    return NULL;
  }

  /**
   * @param EstatelistService $listsService
   * @param ListsSearchDemand $listsSearchDemand
   */
  public function noResultAction(EstatelistService $listsService, ListsSearchDemand $listsSearchDemand = NULL) {
    $this->view->assign('listsSearchDemand', $listsSearchDemand);
    $this->view->assign('service', $listsService);
  }

  /**
   * @param EstatelistService $listsService
   * @param ListsSearchDemand $listsSearchDemand
   */
  public function multipleLocationsAction(EstatelistService $listsService, ListsSearchDemand $listsSearchDemand = NULL) {
    $this->view->assign('listsSearchDemand', $listsSearchDemand);
    $this->view->assign('service', $listsService);
  }

}