<?php

namespace Aftwork\TiktokShop\Resource\Product;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Product\ProductWithBody;
use Aftwork\TiktokShop\Request\Product\ProductWithOutBody;

class TiktokShopProductResource
{
    /**
     * Get Product List
     * @throws \Exception
     */
    public function getProducts($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/products/search", $params, $apiConfig);
    }

    /**
     * Get Product Detail
     * @throws \Exception
     */
    public function getProduct($baseUrl, $productId, TiktokShopConfig $apiConfig)
    {
        $params = ["product_id" => $productId];
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/products", $params, $apiConfig);
    }

    /**
     * Create Product
     * @throws \Exception
     */
    public function createProduct($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return ProductWithBody::makeMethod("POST", $baseUrl, "/api/products", [], $body, $apiConfig);
    }

    /**
     * Update Product
     * @throws \Exception
     */
    public function updateProduct($baseUrl, $productId, $body, TiktokShopConfig $apiConfig)
    {
        $params = ["product_id" => $productId];
        return ProductWithBody::makeMethod("PUT", $baseUrl, "/api/products", $params, $body, $apiConfig);
    }

    /**
     * Delete Product
     * @throws \Exception
     */
    public function deleteProduct($baseUrl, $productId, TiktokShopConfig $apiConfig)
    {
        $params = ["product_id" => $productId];
        return ProductWithBody::makeMethod("DELETE", $baseUrl, "/api/products", $params, [], $apiConfig);
    }

    /**
     * Get Product Price
     * @throws \Exception
     */
    public function getProductPrice($baseUrl, $productIds, TiktokShopConfig $apiConfig)
    {
        $params = ["product_ids" => is_array($productIds) ? implode(",", $productIds) : $productIds];
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/products/prices", $params, $apiConfig);
    }

    /**
     * Update Product Price
     * @throws \Exception
     */
    public function updateProductPrice($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return ProductWithBody::makeMethod("POST", $baseUrl, "/api/products/prices", [], $body, $apiConfig);
    }

    /**
     * Get Product Stock
     * @throws \Exception
     */
    public function getProductStock($baseUrl, $productIds, TiktokShopConfig $apiConfig)
    {
        $params = ["product_ids" => is_array($productIds) ? implode(",", $productIds) : $productIds];
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/products/stocks", $params, $apiConfig);
    }

    /**
     * Update Product Stock
     * @throws \Exception
     */
    public function updateProductStock($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return ProductWithBody::makeMethod("POST", $baseUrl, "/api/products/stocks", [], $body, $apiConfig);
    }

    /**
     * Activate Product
     * @throws \Exception
     */
    public function activateProduct($baseUrl, $productId, TiktokShopConfig $apiConfig)
    {
        $params = ["product_id" => $productId];
        return ProductWithBody::makeMethod("POST", $baseUrl, "/api/products/activate", $params, [], $apiConfig);
    }

    /**
     * Deactivate Product
     * @throws \Exception
     */
    public function deactivateProduct($baseUrl, $productId, TiktokShopConfig $apiConfig)
    {
        $params = ["product_id" => $productId];
        return ProductWithBody::makeMethod("POST", $baseUrl, "/api/products/deactivate", $params, [], $apiConfig);
    }

    /**
     * Get Categories
     * @throws \Exception
     */
    public function getCategories($baseUrl, $parentId = null, TiktokShopConfig $apiConfig)
    {
        $params = [];
        if ($parentId !== null) {
            $params["parent_id"] = $parentId;
        }
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/categories", $params, $apiConfig);
    }

    /**
     * Get Attributes
     * @throws \Exception
     */
    public function getAttributes($baseUrl, $categoryId, TiktokShopConfig $apiConfig)
    {
        $params = ["category_id" => $categoryId];
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/categories/attributes", $params, $apiConfig);
    }

    /**
     * Get Brands
     * @throws \Exception
     */
    public function getBrands($baseUrl, $categoryId, $keyword = null, TiktokShopConfig $apiConfig)
    {
        $params = ["category_id" => $categoryId];
        if ($keyword !== null) {
            $params["keyword"] = $keyword;
        }
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/brands", $params, $apiConfig);
    }

    /**
     * Upload Product Image
     * @throws \Exception
     */
    public function uploadImage($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return ProductWithBody::makeMethod("POST", $baseUrl, "/api/images/upload", [], $body, $apiConfig);
    }

    /**
     * Get Size Chart
     * @throws \Exception
     */
    public function getSizeChart($baseUrl, $sizeChartId, TiktokShopConfig $apiConfig)
    {
        $params = ["size_chart_id" => $sizeChartId];
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/size_charts", $params, $apiConfig);
    }

    /**
     * Get Product Status
     * @throws \Exception
     */
    public function getProductStatus($baseUrl, $productId, TiktokShopConfig $apiConfig)
    {
        $params = ["product_id" => $productId];
        return ProductWithOutBody::makeGetMethod("GET", $baseUrl, "/api/products/status", $params, $apiConfig);
    }
}
