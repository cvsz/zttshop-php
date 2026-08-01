# Unofficial TikTok Shop API Client built in PHP

A comprehensive PHP client library for the TikTok Shop API, providing access to all major features including Products, Orders, Logistics, Returns/Refunds, Finance, Warehouse management, and Global settings.

## How To Install

```bash
composer require haistar/tiktokshop-api-client
```

## Quick Start

```php
use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Resource\Auth\TiktokShopAuthResource;
use Aftwork\TiktokShop\Resource\Product\TiktokShopProductResource;
use Aftwork\TiktokShop\Resource\Order\TiktokShopOrderResource;
use Aftwork\TiktokShop\Resource\Logistics\TiktokShopLogisticsResource;
use Aftwork\TiktokShop\Resource\ReturnRefund\TiktokShopReturnRefundResource;
use Aftwork\TiktokShop\Resource\Finance\TiktokShopFinanceResource;
use Aftwork\TiktokShop\Resource\Warehouse\TiktokShopWarehouseResource;
use Aftwork\TiktokShop\Resource\Global\TiktokShopGlobalResource;

// Initialize configuration
$tiktokShopConfig = new TiktokShopConfig();
$tiktokShopConfig->setAppKey($_ENV["APP_KEY"]);
$tiktokShopConfig->setSecretKey($_ENV["APP_SECRET"]);
$tiktokShopConfig->setAccessToken($_ENV["ACCESS_TOKEN"]);
$tiktokShopConfig->setShopId($_ENV["SHOP_ID"]);

$baseUrl = $_ENV["SERVER_URL"]; // e.g., https://open-api.tiktokglobalshop.com
```

## Features

### 1. Authentication

#### Generate Authorization URL
```php
$authUrl = TiktokShopAuthResource::generateAuthUrl($_ENV["AUTH_URL"], $_ENV["APP_KEY"]);
```

#### Get Access Token
```php
$tiktokAuthResource = new TiktokShopAuthResource();
$apiAccessToken = "/api/v2/token/get";

$params = [
    "auth_code" => $_ENV["AUTH_CODE"],
    "grant_type" => "authorized_code",
];

$response = $tiktokAuthResource->httpCallGet($_ENV["AUTH_URL"], $apiAccessToken, $params, $tiktokShopConfig);
```

#### Renew Refresh Token
```php
$apiRenewRefreshToken = "/api/v2/token/refresh";

$params = [
    "refresh_token" => $_ENV["REFRESH_TOKEN"],
    "grant_type" => "refresh_token",
];

$response = $tiktokAuthResource->httpCallGet($_ENV["AUTH_URL"], $apiRenewRefreshToken, $params, $tiktokShopConfig);
```

### 2. Product Management

```php
$productResource = new TiktokShopProductResource();

// Get product list
$products = $productResource->getProducts($baseUrl, ["page_size" => 10], $tiktokShopConfig);

// Get product detail
$product = $productResource->getProduct($baseUrl, $productId, $tiktokShopConfig);

// Create product
$newProduct = $productResource->createProduct($baseUrl, $productData, $tiktokShopConfig);

// Update product
$updated = $productResource->updateProduct($baseUrl, $productId, $updateData, $tiktokShopConfig);

// Delete product
$deleted = $productResource->deleteProduct($baseUrl, $productId, $tiktokShopConfig);

// Get/Set product prices
$prices = $productResource->getProductPrice($baseUrl, [$productId], $tiktokShopConfig);
$updated = $productResource->updateProductPrice($baseUrl, $priceData, $tiktokShopConfig);

// Get/Set product stock
$stock = $productResource->getProductStock($baseUrl, [$productId], $tiktokShopConfig);
$updated = $productResource->updateProductStock($baseUrl, $stockData, $tiktokShopConfig);

// Activate/Deactivate products
$activated = $productResource->activateProduct($baseUrl, $productId, $tiktokShopConfig);
$deactivated = $productResource->deactivateProduct($baseUrl, $productId, $tiktokShopConfig);

// Get categories, attributes, brands
$categories = $productResource->getCategories($baseUrl, $parentId, $tiktokShopConfig);
$attributes = $productResource->getAttributes($baseUrl, $categoryId, $tiktokShopConfig);
$brands = $productResource->getBrands($baseUrl, $categoryId, $keyword, $tiktokShopConfig);

// Upload product image
$imageResult = $productResource->uploadImage($baseUrl, $imageData, $tiktokShopConfig);
```

