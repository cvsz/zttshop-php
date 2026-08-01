<?php

namespace Aftwork\TiktokShop\Resource\Order;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Order\OrderWithBody;
use Aftwork\TiktokShop\Request\Order\OrderWithOutBody;

class TiktokShopOrderResource
{
    /**
     * Get Order List
     * @throws \Exception
     */
    public function getOrders($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return OrderWithOutBody::makeGetMethod("GET", $baseUrl, "/api/orders/search", $params, $apiConfig);
    }

    /**
     * Get Order Detail
     * @throws \Exception
     */
    public function getOrder($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return OrderWithOutBody::makeGetMethod("GET", $baseUrl, "/api/orders/detail", $params, $apiConfig);
    }

    /**
     * Update Order Status
     * @throws \Exception
     */
    public function updateOrderStatus($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return OrderWithBody::makeMethod("POST", $baseUrl, "/api/orders/update_status", [], $body, $apiConfig);
    }

    /**
     * Cancel Order
     * @throws \Exception
     */
    public function cancelOrder($baseUrl, $orderId, $reason, TiktokShopConfig $apiConfig)
    {
        $body = [
            "order_id" => $orderId,
            "cancel_reason" => $reason
        ];
        return OrderWithBody::makeMethod("POST", $baseUrl, "/api/orders/cancel", [], $body, $apiConfig);
    }

    /**
     * Ship Order
     * @throws \Exception
     */
    public function shipOrder($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return OrderWithBody::makeMethod("POST", $baseUrl, "/api/orders/ship", [], $body, $apiConfig);
    }

    /**
     * Get Orders by Status
     * @throws \Exception
     */
    public function getOrdersByStatus($baseUrl, $status, $params = [], TiktokShopConfig $apiConfig)
    {
        $params["order_status"] = $status;
        return OrderWithOutBody::makeGetMethod("GET", $baseUrl, "/api/orders/search", $params, $apiConfig);
    }

    /**
     * Download Invoice
     * @throws \Exception
     */
    public function downloadInvoice($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return OrderWithOutBody::makeGetMethod("GET", $baseUrl, "/api/orders/invoice", $params, $apiConfig);
    }

    /**
     * Get Order Tracking
     * @throws \Exception
     */
    public function getOrderTracking($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return OrderWithOutBody::makeGetMethod("GET", $baseUrl, "/api/orders/tracking", $params, $apiConfig);
    }

    /**
     * Split Order
     * @throws \Exception
     */
    public function splitOrder($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return OrderWithBody::makeMethod("POST", $baseUrl, "/api/orders/split", [], $body, $apiConfig);
    }

    /**
     * Reverse Order (Return from shipped to unshipped)
     * @throws \Exception
     */
    public function reverseOrder($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return OrderWithBody::makeMethod("POST", $baseUrl, "/api/orders/reverse", $params, [], $apiConfig);
    }

    /**
     * Get Order Count
     * @throws \Exception
     */
    public function getOrderCount($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return OrderWithOutBody::makeGetMethod("GET", $baseUrl, "/api/orders/count", $params, $apiConfig);
    }
}
