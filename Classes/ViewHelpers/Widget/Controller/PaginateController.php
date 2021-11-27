<?php

namespace IWAG\IwImmo\ViewHelpers\Widget\Controller;

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
class PaginateController extends \TYPO3\CMS\Fluid\ViewHelpers\Widget\Controller\PaginateController {

  /**
   * @var \IWAG\IwImmo\Service\Lists\AbstractListsService
   */
  protected $objects;

  /**
   * @param int $currentPage
   * @param string $sorting
   *
   */
  public function indexAction($currentPage = 1, $sorting = '') {
    // set current page
    $this->currentPage = (int) $currentPage;
    if ($this->currentPage < 1) {
      $this->currentPage = 1;
    }
    if ($this->currentPage > $this->numberOfPages) {
      // set $modifiedObjects to NULL if the page does not exist
      $modifiedObjects = NULL;
    }
    else {
      // modify query
      $itemsPerPage = (int) $this->configuration['itemsPerPage'];

      $this->objects->setLimit($itemsPerPage);

      if ($sorting != '') {
        $this->objects->setSorting($sorting);
      }

      if ($this->currentPage > 1) {
        $this->objects->setOffset((int) ($itemsPerPage * ($this->currentPage - 1)));
      }
      $modifiedObjects = $this->objects;
    }
    $this->view->assign('contentArguments', [
      $this->widgetConfiguration['as'] => $modifiedObjects,
    ]);
    $this->view->assign('configuration', $this->configuration);
    $this->view->assign('pagination', $this->buildPagination());
  }

  /**
   * @return array
   */
  protected function buildPagination() {
    $pagination = parent::buildPagination();

    $pagination['sorting'] = $this->objects->getSorting();
    $pagination['totalCount'] = $this->objects->getTotalCount();

    return $pagination;
  }

  // protected function prepareObjectsSlice($itemsPerPage, $offset)
  // {
  //     if ($this->objects instanceof AbstractListsService) {
  //         $this->objects = $this->objects->getResults();
  //     }

  //     return parent::prepareObjectsSlice($itemsPerPage, $offset);
  // }
}
