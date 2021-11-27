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

namespace IWAG\IwImmo\Property\TypeConverter;

use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;


if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}

/**
 * Class ListsSearchDemandConverter
 *
 * @package IWAG\IwImmo\Property\TypeConverter
 */
class ListsSearchDemandConverter extends AbstractTypeConverter {

  /**
   * @var array
   */
  protected $sourceTypes = ['array'];

  /**
   * @var string
   */
  protected $targetType = 'IWAG\IwImmo\Demand\ListsSearchDemand';

  /**
   *
   * @param mixed $source
   * @param string $targetType
   * @param array $convertedChildProperties
   * @param PropertyMappingConfigurationInterface $configuration
   *
   * @return mixed|void
   */
  public function convertFrom($source, string $targetType, array $convertedChildProperties = [], PropertyMappingConfigurationInterface $configuration = NULL) {
    /**
     * @var \IWAG\IwImmo\Demand\ListsSearchDemand $targetObject
     */
    $targetObject = $this->objectManager->get($targetType);

    foreach ($source as $property => $value) {

      $setterName = 'set' . ucfirst($property);

      if (method_exists($targetObject, $setterName)) {
        $targetObject->$setterName($value);
      }
    }

    return $targetObject;
  }

}