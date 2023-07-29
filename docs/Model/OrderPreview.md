# # OrderPreview

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Order id |
**status** | **string** | Order status |
**number** | **string** | Human-readable short order id for UI |
**amount** | [**\OpenAPI\Client\Model\MoneyAmount**](MoneyAmount.md) |  |
**created_date_time** | **\DateTime** | ISO-8601 date time when order was created |
**expiration_date_time** | **\DateTime** | ISO-8601 date time when order timeout expires |
**completed_date_time** | **\DateTime** | ISO-8601 date time when order was completed (paid/expired/etc) | [optional]
**pay_link** | **string** | URL to show payer on Store&#39;s side |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