### 3. Order Management

```php
$orderResource = new TiktokShopOrderResource();

// Get order list
$orders = $orderResource->getOrders($baseUrl, ["page_size" => 10], $tiktokShopConfig);

// Get order detail
$order = $orderResource->getOrder($baseUrl, $orderId, $tiktokShopConfig);

// Get orders by status
$pendingOrders = $orderResource->getOrdersByStatus($baseUrl, "PENDING", [], $tiktokShopConfig);

// Cancel order
$cancelled = $orderResource->cancelOrder($baseUrl, $orderId, "Customer requested cancellation", $tiktokShopConfig);

// Ship order
$shipped = $orderResource->shipOrder($baseUrl, $shippingData, $tiktokShopConfig);

// Download invoice
$invoice = $orderResource->downloadInvoice($baseUrl, $orderId, $tiktokShopConfig);

// Get tracking info
$tracking = $orderResource->getOrderTracking($baseUrl, $orderId, $tiktokShopConfig);
```

### 4. Logistics Management

```php
$logisticsResource = new TiktokShopLogisticsResource();

// Get shipping providers
$providers = $logisticsResource->getShippingProviders($baseUrl, [], $tiktokShopConfig);

// Get tracking info
$tracking = $logisticsResource->getTrackingInfo($baseUrl, $trackingNumber, $tiktokShopConfig);

// Create shipping document
$document = $logisticsResource->createShippingDocument($baseUrl, $docData, $tiktokShopConfig);

// Get shipping document result
$result = $logisticsResource->getShippingDocumentResult($baseUrl, $taskId, $tiktokShopConfig);

// Validate address
$validated = $logisticsResource->validateAddress($baseUrl, $addressData, $tiktokShopConfig);

// Get delivery options
$options = $logisticsResource->getDeliveryOptions($baseUrl, $orderId, $tiktokShopConfig);

// Get shipping fee
$fee = $logisticsResource->getShippingFee($baseUrl, $feeData, $tiktokShopConfig);
```

### 5. Returns & Refunds

```php
$returnRefundResource = new TiktokShopReturnRefundResource();

// Get return/refund list
$returns = $returnRefundResource->getReturnRefunds($baseUrl, ["page_size" => 10], $tiktokShopConfig);

// Get return/refund detail
$returnDetail = $returnRefundResource->getReturnRefund($baseUrl, $returnId, $tiktokShopConfig);

// Approve return/refund
$approved = $returnRefundResource->approveReturnRefund($baseUrl, $returnId, $approvalData, $tiktokShopConfig);

// Reject return/refund
$rejected = $returnRefundResource->rejectReturnRefund($baseUrl, $returnId, "Reason for rejection", $tiktokShopConfig);

// Receive returned item
$received = $returnRefundResource->receiveReturnedItem($baseUrl, $returnId, $receiveData, $tiktokShopConfig);

// Get return reasons
$reasons = $returnRefundResource->getReturnReasons($baseUrl, $orderId, $tiktokShopConfig);
```

### 6. Finance Management

```php
$financeResource = new TiktokShopFinanceResource();

// Get settlements
$settlements = $financeResource->getSettlements($baseUrl, ["page_size" => 10], $tiktokShopConfig);

// Get settlement detail
$settlement = $financeResource->getSettlement($baseUrl, $settlementId, $tiktokShopConfig);

// Get income statement
$incomeStatement = $financeResource->getIncomeStatement($baseUrl, ["date_from" => "2024-01-01"], $tiktokShopConfig);

// Get transactions
$transactions = $financeResource->getTransactions($baseUrl, ["page_size" => 10], $tiktokShopConfig);

// Get payment info
$payment = $financeResource->getPaymentInfo($baseUrl, $orderId, $tiktokShopConfig);

// Get commission details
$commissions = $financeResource->getCommissionDetails($baseUrl, [], $tiktokShopConfig);

// Get account balance
$balance = $financeResource->getAccountBalance($baseUrl, $tiktokShopConfig);

// Get payout status
$payouts = $financeResource->getPayoutStatus($baseUrl, [], $tiktokShopConfig);
```

