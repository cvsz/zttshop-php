# TikTok Shop API Client for PHP

Unofficial PHP SDK for the TikTok Shop Open Platform.

This repository exposes resource-oriented clients for common TikTok Shop API areas:

- Auth
- General account and shop operations
- Product management
- Order management
- Logistics
- Finance
- Returns and refunds
- Warehouse management
- Video management

The package namespace is `Aftwork\TiktokShop\`.

## Installation

```bash
composer require haistar/tiktokshop-api-client
```

If you are working from a local clone:

```bash
composer install
```

For a complete local setup checklist, see [SETUP.md](SETUP.md).

## Requirements

- PHP 8.1 or newer
- Composer
- Guzzle HTTP client
- TikTok Shop app credentials

## Configuration

Create a `TiktokShopConfig` instance and set the credentials required by the API:

```php
use Aftwork\TiktokShop\Common\TiktokShopConfig;

$config = new TiktokShopConfig();
$config->setAppKey(getenv('APP_KEY'));
$config->setSecretKey(getenv('APP_SECRET'));
$config->setAccessToken(getenv('ACCESS_TOKEN'));
$config->setRefreshToken(getenv('REFRESH_TOKEN'));
$config->setShopId(getenv('SHOP_ID'));
```

The tests and resources in this repository use separate base URLs for auth and API calls.

- Auth examples use the auth host stored in `AUTH_URL`
- API examples use the API host stored in `SERVER_URL`

## Quick Start

### Generate an authorization URL

```php
use Aftwork\TiktokShop\Resource\Auth\TiktokShopAuthResource;

$authUrl = TiktokShopAuthResource::generateAuthUrl($_ENV['AUTH_URL'], $_ENV['APP_KEY']);
```

### Call an authenticated API endpoint

```php
use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Resource\General\TiktokShopGeneralResource;

$config = new TiktokShopConfig();
$config->setAppKey($_ENV['APP_KEY']);
$config->setSecretKey($_ENV['APP_SECRET']);
$config->setAccessToken($_ENV['ACCESS_TOKEN']);

$resource = new TiktokShopGeneralResource();
$response = $resource->httpCallGet(
    $_ENV['SERVER_URL'],
    '/api/shop/get_authorized_shop',
    [],
    $config
);
```

### Sign request parameters

```php
use Aftwork\TiktokShop\Common\SignGenerator;

$params = [
    'code' => $_ENV['AUTH_CODE'],
    'grant_type' => 'authorization_code',
];

$sign = SignGenerator::generateSign('/api/v2/token/get', $_ENV['APP_SECRET'], $params);
```

## Available Resources

The repository currently includes these resource classes:

- `Aftwork\TiktokShop\Resource\Auth\TiktokShopAuthResource`
- `Aftwork\TiktokShop\Resource\General\TiktokShopGeneralResource`
- `Aftwork\TiktokShop\Resource\Product\TiktokShopProductResource`
- `Aftwork\TiktokShop\Resource\Order\TiktokShopOrderResource`
- `Aftwork\TiktokShop\Resource\Logistics\TiktokShopLogisticsResource`
- `Aftwork\TiktokShop\Resource\Finance\TiktokShopFinanceResource`
- `Aftwork\TiktokShop\Resource\ReturnRefund\TiktokShopReturnRefundResource`
- `Aftwork\TiktokShop\Resource\Warehouse\TiktokShopWarehouseResource`
- `Aftwork\TiktokShop\Resource\Video\TiktokShopVideoResource`
- `Aftwork\TiktokShop\Resource\Global\TiktokShopGlobalResource`

## Testing

```bash
composer test
```

The test suite includes:

- Auth URL and token flow checks
- Signing behavior checks
- A general shop fetch test

Integration tests are skipped automatically unless the required TikTok Shop environment variables are present.

## Documentation

- [Setup guide](SETUP.md)
- [Project docs](PROJECT_DOCS.md)
- [Contributing guide](CONTRIBUTING.md)
- [Support](SUPPORT.md)
- [Security policy](SECURITY.md)
- [Changelog](CHANGELOG.md)

## License

MIT. See [LICENSE](LICENSE).
