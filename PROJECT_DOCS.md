# TikTok Shop API Client - Project Documentation

## 📖 Table of Contents
1. [Project Overview](#project-overview)
2. [Architecture Design](#architecture-design)
3. [Module Breakdown](#module-breakdown)
4. [Security Implementation](#security-implementation)
5. [AI Features Deep Dive](#ai-features-deep-dive)
6. [Development Guidelines](#development-guidelines)
7. [Deployment Guide](#deployment-guide)
8. [Troubleshooting](#troubleshooting)

---

## Project Overview

### Purpose
This SDK provides a complete PHP interface to the TikTok Shop Open Platform, enabling developers to build automated e-commerce solutions, AI-driven content generators, and intelligent customer service bots.

### Key Capabilities
- **Full Shop Management**: CRUD operations for products, orders, logistics, finance, and returns.
- **Content Automation**: AI-powered video script generation, visual prompt engineering, and video management.
- **Intelligent Chat**: Context-aware chat bubbles with customizable personas for sales and support.
- **Enterprise Ready**: Secure signing, error handling, logging, and scalable architecture.

### Target Audience
- E-commerce agencies managing multiple TikTok Shops.
- Dropshippers automating product listing and fulfillment.
- Brands creating shoppable video content at scale.
- Developers building custom dashboards or ERP integrations.

---

## Architecture Design

### Directory Structure
```
/src
  /Config          # Configuration management
  /Resources       # High-level API modules
  /Requests        # Low-level HTTP request builders
  /Exceptions      # Custom exception classes
  /AI              # AI content and chat logic
  /Utils           # Helpers (SignGenerator, etc.)
/tests             # PHPUnit test suite
/examples          # Usage examples
```

### Design Patterns
- **Facade Pattern**: `TiktokShopClient` acts as a single entry point.
- **Strategy Pattern**: Different request handlers for GET/POST/PUT/DELETE.
- **Factory Pattern**: Resource creation based on module type.
- **Builder Pattern**: Complex request payload construction.

### Data Flow
1. **Initialization**: Client loads config and credentials.
2. **Request Building**: Resource calls specific Request class.
3. **Signing**: `SignGenerator` creates HMAC-SHA256 signature.
4. **HTTP Execution**: Guzzle sends signed request.
5. **Response Handling**: JSON parsed, exceptions thrown on errors.
6. **Return**: Clean data array or object returned to user.

---

## Module Breakdown

### Core Modules
| Module | Class | Key Methods |
|--------|-------|-------------|
| **Auth** | `TiktokShopAuthResource` | `generateAuthUrl()`, `getAccessToken()`, `refreshToken()` |
| **Product** | `TiktokShopProductResource` | `list()`, `get()`, `create()`, `updatePrice()`, `updateStock()` |
| **Order** | `TiktokShopOrderResource` | `search()`, `get()`, `cancel()`, `ship()` |
| **Logistics** | `TiktokShopLogisticsResource` | `getCarriers()`, `trackPackage()`, `getShippingDoc()` |
| **Finance** | `TiktokShopFinanceResource` | `getSettlements()`, `getTransactions()`, `getPayouts()` |
| **Returns** | `TiktokShopReturnResource` | `list()`, `get()`, `approve()`, `reject()` |
| **Warehouse** | `TiktokShopWarehouseResource` | `list()`, `create()`, `updateStock()` |
| **Global** | `TiktokShopGlobalResource` | `getShops()`, `subscribeWebhook()`, `unsubscribeWebhook()` |

### Advanced Modules
| Module | Class | Key Methods |
|--------|-------|-------------|
| **Video** | `TiktokShopVideoResource` | `initUpload()`, `commitUpload()`, `linkProducts()`, `unlinkProducts()` |
| **Content AI** | `TiktokShopContentResource` | `analyzeProductAffinity()`, `generateVideoScript()`, `generateVisualPrompt()` |
| **Chat AI** | `TiktokShopChatResource` | `sendMessage()`, `startSession()`, `createPersona()`, `getHistory()` |

---

## Security Implementation

### Signature Generation
All API requests require an `x-tts-signature` header generated via:
1. Sort parameters alphabetically.
2. Concatenate `app_secret` + sorted params + `app_secret`.
3. Hash using HMAC-SHA256.
4. Convert to uppercase hex string.

### Token Management
- Access tokens are stored in config.
- Automatic refresh logic triggered on `401 Unauthorized`.
- Tokens encrypted at rest (optional integration with vaults).

### Input Validation
- All request payloads validated against schemas.
- SQL injection prevention (no direct DB usage).
- XSS sanitization for user-generated content in chat.

---

## AI Features Deep Dive

### 1. Product Affinity Analysis
**Goal**: Extract unique selling points (USPs) from product data.
**Process**:
- Analyze title, description, category, attributes.
- Identify target demographic (age, gender, interests).
- Detect emotional triggers (urgency, scarcity, social proof).
**Output**: Structured JSON with `usp`, `audience`, `tone_recommendation`.

### 2. Video Script Generation
**Framework**: Hook → Value → Social Proof → CTA.
**Inputs**: Product affinity data, brand voice, video length.
**Outputs**: 
- Scene-by-scene script.
- Spoken dialogue.
- On-screen text suggestions.
- Background music recommendations.

### 3. Visual Prompt Engineering
**Goal**: Generate prompts for AI video tools (Runway, Pika, Sora).
**Components**:
- Subject description (product details).
- Environment/Scene setting.
- Lighting and camera angles.
- Style references (cinematic, UGC, minimalist).
**Example**: `"Close-up shot of sleek wireless earbuds on a modern desk, soft bokeh lighting, 4k cinematic, slow rotation"`

### 4. Chat Persona System
**Personas**:
- **SalesBot**: Focus on conversions, upsells, promotions.
- **SupportBot**: Empathetic, solution-oriented, policy-aware.
- **LogisticsBot**: Real-time tracking, shipping FAQs.
**Context Injection**:
- Auto-fetches product details when `product_id` provided.
- Retrieves order status when `order_id` mentioned.
- Maintains session history for multi-turn conversations.

---

## Development Guidelines

### Coding Standards
- **PSR-12**: Coding style compliance.
- **PSR-4**: Autoloading standards.
- **Type Hinting**: Strict types enabled (`declare(strict_types=1);`).
- **PHPDoc**: All methods documented with `@param`, `@return`, `@throws`.

### Adding New Modules
1. Create `src/Resources/NewModuleResource.php`.
2. Create `src/Requests/NewModule*Request.php` for each endpoint.
3. Register resource in `TiktokShopClient`.
4. Add tests in `tests/NewModuleTest.php`.
5. Update documentation.

### Error Handling Best Practices
```php
try {
    $client->products()->create($data);
} catch (ApiException $e) {
    // Handle API-specific errors (e.g., invalid params)
    error_log("API Error: " . $e->getMessage());
} catch (RateLimitException $e) {
    // Implement exponential backoff
    sleep($e->getRetryAfter());
} catch (AuthException $e) {
    // Refresh token and retry
    $client->auth()->refreshToken();
}
```

---

## Deployment Guide

### Prerequisites
- PHP 8.1+ installed.
- Composer installed globally.
- Web server (Nginx/Apache) or CLI environment.

### Steps
1. **Clone Repository**:
   ```bash
   git clone https://github.com/your-org/tiktok-shop-client.git
   cd tiktok-shop-client
   ```
2. **Install Dependencies**:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. **Configure Environment**:
   ```bash
   cp .env.example .env
   # Edit .env with your credentials
   ```
4. **Run Tests** (Optional):
   ```bash
   vendor/bin/phpunit
   ```
5. **Integrate**:
   - Use in existing PHP projects via autoloader.
   - Deploy as microservice (Docker available).

### Docker Deployment
```dockerfile
FROM php:8.2-cli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . .
RUN composer install --no-dev
CMD ["php", "your-script.php"]
```

---

## Troubleshooting

### Common Issues

#### 1. Signature Mismatch (401 Invalid Signature)
- **Cause**: Parameters not sorted correctly before signing.
- **Fix**: Ensure `ksort()` is applied to params before concatenation.
- **Debug**: Log the raw string being hashed.

#### 2. Token Expired (401 Unauthorized)
- **Cause**: Access token expired (24h lifespan).
- **Fix**: Call `refreshToken()` and update config.
- **Prevention**: Implement auto-refresh middleware.

#### 3. Rate Limit Exceeded (429 Too Many Requests)
- **Cause**: Exceeding API call limits (varies by endpoint).
- **Fix**: Implement exponential backoff.
- **Code**:
  ```php
  if ($e instanceof RateLimitException) {
      usleep(pow(2, $retryCount) * 1000000);
      retry($request);
  }
  ```

#### 4. Product Not Found (404)
- **Cause**: Incorrect `product_id` or shop mismatch.
- **Fix**: Verify `shop_id` in config matches product ownership.

#### 5. AI Content Generation Fails
- **Cause**: Missing product affinity data.
- **Fix**: Run `analyzeProductAffinity()` first.
- **Fallback**: Use default templates if analysis fails.

### Getting Help
- **Logs**: Check `logs/app.log` for detailed error traces.
- **Docs**: Refer to [TikTok Shop Developer Portal](https://partner.tiktokshop.com/docv2).
- **Issues**: Open a GitHub issue with reproduction steps.
