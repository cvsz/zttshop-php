<?php

namespace Aftwork\TiktokShop\Resource\Logistics;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Logistics\LogisticsWithBody;
use Aftwork\TiktokShop\Request\Logistics\LogisticsWithOutBody;

class TiktokShopLogisticsResource
{
    /**
     * Get Shipping Providers
     * @throws \Exception
     */
    public function getShippingProviders($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithOutBody::makeGetMethod("GET", $baseUrl, "/api/logistics/shipping_providers", $params, $apiConfig);
    }

    /**
     * Get Tracking Info
     * @throws \Exception
     */
    public function getTrackingInfo($baseUrl, $trackingNumber, TiktokShopConfig $apiConfig)
    {
        $params = ["tracking_number" => $trackingNumber];
        return LogisticsWithOutBody::makeGetMethod("GET", $baseUrl, "/api/logistics/tracking", $params, $apiConfig);
    }

    /**
     * Create Shipping Document
     * @throws \Exception
     */
    public function createShippingDocument($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithBody::makeMethod("POST", $baseUrl, "/api/logistics/shipping_documents", [], $body, $apiConfig);
    }

    /**
     * Get Shipping Document Result
     * @throws \Exception
     */
    public function getShippingDocumentResult($baseUrl, $taskId, TiktokShopConfig $apiConfig)
    {
        $params = ["task_id" => $taskId];
        return LogisticsWithOutBody::makeGetMethod("GET", $baseUrl, "/api/logistics/shipping_documents/result", $params, $apiConfig);
    }

    /**
     * Get Warehouse List
     * @throws \Exception
     */
    public function getWarehouseList($baseUrl, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithOutBody::makeGetMethod("GET", $baseUrl, "/api/logistics/warehouses", [], $apiConfig);
    }

    /**
     * Get Address Validation
     * @throws \Exception
     */
    public function validateAddress($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithBody::makeMethod("POST", $baseUrl, "/api/logistics/address_validation", [], $body, $apiConfig);
    }

    /**
     * Get Delivery Options
     * @throws \Exception
     */
    public function getDeliveryOptions($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return LogisticsWithOutBody::makeGetMethod("GET", $baseUrl, "/api/logistics/delivery_options", $params, $apiConfig);
    }

    /**
     * Update Tracking Number
     * @throws \Exception
     */
    public function updateTrackingNumber($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithBody::makeMethod("POST", $baseUrl, "/api/logistics/tracking/update", [], $body, $apiConfig);
    }

    /**
     * Get Shipping Fee
     * @throws \Exception
     */
    public function getShippingFee($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithBody::makeMethod("POST", $baseUrl, "/api/logistics/shipping_fee", [], $body, $apiConfig);
    }

    /**
     * Cancel Shipping Document
     * @throws \Exception
     */
    public function cancelShippingDocument($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return LogisticsWithBody::makeMethod("POST", $baseUrl, "/api/logistics/shipping_documents/cancel", [], $body, $apiConfig);
    }
}
