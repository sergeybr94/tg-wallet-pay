<?php
/**
 * OrderApi
 * PHP version 7.4
 *
 * @category Class
 * @package  WalletPay
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Wallet Pay
 *
 * ### Beta API has been released for first users! We highly appreciate any kind of feedback as it helps us improve our services. Please share your thoughts using this [form](https://forms.gle/TgBB5Dh35i9QvsTf8).  # Get started **[Wallet Pay](https://pay.wallet.tg/)** is a business platform within [Wallet](https://t.me/wallet) that enables payment transactions between merchants and customers.  [Wallet Pay Business Support](https://t.me/WalletPay_supportbot) is a Telegram bot for reaching out the Wallet Pay Support Team.  [Demo Store Bot](https://t.me/PineAppleDemoWPStoreBot) is a Telegram bot for Wallet Pay functionality introduction. (Attention: all payments are carried out in real assets)  [Merchant Community](https://t.me/+6TReWBEyZxI5Njli) is a Telegram group for sharing an experience and solutions between group members.  To get started please follow the steps below.  ### 1. Log in to the 'Merchant account'  Businesses or developers can get started by following the next steps to create a Partner account with us: 1. Follow the link https://pay.wallet.tg. 2. Click 'Login via Telegram'. 3. Enter your phone number in the popup window 'oauth.telegram.org appears', and click 'Apply'. 4. You will receive a message in Telegram with an authorisation request, click  'Apply'. 5. Click 'Apply' in the popup window  'oauth.telegram.org' in your Web browser.  **We recommend using an account to which the person dealing with the finances has access. For legal entities, it is an authorized representative.**  ### 2. Take a short survey  If you are logging in for the first time, or some additional information is required, Wallet Pay offers you to answer several questions for more details. There are two steps: 1. Questionnaire 2. KYB (Know-Your-Business) or KYC (Know-Your-Customer) checks  Once completed, your application will be reviewed shortly, and you will be notified about the results. If successful, you will see the fee charged by the service, and get access to your account where you can start the integration.  **For legal entities, the form can be filled out only by an authorized representative: a director or an employee with a power of attorney.**  ### 3. Create the first 'Store' Once the 'Survey' is passed successfully, you will be offered to Create your first store.  ### 4. Generate 'API key' After naming the first store you will be offered to set it up: 1. Generate API Key. 2. Copy your API Key and start integration with us.  ### 5. Create an Order Using generated Wallet Pay API proceed the following: 1. Create an Order. 2. Send the payLink to your customer to commit the payment. 3. Check the Order status.  **Only the specified 'customerTelegramUserId' can open 'payLink'.**  ### 6. Withdraw the funds After the customer confirms the payment, the funds are credited to your Assets and held for 48 hours by default. After this time expires, you can withdraw the funds to the balance of **your [Wallet](https://t.me/wallet) account** you used to log in to Wallet Pay service.  ### 7. Refund For now you can refund from your Wallet account you use to log in to Wallet Pay. But it will be available in your Merchant account in the nearest future.  ### 8. Sign out from the 'Merchant account' To sign out from your account click 'Sign out'. To log in to your account click 'Log in'. If you want to log in under another Telegram account please proceed the following: 1. Go to Telegram and open 'Telegram (Service notification)' dialog. 2. Select 'Terminate session'. 3. Now you can log in using another Telegram account.  # Design Guidelines When integrating your 'Telegram BOT' with the 'Wallet pay API', please make sure that the payment button complies with the following guidelines:  1. The payment button should be named exactly like one of these two:      1. `:purse: Wallet Pay`     2. `:purse: Pay via Wallet`. 2. The payment button is located above the other buttons (if you have others).  Note: `:purse:` is an emoji (see https://emojipedia.org/purse/).  Please see the example in [Demo Store Bot](https://t.me/PineAppleDemoWPStoreBot).  # Use Case 1. The customer initiates the payment process in the merchant's Telegram bot. 2. Merchant's bot:     1. addresses the POST order;     2. receives the payLink in response;     3. shows the user the \"Pay\" button. 3. The customer taps the \"Pay\" button. 4. The merchant's bot redirects the customer to the payLink in the Wallet Bot. 5. If the customer uses Wallet for the first time, they agree to:     1. add Wallet to the Attachments menu;     2. allow Wallet to send messages.  6. Wallet:     1. authenticates the customer;     2. checks the balance and displays a form:         1. to confirm the payment (if the balance is sufficient);         2. to top up the balance (if the balance is insufficient).   7. The customer confirms the payment. 8.  Wallet:     1. withdraws the funds from the customer's account and credits them to the partner store's account;     2. redirects the customer back to the partner's specified returnURL;     3. sends a webhook to the merchant.  # Authorization The 'API key' must be provided in the HTTP header 'Wpay-Store-Api-Key'.  Example:   ```sh curl -X POST --location 'https://pay.wallet.tg/wpay/store-api/v1/order' \\ --header 'Wpay-Store-Api-Key: YOUR_STORE_API_KEY'\\ --header 'Content-Type: application/json' \\ --header 'Accept: application/json' -d '{   \"amount\": {     \"amount\": 30.45,     \"currencyCode\": \"TON\"   },   \"externalId\": \"ORD-5023-4E89\",   \"timeoutSeconds\": 10800,   \"description\": \"VPN for 1 month\",   \"returnUrl\": \"https://t.me/wallet\",   \"failReturnUrl\": \"https://t.me/wallet\",   \"customData\": \"client_ref=4E89\" }' ```  # HTTP status codes The table below describes the possible HTTP response codes you can receive when sending an API request. |Code|Description| |-------------|-----------------------| | 200         | OK                    | | 400         | Invalid request       | | 401         | Invalid API key       | | 404         | Not found             | | 429         | Request limit reached | | 500         | Unexpected error      |  # Webhook  After completing the order, we send a POST request to the store backend if the webhook is configured correctly. We expect Webhook endpoint to have an SSL certificate issued by trusted certificate authorities (CA),  such as Let's Encrypt. Self-signed certificates will not be accepted. We wait for an HTTP status of 200 and repeat the POST request several times.  Keep in mind that the webhook may be sent multiple times due to network issues and retries. If your integration is configured to receive webhook notifications, they will be sent from specific IP addresses: ``` 172.255.248.29 172.255.248.12 ```  ### Webhook headers | Field                   | Type   | Description                                                                       | |-------------------------|--------|-----------------------------------------------------------------------------------| | WalletPay-Timestamp     | string | Nano time used for HMAC                                                           | | Walletpay-Signature     | string | Base64(HmacSHA256(\"HTTP-method.URI-path.timestamp.Base-64-encoded-body\"))         |  ### Webhook body Body contains ARRAY of webhook-messages.  **Webhook message structure** | Field         | Type              | Description                                                                      | |---------------|-------------------|----------------------------------------------------------------------------------| | eventDateTime | string, date-time | ISO-8601 date time when some event triggered this webhook message                | | eventId       | int64             | Idempotency key, for single event we send no more than 1 type of webhook message | | type          | string            | Type of payload. Currently ORDER_PAID / ORDER_FAILED                             | | payload       | object            | Json payload of message, see \"Payload object structure\" below                    |  **Payload object structure** | Field                             | Type              | Description                                                                                                                              | |-----------------------------------|-------------------|------------------------------------------------------------------------------------------------------------------------------------------| | status CONDITIONAL                | string            | Order status, clarifying reason of FAIL (e.g. status=EXPIRED) Sent if type=ORDER_FAILED                                                  | | id                                | int64             | Order id                                                                                                                                 | | number                            | string            | Human-readable (short) order number                                                                                                      | | externalId                        | string            | Order ID in the Merchant system                                                                                                          | | customData                        | string            | Custom string given during order creation                                                                                                | | orderAmount                       | string            | Order amount and currency code  Format: { \"currencyCode\": \"TON\", \"amount\": \"30.45\" }                                                     | | selectedPaymentOption CONDITIONAL | json              | User selected payment option.  Format: {\"amount\": {\"currencyCode\": \"TON\",\"amount\": \"10.0\"},\"exchangeRate\": \"1.0\"} Sent if type=ORDER_PAID| | orderCompletedDateTime            | string, date-time | ISO-8601 date time when the order was PAID/FAILED                                                                                        |  ### Verifying webhook  You must verify the received update and the integrity of the received data by comparing the _Walletpay-Signature_  header parameter and the Base-64 representation of the HMAC-SHA-256 signature used to sign  \"HTTP-method.URI-path.timestamp.Base-64-encoded-body\" with the secret key, which is your _Wpay-Store-Api-Key_. timestamp here is the value from WalletPay-Timestamp header <SecurityDefinitions />
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.6.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace WalletPay\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use WalletPay\ApiException;
use WalletPay\Configuration;
use WalletPay\HeaderSelector;
use WalletPay\ObjectSerializer;

/**
 * OrderApi Class Doc Comment
 *
 * @category Class
 * @package  WalletPay
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class OrderApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'create' => [
            'application/json',
        ],
        'getPreview' => [
            'application/json',
        ],
    ];

/**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation create
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  \WalletPay\Model\CreateOrderRequest $create_order_request create_order_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['create'] to see the possible values for this operation
     *
     * @throws \WalletPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \WalletPay\Model\CreateOrderResponse
     */
    public function create($wpay_store_api_key, $create_order_request, string $contentType = self::contentTypes['create'][0])
    {
        list($response) = $this->createWithHttpInfo($wpay_store_api_key, $create_order_request, $contentType);
        return $response;
    }

    /**
     * Operation createWithHttpInfo
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  \WalletPay\Model\CreateOrderRequest $create_order_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['create'] to see the possible values for this operation
     *
     * @throws \WalletPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \WalletPay\Model\CreateOrderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createWithHttpInfo($wpay_store_api_key, $create_order_request, string $contentType = self::contentTypes['create'][0])
    {
        $request = $this->createRequest($wpay_store_api_key, $create_order_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\WalletPay\Model\CreateOrderResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\WalletPay\Model\CreateOrderResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\WalletPay\Model\CreateOrderResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\WalletPay\Model\CreateOrderResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\WalletPay\Model\CreateOrderResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createAsync
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  \WalletPay\Model\CreateOrderRequest $create_order_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['create'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createAsync($wpay_store_api_key, $create_order_request, string $contentType = self::contentTypes['create'][0])
    {
        return $this->createAsyncWithHttpInfo($wpay_store_api_key, $create_order_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAsyncWithHttpInfo
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  \WalletPay\Model\CreateOrderRequest $create_order_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['create'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createAsyncWithHttpInfo($wpay_store_api_key, $create_order_request, string $contentType = self::contentTypes['create'][0])
    {
        $returnType = '\WalletPay\Model\CreateOrderResponse';
        $request = $this->createRequest($wpay_store_api_key, $create_order_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'create'
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  \WalletPay\Model\CreateOrderRequest $create_order_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['create'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createRequest($wpay_store_api_key, $create_order_request, string $contentType = self::contentTypes['create'][0])
    {

        // verify the required parameter 'wpay_store_api_key' is set
        if ($wpay_store_api_key === null || (is_array($wpay_store_api_key) && count($wpay_store_api_key) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $wpay_store_api_key when calling create'
            );
        }

        // verify the required parameter 'create_order_request' is set
        if ($create_order_request === null || (is_array($create_order_request) && count($create_order_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_order_request when calling create'
            );
        }


        $resourcePath = '/wpay/store-api/v1/order';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($wpay_store_api_key !== null) {
            $headerParams['Wpay-Store-Api-Key'] = ObjectSerializer::toHeaderValue($wpay_store_api_key);
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($create_order_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_order_request));
            } else {
                $httpBody = $create_order_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getPreview
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  string $id Order id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPreview'] to see the possible values for this operation
     *
     * @throws \WalletPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \WalletPay\Model\GetOrderPreviewResponse
     */
    public function getPreview($wpay_store_api_key, $id, string $contentType = self::contentTypes['getPreview'][0])
    {
        list($response) = $this->getPreviewWithHttpInfo($wpay_store_api_key, $id, $contentType);
        return $response;
    }

    /**
     * Operation getPreviewWithHttpInfo
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  string $id Order id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPreview'] to see the possible values for this operation
     *
     * @throws \WalletPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \WalletPay\Model\GetOrderPreviewResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPreviewWithHttpInfo($wpay_store_api_key, $id, string $contentType = self::contentTypes['getPreview'][0])
    {
        $request = $this->getPreviewRequest($wpay_store_api_key, $id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\WalletPay\Model\GetOrderPreviewResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\WalletPay\Model\GetOrderPreviewResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\WalletPay\Model\GetOrderPreviewResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\WalletPay\Model\GetOrderPreviewResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\WalletPay\Model\GetOrderPreviewResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPreviewAsync
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  string $id Order id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPreview'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPreviewAsync($wpay_store_api_key, $id, string $contentType = self::contentTypes['getPreview'][0])
    {
        return $this->getPreviewAsyncWithHttpInfo($wpay_store_api_key, $id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPreviewAsyncWithHttpInfo
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  string $id Order id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPreview'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPreviewAsyncWithHttpInfo($wpay_store_api_key, $id, string $contentType = self::contentTypes['getPreview'][0])
    {
        $returnType = '\WalletPay\Model\GetOrderPreviewResponse';
        $request = $this->getPreviewRequest($wpay_store_api_key, $id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getPreview'
     *
     * @param  string $wpay_store_api_key Store API key (required)
     * @param  string $id Order id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPreview'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPreviewRequest($wpay_store_api_key, $id, string $contentType = self::contentTypes['getPreview'][0])
    {

        // verify the required parameter 'wpay_store_api_key' is set
        if ($wpay_store_api_key === null || (is_array($wpay_store_api_key) && count($wpay_store_api_key) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $wpay_store_api_key when calling getPreview'
            );
        }

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getPreview'
            );
        }


        $resourcePath = '/wpay/store-api/v1/order/preview';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $id,
            'id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);

        // header params
        if ($wpay_store_api_key !== null) {
            $headerParams['Wpay-Store-Api-Key'] = ObjectSerializer::toHeaderValue($wpay_store_api_key);
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
