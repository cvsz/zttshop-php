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
     * @param mixed $authUrl
     * @param mixed $appKey
     * @param array<string, mixed> $queryParams
     * @return string
     */
    public static function generateAuthUrl($authUrl, $appKey, array $queryParams = [])
    {
        $queryParams = array_merge(
            [
                'app_key' => $appKey,
                'state' => bin2hex(random_bytes(16)),
            ],
            $queryParams
        );

        return rtrim($authUrl, '/') . '?' . http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);
    }

}
