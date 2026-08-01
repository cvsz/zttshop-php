<?php

namespace Aftwork\TiktokShop\Resource\Video;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Video\VideoWithBody;
use Aftwork\TiktokShop\Request\Video\VideoWithOutBody;

class TiktokShopVideoResource
{
    /**
     * Initialize video upload
     * @throws \Exception
     */
    public function initUpload($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return VideoWithBody::makeMethod("POST", $baseUrl, "/api/video/init", [], $params, $apiConfig);
    }

    /**
     * Commit video upload
     * @throws \Exception
     */
    public function commitUpload($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return VideoWithBody::makeMethod("POST", $baseUrl, "/api/video/commit", [], $params, $apiConfig);
    }

    /**
     * Get video details
     * @throws \Exception
     */
    public function getVideo($baseUrl, $videoId, TiktokShopConfig $apiConfig)
    {
        $params = ["video_id" => $videoId];
        return VideoWithOutBody::makeGetMethod("GET", $baseUrl, "/api/video/query", $params, $apiConfig);
    }

    /**
     * Search videos
     * @throws \Exception
     */
    public function searchVideos($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return VideoWithBody::makeMethod("POST", $baseUrl, "/api/video/search", [], $params, $apiConfig);
    }

    /**
     * Link products to video
     * @throws \Exception
     */
    public function linkProducts($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return VideoWithBody::makeMethod("POST", $baseUrl, "/api/video/product/link", [], $params, $apiConfig);
    }

    /**
     * Unlink products from video
     * @throws \Exception
     */
    public function unlinkProducts($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return VideoWithBody::makeMethod("POST", $baseUrl, "/api/video/product/unlink", [], $params, $apiConfig);
    }

    /**
     * Get linked products
     * @throws \Exception
     */
    public function getLinkedProducts($baseUrl, $videoId, TiktokShopConfig $apiConfig)
    {
        $params = ["video_id" => $videoId];
        return VideoWithOutBody::makeGetMethod("GET", $baseUrl, "/api/video/product/list", $params, $apiConfig);
    }

    /**
     * Delete video
     * @throws \Exception
     */
    public function deleteVideo($baseUrl, $videoId, TiktokShopConfig $apiConfig)
    {
        $params = ["video_id" => $videoId];
        return VideoWithBody::makeMethod("POST", $baseUrl, "/api/video/delete", $params, [], $apiConfig);
    }
}
