<?php

namespace IWAG\IwImmo\Service\Exception;

use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Frontend\Exception;

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
class ServiceException extends Exception {

  /**
   * @var array
   */
  protected $statusHeaders = [HttpUtility::HTTP_STATUS_503];

  /**
   * @var string
   */
  protected $message = 'Es ist ein Fehler aufgetreten.';

  /**
   * @return string
   */
  public function getStatusHeaders() {
    return $this->statusHeaders;
  }

}