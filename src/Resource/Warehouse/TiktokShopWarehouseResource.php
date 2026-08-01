<?php

namespace Aftwork\TiktokShop\Resource\Warehouse;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Warehouse\WarehouseWithBody;
use Aftwork\TiktokShop\Request\Warehouse\WarehouseWithOutBody;

class TiktokShopWarehouseResource
{
    /**
     * Get Warehouse List
     * @throws \Exception
     */
    public function getWarehouses($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return WarehouseWithOutBody::makeGetMethod("GET", $baseUrl, "/api/warehouses", $params, $apiConfig);
    }

    /**
     * Get Warehouse Detail
     * @throws \Exception
     */
    public function getWarehouse($baseUrl, $warehouseId, TiktokShopConfig $apiConfig)
    {
        $params = ["warehouse_id" => $warehouseId];
        return WarehouseWithOutBody::makeGetMethod("GET", $baseUrl, "/api/warehouses/detail", $params, $apiConfig);
    }

    /**
     * Create Warehouse
     * @throws \Exception
     */
    public function createWarehouse($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return WarehouseWithBody::makeMethod("POST", $baseUrl, "/api/warehouses", [], $body, $apiConfig);
    }

    /**
     * Update Warehouse
     * @throws \Exception
     */
    public function updateWarehouse($baseUrl, $warehouseId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["warehouse_id" => $warehouseId];
        return WarehouseWithBody::makeMethod("PUT", $baseUrl, "/api/warehouses", $params, $body, $apiConfig);
    }

    /**
     * Delete Warehouse
     * @throws \Exception
     */
    public function deleteWarehouse($baseUrl, $warehouseId, TiktokShopConfig $apiConfig)
    {
        $params = ["warehouse_id" => $warehouseId];
        return WarehouseWithBody::makeMethod("DELETE", $baseUrl, "/api/warehouses", $params, [], $apiConfig);
    }

    /**
     * Get Warehouse Stock
     * @throws \Exception
     */
    public function getWarehouseStock($baseUrl, $warehouseId, $params, TiktokShopConfig $apiConfig)
    {
        $params["warehouse_id"] = $warehouseId;
        return WarehouseWithOutBody::makeGetMethod("GET", $baseUrl, "/api/warehouses/stock", $params, $apiConfig);
    }

    /**
     * Update Warehouse Stock
     * @throws \Exception
     */
    public function updateWarehouseStock($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return WarehouseWithBody::makeMethod("POST", $baseUrl, "/api/warehouses/stock/update", [], $body, $apiConfig);
    }

    /**
     * Get Warehouse Zones
     * @throws \Exception
     */
    public function getWarehouseZones($baseUrl, $warehouseId, TiktokShopConfig $apiConfig)
    {
        $params = ["warehouse_id" => $warehouseId];
        return WarehouseWithOutBody::makeGetMethod("GET", $baseUrl, "/api/warehouses/zones", $params, $apiConfig);
    }

    /**
     * Set Default Warehouse
     * @throws \Exception
     */
    public function setDefaultWarehouse($baseUrl, $warehouseId, TiktokShopConfig $apiConfig)
    {
        $body = ["warehouse_id" => $warehouseId, "is_default" => true];
        return WarehouseWithBody::makeMethod("POST", $baseUrl, "/api/warehouses/set_default", [], $body, $apiConfig);
    }

    /**
     * Get Warehouse Coverage Areas
     * @throws \Exception
     */
    public function getWarehouseCoverageAreas($baseUrl, $warehouseId, TiktokShopConfig $apiConfig)
    {
        $params = ["warehouse_id" => $warehouseId];
        return WarehouseWithOutBody::makeGetMethod("GET", $baseUrl, "/api/warehouses/coverage_areas", $params, $apiConfig);
    }

    /**
     * Update Warehouse Coverage Areas
     * @throws \Exception
     */
    public function updateWarehouseCoverageAreas($baseUrl, $warehouseId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["warehouse_id" => $warehouseId];
        return WarehouseWithBody::makeMethod("PUT", $baseUrl, "/api/warehouses/coverage_areas", $params, $body, $apiConfig);
    }
}
