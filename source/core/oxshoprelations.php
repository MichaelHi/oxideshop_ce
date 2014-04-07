<?php
/**
 * This file is part of OXID eShop Community Edition.
 *
 * OXID eShop Community Edition is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eShop Community Edition is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2014
 * @version   OXID eShop CE
 */

class oxShopRelations
{

    /**
     * Database gateway.
     *
     * @var oxShopRelationsDbGateway
     */
    protected $_oDbGateway = null;

    /**
     * List of shop IDs
     *
     * @var array
     */
    protected $_aShopIds = array();

    /**
     * Sets shop IDs on initialisation.
     *
     * @param int|array $aShopIds Shop ID or list of shop IDs.
     */
    public function __construct($aShopIds)
    {
        $this->setShopIds($aShopIds);
    }

    /**
     * Sets database gateway.
     *
     * @param oxShopRelationsDbGateway $oDb Database gateway.
     */
    public function setDbGateway($oDb)
    {
        $this->_oDbGateway = $oDb;
    }

    /**
     * Gets database gateway.
     *
     * @return oxShopRelationsDbGateway
     */
    public function getDbGateway()
    {
        if (is_null($this->_oDbGateway)) {
            $oShopRelationsDbGateway = oxNew('oxShopRelationsDbGateway');
            $this->setDbGateway($oShopRelationsDbGateway);
        }

        return $this->_oDbGateway;
    }

    /**
     * Sets shop ID or list of shop IDs.
     *
     * @param int|array $aShopIds Shop ID or list of shop IDs.
     */
    public function setShopIds($aShopIds)
    {
        if (!is_array($aShopIds)) {
            $aShopIds = array($aShopIds);
        }

        $this->_aShopIds = $aShopIds;
    }

    /**
     * Gets shop ID or list of shop IDs.
     *
     * @return array
     */
    public function getShopIds()
    {
        return $this->_aShopIds;
    }

    /**
     * Adds item to shop or list of shops.
     *
     * @param int    $iItemId   Item ID
     * @param string $sItemType Item type
     */
    public function addToShop($iItemId, $sItemType)
    {
        foreach ($this->getShopIds() as $iShopId) {
            $this->getDbGateway()->addToShop($iItemId, $sItemType, $iShopId);
        }
    }

    /**
     * Removes item from shop or list of shops.
     *
     * @param int    $iItemId   Item ID
     * @param string $sItemType Item type
     */
    public function removeFromShop($iItemId, $sItemType)
    {
        foreach ($this->getShopIds() as $iShopId) {
            $this->getDbGateway()->removeFromShop($iItemId, $sItemType, $iShopId);
        }
    }

    /**
     * Inherits items by type to sub shop(-s) from parent shop.
     *
     * @param int    $iParentShopId Parent shop ID
     * @param string $sItemType     Item type
     */
    public function inheritFromShop($iParentShopId, $sItemType)
    {
        foreach ($this->getShopIds() as $iSubShopId) {
            $this->getDbGateway()->inheritFromShop($iParentShopId, $iSubShopId, $sItemType);
        }
    }

    /**
     * Removes items by type from sub shop(-s) that were inherited from parent shop.
     *
     * @param int    $iParentShopId Parent shop ID
     * @param string $sItemType     Item type
     */
    public function removeInheritedFromShop($iParentShopId, $sItemType)
    {
        foreach ($this->getShopIds() as $iSubShopId) {
            $this->getDbGateway()->removeInheritedFromShop($iParentShopId, $iSubShopId, $sItemType);
        }
    }
}