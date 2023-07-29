# OpenAPI\Client\OrderApi

All URIs are relative to https://pay.wallet.tg, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**create()**](OrderApi.md#create) | **POST** /wpay/store-api/v1/order |  |
| [**getPreview()**](OrderApi.md#getPreview) | **GET** /wpay/store-api/v1/order/preview |  |


## `create()`

```php
create($wpay_store_api_key, $create_order_request): \OpenAPI\Client\Model\CreateOrderResponse
```



Create an order

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$wpay_store_api_key = 'wpay_store_api_key_example'; // string | Store API key
$create_order_request = new \OpenAPI\Client\Model\CreateOrderRequest(); // \OpenAPI\Client\Model\CreateOrderRequest

try {
    $result = $apiInstance->create($wpay_store_api_key, $create_order_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->create: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **wpay_store_api_key** | **string**| Store API key | |
| **create_order_request** | [**\OpenAPI\Client\Model\CreateOrderRequest**](../Model/CreateOrderRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\CreateOrderResponse**](../Model/CreateOrderResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPreview()`

```php
getPreview($wpay_store_api_key, $id): \OpenAPI\Client\Model\GetOrderPreviewResponse
```



Retrieve the order information

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$wpay_store_api_key = 'wpay_store_api_key_example'; // string | Store API key
$id = 'id_example'; // string | Order id

try {
    $result = $apiInstance->getPreview($wpay_store_api_key, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->getPreview: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **wpay_store_api_key** | **string**| Store API key | |
| **id** | **string**| Order id | |

### Return type

[**\OpenAPI\Client\Model\GetOrderPreviewResponse**](../Model/GetOrderPreviewResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
