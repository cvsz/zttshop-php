<?php

namespace Test;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Resource\General\TiktokShopGeneralResource;

class GeneralRequestTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->requireEnv(['APP_KEY', 'APP_SECRET', 'ACCESS_TOKEN', 'SERVER_URL', 'SELLER_NAME']);
    }

    public function test_get_authorized_shop()
    {
        $tiktokShopConfig = new TiktokShopConfig();
        $tiktokShopConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokShopConfig->setSecretKey($_ENV["APP_SECRET"]);
        $tiktokShopConfig->setAccessToken($_ENV["ACCESS_TOKEN"]);

        $tiktokGeneralResource = new TiktokShopGeneralResource();

        $baseUrl = $_ENV["SERVER_URL"];
        $apiAuthorizedShop = "/api/shop/get_authorized_shop";

        $response = $tiktokGeneralResource->httpCallGet($baseUrl, $apiAuthorizedShop, [], $tiktokShopConfig);

        $this->assertEquals(0, $response->code);
        $this->assertEquals($_ENV["SELLER_NAME"], $response->data->shop_list[0]->shop_name);
    }
}
