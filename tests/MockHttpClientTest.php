<?php

namespace Test;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Resource\Auth\TiktokShopAuthResource;
use Aftwork\TiktokShop\Resource\General\TiktokShopGeneralResource;
use Aftwork\TiktokShop\Resource\Video\TiktokShopVideoResource;
use PHPUnit\Framework\TestCase;

class MockHttpClientTest extends TestCase
{
    public function test_generate_auth_url()
    {
        $authUrl = TiktokShopAuthResource::generateAuthUrl("https://auth.tiktok.com", "test_app_key");
        
        $this->assertIsString($authUrl);
        $this->assertStringContainsString("app_key=test_app_key", $authUrl);
        $this->assertStringContainsString("/oauth/authorize", $authUrl);
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
}