### 7. Warehouse Management

```php
$warehouseResource = new TiktokShopWarehouseResource();

// Get warehouses
$warehouses = $warehouseResource->getWarehouses($baseUrl, [], $tiktokShopConfig);

// Get warehouse detail
$warehouse = $warehouseResource->getWarehouse($baseUrl, $warehouseId, $tiktokShopConfig);

// Create warehouse
$created = $warehouseResource->createWarehouse($baseUrl, $warehouseData, $tiktokShopConfig);

// Update warehouse
$updated = $warehouseResource->updateWarehouse($baseUrl, $warehouseId, $updateData, $tiktokShopConfig);

// Delete warehouse
$deleted = $warehouseResource->deleteWarehouse($baseUrl, $warehouseId, $tiktokShopConfig);

// Get warehouse stock
$stock = $warehouseResource->getWarehouseStock($baseUrl, $warehouseId, [], $tiktokShopConfig);

// Set default warehouse
$setDefault = $warehouseResource->setDefaultWarehouse($baseUrl, $warehouseId, $tiktokShopConfig);
```

### 8. Global Settings

```php
$globalResource = new TiktokShopGlobalResource();

// Get authorized shops
$shops = $globalResource->getAuthorizedShops($baseUrl, $tiktokShopConfig);

// Get shop detail
$shopDetail = $globalResource->getShopDetail($baseUrl, $shopId, $tiktokShopConfig);

// Get seller profile
$profile = $globalResource->getSellerProfile($baseUrl, $tiktokShopConfig);

// Get regions, currencies, timezones, languages
$regions = $globalResource->getRegions($baseUrl, $tiktokShopConfig);
$currencies = $globalResource->getCurrencies($baseUrl, $tiktokShopConfig);
$timezones = $globalResource->getTimezones($baseUrl, $tiktokShopConfig);
$languages = $globalResource->getLanguages($baseUrl, $tiktokShopConfig);

// Get API version info
$version = $globalResource->getApiVersion($baseUrl, $tiktokShopConfig);

// Get rate limit status
$rateLimit = $globalResource->getRateLimitStatus($baseUrl, $tiktokShopConfig);

// Webhook management
$webhooks = $globalResource->getWebhooks($baseUrl, $tiktokShopConfig);
$created = $globalResource->createWebhook($baseUrl, $webhookData, $tiktokShopConfig);
$updated = $globalResource->updateWebhook($baseUrl, $webhookId, $updateData, $tiktokShopConfig);
$deleted = $globalResource->deleteWebhook($baseUrl, $webhookId, $tiktokShopConfig);
```

## Configuration Options

| Method | Description |
|--------|-------------|
| `setAppKey($key)` | Set your application key |
| `setSecretKey($key)` | Set your application secret |
| `setAccessToken($token)` | Set the access token |
| `setRefreshToken($token)` | Set the refresh token |
| `setShopId($id)` | Set the shop ID |
| `setTimeOut($seconds)` | Set request timeout (default: 3) |

## Error Handling

All methods throw `\Exception` when validation fails. API errors are returned in the response object with `code` and `message` properties.

```php
try {
    $response = $productResource->getProducts($baseUrl, [], $tiktokShopConfig);
    
    if ($response->code !== 0) {
        echo "API Error: " . $response->message;
    } else {
        // Process successful response
        print_r($response->data);
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

## Testing

```bash
composer install
cp .env.example .env  # Configure your environment variables
composer test
```

## License

MIT License

## Author

- **Adhi Prayoga** (raviMukti) - shinjiravi@gmail.com

