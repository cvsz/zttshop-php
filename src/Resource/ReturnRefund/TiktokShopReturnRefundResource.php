<?php

namespace Aftwork\TiktokShop\Resource\ReturnRefund;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\ReturnRefund\ReturnRefundWithBody;
use Aftwork\TiktokShop\Request\ReturnRefund\ReturnRefundWithOutBody;

class TiktokShopReturnRefundResource
{
    /**
     * Get Return/Refund List
     * @throws \Exception
     */
    public function getReturnRefunds($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return ReturnRefundWithOutBody::makeGetMethod("GET", $baseUrl, "/api/returns/search", $params, $apiConfig);
    }

    /**
     * Get Return/Refund Detail
     * @throws \Exception
     */
    public function getReturnRefund($baseUrl, $returnId, TiktokShopConfig $apiConfig)
    {
        $params = ["return_id" => $returnId];
        return ReturnRefundWithOutBody::makeGetMethod("GET", $baseUrl, "/api/returns/detail", $params, $apiConfig);
    }

    /**
     * Approve Return/Refund
     * @throws \Exception
     */
    public function approveReturnRefund($baseUrl, $returnId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["return_id" => $returnId];
        return ReturnRefundWithBody::makeMethod("POST", $baseUrl, "/api/returns/approve", $params, $body, $apiConfig);
    }

    /**
     * Reject Return/Refund
     * @throws \Exception
     */
    public function rejectReturnRefund($baseUrl, $returnId, $reason, TiktokShopConfig $apiConfig)
    {
        $body = ["reject_reason" => $reason];
        $params = ["return_id" => $returnId];
        return ReturnRefundWithBody::makeMethod("POST", $baseUrl, "/api/returns/reject", $params, $body, $apiConfig);
    }

    /**
     * Receive Returned Item
     * @throws \Exception
     */
    public function receiveReturnedItem($baseUrl, $returnId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["return_id" => $returnId];
        return ReturnRefundWithBody::makeMethod("POST", $baseUrl, "/api/returns/receive", $params, $body, $apiConfig);
    }

    /**
     * Get Return Reasons
     * @throws \Exception
     */
    public function getReturnReasons($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return ReturnRefundWithOutBody::makeGetMethod("GET", $baseUrl, "/api/returns/reasons", $params, $apiConfig);
    }

    /**
     * Upload Return Proof
     * @throws \Exception
     */
    public function uploadReturnProof($baseUrl, $returnId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["return_id" => $returnId];
        return ReturnRefundWithBody::makeMethod("POST", $baseUrl, "/api/returns/proof", $params, $body, $apiConfig);
    }

    /**
     * Escalate Return/Refund to TikTok
     * @throws \Exception
     */
    public function escalateReturnRefund($baseUrl, $returnId, TiktokShopConfig $apiConfig)
    {
        $params = ["return_id" => $returnId];
        return ReturnRefundWithBody::makeMethod("POST", $baseUrl, "/api/returns/escalate", $params, [], $apiConfig);
    }

    /**
     * Get Return Shipping Info
     * @throws \Exception
     */
    public function getReturnShippingInfo($baseUrl, $returnId, TiktokShopConfig $apiConfig)
    {
        $params = ["return_id" => $returnId];
        return ReturnRefundWithOutBody::makeGetMethod("GET", $baseUrl, "/api/returns/shipping", $params, $apiConfig);
    }

    /**
     * Update Return Status
     * @throws \Exception
     */
    public function updateReturnStatus($baseUrl, $returnId, $status, TiktokShopConfig $apiConfig)
    {
        $body = ["status" => $status];
        $params = ["return_id" => $returnId];
        return ReturnRefundWithBody::makeMethod("PUT", $baseUrl, "/api/returns/status", $params, $body, $apiConfig);
    }
}
