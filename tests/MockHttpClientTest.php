<?php

namespace Test;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Resource\Auth\TiktokShopAuthResource;
use Aftwork\TiktokShop\Resource\Video\TiktokShopVideoResource;
use Aftwork\TiktokShop\Request\Global\GlobalWithOutBody;
use Aftwork\TiktokShop\Request\Video\VideoWithBody;
use Aftwork\TiktokShop\Resource\Warehouse\TiktokShopWarehouseResource;
use PHPUnit\Framework\TestCase;

class MockHttpClientTest extends TestCase
{
    public function test_generate_auth_url()
    {
        $authUrl = TiktokShopAuthResource::generateAuthUrl("https://auth.tiktok.com/oauth/authorize", "test_app_key", [
            "redirect_uri" => "https://example.com/callback",
            "scope" => "user.info.basic",
        ]);

        $this->assertIsString($authUrl);
        $this->assertStringContainsString("/oauth/authorize", $authUrl);

        parse_str(parse_url($authUrl, PHP_URL_QUERY), $query);

        $this->assertSame("test_app_key", $query["app_key"]);
        $this->assertSame("https://example.com/callback", $query["redirect_uri"]);
        $this->assertSame("user.info.basic", $query["scope"]);
        $this->assertMatchesRegularExpression('/^[a-f0-9]{32}$/', $query["state"]);
    }

    public function test_config_setters()
    {
        $config = new TiktokShopConfig();
        $same = $config->setAppKey("test_key")
            ->setSecretKey("test_secret")
            ->setAccessToken("test_token")
            ->setRefreshToken("refresh_token")
            ->setShopId("shop_id");
        
        $this->assertSame($config, $same);
        $this->assertEquals("test_key", $config->getAppKey());
        $this->assertEquals("test_secret", $config->getSecretKey());
        $this->assertEquals("test_token", $config->getAccessToken());
        $this->assertEquals("refresh_token", $config->getRefreshToken());
        $this->assertEquals("shop_id", $config->getShopId());
    }

    public function test_sign_generator()
    {
        $config = new TiktokShopConfig();
        $config->setAppKey("test_key");
        $config->setSecretKey("test_secret");
        $config->setAccessToken("test_token");
        
        $params = ["param1" => "value1", "param2" => "value2"];
        $apiPath = "/api/test";
        
        $sign = \Aftwork\TiktokShop\Common\SignGenerator::generateSign($apiPath, $config->getSecretKey(), $params);
        
        $this->assertIsString($sign);
        $this->assertNotEmpty($sign);
        // Verify sign is a valid hex string (sha256 produces 64 char hex)
        $this->assertEquals(64, strlen($sign));
    }
    
    public function test_sort_params_in_sign()
    {
        $params = ["z_param" => "last", "a_param" => "first", "m_param" => "middle"];
        $apiPath = "/api/test";
        $appSecret = "secret123";
        
        $sign = \Aftwork\TiktokShop\Common\SignGenerator::generateSign($apiPath, $appSecret, $params);
        
        // Sign should be generated consistently regardless of input order
        $params2 = ["m_param" => "middle", "z_param" => "last", "a_param" => "first"];
        $sign2 = \Aftwork\TiktokShop\Common\SignGenerator::generateSign($apiPath, $appSecret, $params2);
        
        $this->assertEquals($sign, $sign2);
    }

    public function test_video_resource_namespace_is_autoloadable()
    {
        $this->assertTrue(class_exists(TiktokShopVideoResource::class));
    }

    public function test_request_helpers_accept_null_params()
    {
        $config = new TiktokShopConfig();
        $config->setAppKey("test_key");
        $config->setSecretKey("test_secret");
        $config->setAccessToken("test_token");

        $globalResponse = GlobalWithOutBody::makeGetMethod(
            "GET",
            "http://127.0.0.1:1",
            "/api/shop/get_authorized_shop",
            null,
            $config
        );

        $videoResponse = VideoWithBody::makeMethod(
            "POST",
            "http://127.0.0.1:1",
            "/api/video/search",
            null,
            [],
            $config
        );

        $this->assertIsObject($globalResponse);
        $this->assertEquals("GUZZLE_ERROR", $globalResponse->error);
        $this->assertIsObject($videoResponse);
        $this->assertEquals("GUZZLE_ERROR", $videoResponse->error);
    }

    public function test_optional_resource_arguments_follow_required_config()
    {
        $config = new TiktokShopConfig();
        $config->setAppKey("test_key");
        $config->setSecretKey("test_secret");
        $config->setAccessToken("test_token");

        $productResource = new \ReflectionMethod(\Aftwork\TiktokShop\Resource\Product\TiktokShopProductResource::class, 'getCategories');
        $productParams = $productResource->getParameters();
        $this->assertSame('baseUrl', $productParams[0]->getName());
        $this->assertSame('apiConfig', $productParams[1]->getName());
        $this->assertTrue($productParams[2]->isOptional());

        $brandsResource = new \ReflectionMethod(\Aftwork\TiktokShop\Resource\Product\TiktokShopProductResource::class, 'getBrands');
        $brandsParams = $brandsResource->getParameters();
        $this->assertSame('baseUrl', $brandsParams[0]->getName());
        $this->assertSame('categoryId', $brandsParams[1]->getName());
        $this->assertSame('apiConfig', $brandsParams[2]->getName());
        $this->assertTrue($brandsParams[3]->isOptional());

        $ordersResource = new \ReflectionMethod(\Aftwork\TiktokShop\Resource\Order\TiktokShopOrderResource::class, 'getOrdersByStatus');
        $ordersParams = $ordersResource->getParameters();
        $this->assertSame('baseUrl', $ordersParams[0]->getName());
        $this->assertSame('status', $ordersParams[1]->getName());
        $this->assertSame('apiConfig', $ordersParams[2]->getName());
        $this->assertTrue($ordersParams[3]->isOptional());

        $warehouseResource = new TiktokShopWarehouseResource();
        $warehouseResponse = $warehouseResource->getWarehouseStock(
            "http://127.0.0.1:1",
            "warehouse-id",
            null,
            $config
        );
        $this->assertIsObject($warehouseResponse);
        $this->assertEquals("GUZZLE_ERROR", $warehouseResponse->error);
    }
}
