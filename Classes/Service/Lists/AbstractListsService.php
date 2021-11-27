<?php

namespace IWAG\IwImmo\Service\Lists;

use ArrayAccess;
use Countable;
use Iterator;
use IWAG\IwImmo\Service\AbstractApiService;

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
abstract class AbstractListsService extends AbstractApiService implements Countable, Iterator, ArrayAccess {

  /**
   * @var string
   */
  protected $serviceName = 'estate/lists';

  /**
   * @var string sorting
   */
  protected $sorting;

  /**
   * Liefert die Variable sorting
   *
   * @return string
   */
  public function getSorting() {
    return $this->sorting ?: $this->parameters['sort'];
  }

  /**
   * Setzt Variable sorting
   *
   * @param string $sorting
   *
   * @return self
   *
   */
  public function setSorting($sorting) {
    $this->sorting = $sorting;

    return $this;
  }

  // ****************************************************************************

  public function getResults(): array {
    return $this->results;
  }

  /**
   *
   *              \Countable
   *
   *
   */

  /**
   * @return int|void
   */
  public function count() {
    if (empty($this->results)) {
      $this->execute();
    }

    return $this->getTotalCount();
  }


  /**
   *
   *              \Iterator
   *
   *
   */


  /**
   * @return mixed|void
   */
  public function current() {
    if (empty($this->results)) {
      $this->execute();
    }

    return current($this->results);
  }

  /**
   *
   */
  public function next() {
    if (empty($this->results)) {
      $this->execute();
    }

    return next($this->results);
  }

  /**
   * @return mixed|void
   */
  public function key() {
    if (empty($this->results)) {
      $this->execute();
    }

    return key($this->results);
  }

  /**
   * @return bool|void
   */
  public function valid() {
    if (empty($this->results)) {
      $this->execute();
    }

    return current($this->results) !== FALSE;
  }

  /**
   *
   */
  public function rewind() {
    if (empty($this->results)) {
      $this->execute();
    }

    reset($this->results);
  }


  /**
   *
   *              \ArrayAccess
   *
   *
   */

  /**
   * @param int $offset
   *
   * @return bool|void
   */
  public function offsetExists($offset) {
    if (empty($this->results)) {
      $this->execute();
    }

    return isset($this->results[$offset]);
  }


  /**
   * @param int $offset
   *
   * @return mixed|void
   */
  public function offsetGet($offset) {
    if (empty($this->results)) {
      $this->execute();
    }

    return isset($this->results[$offset]) ? $this->results[$offset] : NULL;
  }

  /**
   * @param int $offset
   * @param mixed $value
   */
  public function offsetSet($offset, $value) {
    if (empty($this->results)) {
      $this->execute();
    }

    $this->results[$offset] = $value;
  }

  /**
   * @param int $offset
   */
  public function offsetUnset($offset) {
    if (empty($this->results)) {
      $this->execute();
    }

    unset($this->results[$offset]);
  }

}
