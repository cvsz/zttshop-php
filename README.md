# TikTok Shop API Client - PHP SDK

A comprehensive, modular, and secure PHP client for the TikTok Shop Open Platform. This SDK covers all major API modules including Products, Orders, Logistics, Finance, Returns, Warehouses, Global Settings, Video Content, AI Content Generation, and AI Chat capabilities.

## 🚀 Features

- **Complete API Coverage**: Products, Orders, Logistics, Finance, Returns, Warehouses, Global Settings.
- **Advanced Content Automation**: Video upload, product linking, AI script generation, and visual prompt engineering.
- **AI Chat Integration**: Intelligent chat bubbles with persona configuration, product context, and order awareness.
- **Secure Authentication**: Built-in HMAC-SHA256 signature generation, token management, and automatic refreshing.
- **Modular Architecture**: PSR-4 compliant, easy to extend, and dependency-injection ready.
- **Robust Error Handling**: Custom exceptions for API errors, rate limits, and validation failures.
- **Tested Core**: PHPUnit tests included for authentication, signing, and core configuration.

## 📋 Requirements

- PHP 8.1+
- Composer
- Guzzle HTTP Client
- TikTok Shop Seller Account & API Credentials

## 🛠️ Installation

```bash
composer require tiktok-shop/client
# Or clone this repo and install dependencies
composer install
```

## ⚙️ Configuration

Create a `.env` file in your project root:

```env
TIKTOK_APP_KEY=your_app_key
TIKTOK_APP_SECRET=your_app_secret
TIKTOK_ACCESS_TOKEN=your_access_token
TIKTOK_SHOP_ID=your_shop_id
TIKTOK_ENV=sandbox # or 'production'
```

Initialize the client in your PHP code:

```php
require 'vendor/autoload.php';

use TiktokShop\TiktokShopClient;
use TiktokShop\Config\TiktokShopConfig;

$config = new TiktokShopConfig();
$config->setAppKey(getenv('TIKTOK_APP_KEY'))
       ->setAppSecret(getenv('TIKTOK_APP_SECRET'))
       ->setAccessToken(getenv('TIKTOK_ACCESS_TOKEN'))
       ->setShopId(getenv('TIKTOK_SHOP_ID'))
       ->setEnvironment('sandbox'); // or 'production'

$client = new TiktokShopClient($config);
```

## 📚 Usage Examples

### 1. Product Management
```php
$products = $client->products()->list(['page_size' => 20]);
$product = $client->products()->get($productId);
$client->products()->updatePrice($productId, ['price' => 19.99]);
$client->products()->updateStock($productId, [['seller_sku' => 'SKU123', 'stock' => 100]]);
```

### 2. Order Fulfillment
```php
$orders = $client->orders()->search(['order_status' => 'AWAITING_SHIPMENT']);
$client->orders()->ship($orderId, [
    'tracking_number' => '123456789',
    'shipping_provider_id' => 'provider_id'
]);
```

### 3. AI Content Generation (Video Scripts & Prompts)
```php
// Analyze product for key selling points
$affinity = $client->content()->analyzeProductAffinity($productId);

// Generate a viral video script
$script = $client->content()->generateVideoScript([
    'product_name' => 'Super Widget',
    'usp' => $affinity['usp'],
    'target_audience' => 'Tech enthusiasts',
    'tone' => 'Energetic'
]);

// Generate AI visual prompts for video creation tools
$prompts = $client->content()->generateVisualPrompt([
    'product_image_url' => 'https://...',
    'scene' => 'Modern desk setup',
    'style' => 'Cinematic 4k'
]);
```

### 4. Video Management & Product Linking
```php
// Initialize upload
$uploadSession = $client->videos()->initUpload(['file_name' => 'video.mp4']);

// ... (Upload file logic using $uploadSession['upload_url']) ...

// Commit upload
$videoId = $client->videos()->commitUpload($uploadSession['upload_id']);

// Link products to make video shoppable
$client->videos()->linkProducts($videoId, [$productId]);
```

### 5. AI Chat Bubble Integration
```php
// Configure a Sales Bot persona
$persona = $client->chat()->createPersona([
    'name' => 'SalesBot',
    'role' => 'sales_assistant',
    'tone' => 'friendly',
    'knowledge_base' => ['products', 'promotions']
]);

// Send a message with product context
$response = $client->chat()->sendMessage([
    'session_id' => $sessionId,
    'message' => 'Is this available in blue?',
    'product_id' => $productId, // Auto-injects product details
    'persona_id' => $persona['id']
]);
```

### 6. Logistics & Returns
```php
$carriers = $client->logistics()->getCarriers();
$tracking = $client->logistics()->trackPackage($trackingNumber);

$returnRequests = $client->returns()->list(['status' => 'PENDING']);
$client->returns()->approve($returnId);
```

### 7. Finance & Settlements
```php
$settlements = $client->finance()->getSettlements(['date_from' => '2023-10-01']);
$transactions = $client->finance()->getTransactions($settlementId);
```

## 🏗️ Architecture

- **`TiktokShopClient`**: Main entry point, manages resources.
- **`Config\TiktokShopConfig`**: Holds credentials and environment settings.
- **`SignGenerator`**: Handles HMAC-SHA256 signature creation for requests.
- **`Resources\*`**: High-level API groups (e.g., `ProductResource`, `OrderResource`).
- **`Requests\*`**: Low-level HTTP request builders with validation.

## 🧪 Testing

Run the test suite:

```bash
vendor/bin/phpunit
```

*Note: Integration tests require valid API credentials. Unit tests mock HTTP responses.*

## 🤝 Contributing

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/amazing-feature`).
3. Commit your changes (`git commit -m 'Add amazing feature'`).
4. Push to the branch (`git push origin feature/amazing-feature`).
5. Open a Pull Request.

## 📄 License

MIT License. See [LICENSE](LICENSE) for details.

## 🆘 Support

For API-specific issues, refer to the [TikTok Shop Developer Portal](https://partner.tiktokshop.com/docv2).
For SDK bugs, please open an issue on GitHub.
