# # CreateOrderRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**amount** | [**\OpenAPI\Client\Model\MoneyAmount**](MoneyAmount.md) |  |
**description** | **string** | Description of the order |
**return_url** | **string** | Url to redirect after paying order | [optional]
**fail_return_url** | **string** | Url to redirect after unsuccessful order completion (expiration/cancelation/etc) | [optional]
**custom_data** | **string** | Any custom string, will be provided through webhook and order status polling, length is limited | [optional]
**external_id** | **string** | Order ID in Merchant system. Use to prevent orders duplication due to request retries |
**timeout_seconds** | **int** | Order TTL, if the order is not paid within the timeout period |
**customer_telegram_user_id** | **int** | The customer&#39;s telegram id (&#x60;User_id&#x60;). For more details please follow the link https://core.telegram.org/bots/api#available-types |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
