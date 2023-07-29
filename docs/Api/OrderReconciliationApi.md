# OpenAPI\Client\OrderReconciliationApi

All URIs are relative to https://pay.wallet.tg, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getOrderAmount()**](OrderReconciliationApi.md#getOrderAmount) | **GET** /wpay/store-api/v1/reconciliation/order-amount |  |
| [**getOrderList()**](OrderReconciliationApi.md#getOrderList) | **GET** /wpay/store-api/v1/reconciliation/order-list |  |


## `getOrderAmount()`

```php
getOrderAmount($wpay_store_api_key): \OpenAPI\Client\Model\OrderAmountResponse
```



Return Store orders amount

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\OrderReconciliationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$wpay_store_api_key = 'wpay_store_api_key_example'; // string | Store API key

try {
    $result = $apiInstance->getOrderAmount($wpay_store_api_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderReconciliationApi->getOrderAmount: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **wpay_store_api_key** | **string**| Store API key | |

### Return type

[**\OpenAPI\Client\Model\OrderAmountResponse**](../Model/OrderAmountResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrderList()`

```php
getOrderList($wpay_store_api_key, $offset, $count): \OpenAPI\Client\Model\GetOrderReconciliationListResponse
```



Return list of store orders sorted by creation time in ascending order

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\OrderReconciliationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$wpay_store_api_key = 'wpay_store_api_key_example'; // string | Store API key
$offset = 0; // int
$count = 100; // int

try {
    $result = $apiInstance->getOrderList($wpay_store_api_key, $offset, $count);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderReconciliationApi->getOrderList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **wpay_store_api_key** | **string**| Store API key | |
| **offset** | **int**|  | |
| **count** | **int**|  | |

### Return type

[**\OpenAPI\Client\Model\GetOrderReconciliationListResponse**](../Model/GetOrderReconciliationListResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
