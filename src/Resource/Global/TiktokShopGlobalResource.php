<?php

namespace Aftwork\TiktokShop\Resource\Global;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Global\GlobalWithBody;
use Aftwork\TiktokShop\Request\Global\GlobalWithOutBody;

class TiktokShopGlobalResource
{
    /**
     * Get Authorized Shops
     * @throws \Exception
     */
    public function getAuthorizedShops($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/shop/get_authorized_shop", [], $apiConfig);
    }

    /**
     * Get Shop Detail
     * @throws \Exception
     */
    public function getShopDetail($baseUrl, $shopId, TiktokShopConfig $apiConfig)
    {
        $params = ["shop_id" => $shopId];
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/shops/detail", $params, $apiConfig);
    }

    /**
     * Get Seller Profile
     * @throws \Exception
     */
    public function getSellerProfile($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/seller/profile", [], $apiConfig);
    }

    /**
     * Get Regions
     * @throws \Exception
     */
    public function getRegions($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/regions", [], $apiConfig);
    }

    /**
     * Get Currencies
     * @throws \Exception
     */
    public function getCurrencies($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/currencies", [], $apiConfig);
    }

    /**
     * Get Timezones
     * @throws \Exception
     */
    public function getTimezones($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/timezones", [], $apiConfig);
    }

    /**
     * Get Languages
     * @throws \Exception
     */
    public function getLanguages($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/languages", [], $apiConfig);
    }

    /**
     * Get API Version Info
     * @throws \Exception
     */
    public function getApiVersion($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/version", [], $apiConfig);
    }

    /**
     * Get Rate Limit Status
     * @throws \Exception
     */
    public function getRateLimitStatus($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/rate_limit", [], $apiConfig);
    }

    /**
     * Get Webhook Configurations
     * @throws \Exception
     */
    public function getWebhooks($baseUrl, TiktokShopConfig $apiConfig)
    {
        return GlobalWithOutBody::makeGetMethod("GET", $baseUrl, "/api/webhooks", [], $apiConfig);
    }

    /**
     * Create Webhook
     * @throws \Exception
     */
    public function createWebhook($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return GlobalWithBody::makeMethod("POST", $baseUrl, "/api/webhooks", [], $body, $apiConfig);
    }

    /**
     * Update Webhook
     * @throws \Exception
     */
    public function updateWebhook($baseUrl, $webhookId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["webhook_id" => $webhookId];
        return GlobalWithBody::makeMethod("PUT", $baseUrl, "/api/webhooks", $params, $body, $apiConfig);
    }

    /**
     * Delete Webhook
     * @throws \Exception
     */
    public function deleteWebhook($baseUrl, $webhookId, TiktokShopConfig $apiConfig)
    {
        $params = ["webhook_id" => $webhookId];
        return GlobalWithBody::makeMethod("DELETE", $baseUrl, "/api/webhooks", $params, [], $apiConfig);
    }
}
