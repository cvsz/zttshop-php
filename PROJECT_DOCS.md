# TikTok Shop API Client - Project Documentation

## Overview

This repository is a PHP SDK for the TikTok Shop Open Platform.

It is organized as a resource-oriented client:

- `Common` holds configuration and signing helpers
- `Resource` contains grouped API clients by domain
- `Request` contains lower-level request builders
- `tests` contains PHPUnit coverage for auth, signing, and general shop calls

## Repository Structure

```text
src/
  Common/
  Request/
  Resource/
tests/
```

The current namespace prefix is `Aftwork\TiktokShop\`.

## Core Building Blocks

### `Aftwork\TiktokShop\Common\TiktokShopConfig`

Stores the values needed to make signed API calls:

- `appKey`
- `accessToken`
- `refreshToken`
- `shopId`
- `secretKey`
- `timeOut`

### `Aftwork\TiktokShop\Common\SignGenerator`

Builds request signatures by:

1. Removing `sign` and `access_token`
2. Sorting parameters alphabetically
3. Concatenating `path + key/value pairs`
4. Wrapping the string with the app secret
5. Hashing with `HMAC-SHA256`

### Resource classes

The public API is exposed through resource classes. Each one wraps the lower-level request helpers and groups related TikTok Shop endpoints.

## Resource Coverage

### Auth

- `generateAuthUrl()`
- `httpCallGet()` for token exchange and refresh flows

### General

- `httpCallGet()`
- `httpCallPost()`
- `httpCallPut()`
- `httpCallPatch()`
- `httpCallDelete()`

### Product

Methods include:

- `getProducts()`
- `getProduct()`
- `createProduct()`
- `updateProduct()`
- `deleteProduct()`
- `getProductPrice()`
- `updateProductPrice()`
- `getProductStock()`
- `updateProductStock()`
- `activateProduct()`
- `deactivateProduct()`
- `getCategories()`
- `getAttributes()`
- `getBrands()`
- `uploadImage()`
- `getSizeChart()`
- `getProductStatus()`

### Order

Methods include:

- `getOrders()`
- `getOrder()`
- `updateOrderStatus()`
- `cancelOrder()`
- `shipOrder()`
- `getOrdersByStatus()`
- `downloadInvoice()`
- `getOrderTracking()`
- `splitOrder()`
- `reverseOrder()`
- `getOrderCount()`

### Logistics

Methods include:

- `getShippingProviders()`
- `getTrackingInfo()`
- `createShippingDocument()`
- `getShippingDocumentResult()`
- `getWarehouseList()`
- `validateAddress()`
- `getDeliveryOptions()`
- `updateTrackingNumber()`
- `getShippingFee()`
- `cancelShippingDocument()`

### Finance

Methods include:

- `getSettlements()`
- `getSettlement()`
- `getIncomeStatement()`
- `getTransactions()`
- `getPaymentInfo()`
- `getCommissionDetails()`
- `getTaxInfo()`
- `downloadFinancialReport()`
- `getAccountBalance()`
- `getPayoutStatus()`
- `requestPayout()`
- `getVATInfo()`

### Return and refund

Methods include:

- `getReturnRefunds()`
- `getReturnRefund()`
- `approveReturnRefund()`
- `rejectReturnRefund()`
- `receiveReturnedItem()`
- `getReturnReasons()`
- `uploadReturnProof()`
- `escalateReturnRefund()`
- `getReturnShippingInfo()`
- `updateReturnStatus()`

### Warehouse

Methods include:

- `getWarehouses()`
- `getWarehouse()`
- `createWarehouse()`
- `updateWarehouse()`
- `deleteWarehouse()`
- `getWarehouseStock()`
- `updateWarehouseStock()`
- `getWarehouseZones()`
- `setDefaultWarehouse()`
- `getWarehouseCoverageAreas()`
- `updateWarehouseCoverageAreas()`

### Video

Methods include:

- `initUpload()`
- `commitUpload()`
- `getVideo()`
- `searchVideos()`
- `linkProducts()`
- `unlinkProducts()`
- `getLinkedProducts()`
- `deleteVideo()`

### Global

Methods include:

- `getAuthorizedShops()`
- `getShopDetail()`
- `getSellerProfile()`
- `getRegions()`
- `getCurrencies()`
- `getTimezones()`
- `getLanguages()`
- `getApiVersion()`
- `getRateLimitStatus()`
- `getWebhooks()`
- `createWebhook()`
- `updateWebhook()`
- `deleteWebhook()`

## Request Layer

The `Request` namespace contains helpers split by whether a call sends a body payload:

- `*WithBody`
- `*WithOutBody`

These classes build and execute signed HTTP requests using the shared config and signing logic.

## Testing

Current test coverage includes:

- auth URL generation
- token retrieval and refresh
- request signing
- general shop fetch behavior

Run the suite with:

```bash
composer test
```

For local environment and credential setup, see [SETUP.md](SETUP.md) and [.env.example](.env.example).

Integration tests self-skip if the required TikTok Shop environment variables are not available.

## Documentation Maintenance

When adding a new endpoint or resource:

1. Add the resource method.
2. Add or extend the matching request helper.
3. Add a test for the new behavior.
4. Update `README.md` and this file.
5. Add or update a changelog entry.
