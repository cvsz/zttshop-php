<?php

namespace Aftwork\TiktokShop\Resource\Auth;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Auth\AuthWithOutBody;


class TiktokShopAuthResource
{
    // GET Request
    /**
     * @throws \Exception
     */
    public function httpCallGet($baseUrl, $apiPath, $params, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "GET";
        return AuthWithOutBody::makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, $apiConfig);
    }


    /**
     * Generate Auth URL
     * @param mixed $baseUrl
     * @param mixed $appKey
     * @param array<string, mixed> $queryParams
     * @return string
     */
    public static function generateAuthUrl($baseUrl, $appKey, array $queryParams = [])
    {
        $queryParams = array_merge(
            [
                'app_key' => $appKey,
                'state' => bin2hex(random_bytes(16)),
            ],
            $queryParams
        );

        return rtrim($baseUrl, '/') . '/oauth/authorize?' . http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);
    }

}
