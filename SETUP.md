# Setup Guide

## 1. Install the runtime

Install the following on your machine:

- PHP 8.1 or newer
- Composer
- PHP extensions: `curl`, `intl`, `mbstring`, `xml`, `zip`

On Ubuntu, the package names are typically:

```bash
sudo apt-get update
sudo apt-get install php-cli php-curl php-intl php-mbstring php-xml php-zip composer
```

## 2. Install project dependencies

From the repository root:

```bash
composer install
```

This installs:

- `guzzlehttp/guzzle`
- `phpunit/phpunit`
- `vlucas/phpdotenv`

## 3. Create your environment file

Copy [.env.example](.env.example) to `.env` and fill in real values:

- `SERVER_URL`
- `AUTH_URL`
- `AUTH_AUTHORIZE_URL`
- `APP_KEY`
- `APP_SECRET`
- `ACCESS_TOKEN`
- `REFRESH_TOKEN`
- `AUTH_CODE`
- `SHOP_ID`
- `SELLER_NAME`

These values come from your TikTok Shop developer app and authorization flow.

## 4. Get TikTok Shop credentials

1. Sign in to the TikTok Shop developer portal.
2. Create or open your app.
3. Copy the app key and secret into `.env`.
4. Start the seller authorization flow.
5. Save the authorization code, access token, refresh token, shop ID, and seller name.

The project documentation and tests use:

- `AUTH_AUTHORIZE_URL` for the authorization redirect URL
- `AUTH_URL` for token endpoints
- `SERVER_URL` for normal API calls

## 5. Verify the setup

Run the local test command:

```bash
composer test
```

If you only want to verify the local stack without live TikTok Shop credentials, run:

```bash
vendor/bin/phpunit --testdox tests/MockHttpClientTest.php
```

The integration tests will also skip automatically when the required env vars are missing.

## 6. Read the API documentation

- [README.md](README.md)
- [PROJECT_DOCS.md](PROJECT_DOCS.md)
- [TikTok Shop developer portal](https://partner.tiktokshop.com/docv2)
