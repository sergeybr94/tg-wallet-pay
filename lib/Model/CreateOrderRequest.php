<?php
/**
 * CreateOrderRequest
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
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

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * CreateOrderRequest Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreateOrderRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CreateOrderRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'amount' => '\OpenAPI\Client\Model\MoneyAmount',
        'description' => 'string',
        'return_url' => 'string',
        'fail_return_url' => 'string',
        'custom_data' => 'string',
        'external_id' => 'string',
        'timeout_seconds' => 'int',
        'customer_telegram_user_id' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'amount' => null,
        'description' => null,
        'return_url' => null,
        'fail_return_url' => null,
        'custom_data' => null,
        'external_id' => null,
        'timeout_seconds' => 'int64',
        'customer_telegram_user_id' => 'int64'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'amount' => false,
		'description' => true,
		'return_url' => true,
		'fail_return_url' => true,
		'custom_data' => true,
		'external_id' => false,
		'timeout_seconds' => false,
		'customer_telegram_user_id' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'amount' => 'amount',
        'description' => 'description',
        'return_url' => 'returnUrl',
        'fail_return_url' => 'failReturnUrl',
        'custom_data' => 'customData',
        'external_id' => 'externalId',
        'timeout_seconds' => 'timeoutSeconds',
        'customer_telegram_user_id' => 'customerTelegramUserId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'description' => 'setDescription',
        'return_url' => 'setReturnUrl',
        'fail_return_url' => 'setFailReturnUrl',
        'custom_data' => 'setCustomData',
        'external_id' => 'setExternalId',
        'timeout_seconds' => 'setTimeoutSeconds',
        'customer_telegram_user_id' => 'setCustomerTelegramUserId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'description' => 'getDescription',
        'return_url' => 'getReturnUrl',
        'fail_return_url' => 'getFailReturnUrl',
        'custom_data' => 'getCustomData',
        'external_id' => 'getExternalId',
        'timeout_seconds' => 'getTimeoutSeconds',
        'customer_telegram_user_id' => 'getCustomerTelegramUserId'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('return_url', $data ?? [], null);
        $this->setIfExists('fail_return_url', $data ?? [], null);
        $this->setIfExists('custom_data', $data ?? [], null);
        $this->setIfExists('external_id', $data ?? [], null);
        $this->setIfExists('timeout_seconds', $data ?? [], null);
        $this->setIfExists('customer_telegram_user_id', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ((mb_strlen($this->container['description']) > 100)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 100.";
        }

        if ((mb_strlen($this->container['description']) < 5)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be bigger than or equal to 5.";
        }

        if (!is_null($this->container['return_url']) && (mb_strlen($this->container['return_url']) > 255)) {
            $invalidProperties[] = "invalid value for 'return_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['fail_return_url']) && (mb_strlen($this->container['fail_return_url']) > 255)) {
            $invalidProperties[] = "invalid value for 'fail_return_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['custom_data']) && (mb_strlen($this->container['custom_data']) > 255)) {
            $invalidProperties[] = "invalid value for 'custom_data', the character length must be smaller than or equal to 255.";
        }

        if ($this->container['external_id'] === null) {
            $invalidProperties[] = "'external_id' can't be null";
        }
        if ((mb_strlen($this->container['external_id']) > 255)) {
            $invalidProperties[] = "invalid value for 'external_id', the character length must be smaller than or equal to 255.";
        }

        if ($this->container['timeout_seconds'] === null) {
            $invalidProperties[] = "'timeout_seconds' can't be null";
        }
        if (($this->container['timeout_seconds'] > 864000)) {
            $invalidProperties[] = "invalid value for 'timeout_seconds', must be smaller than or equal to 864000.";
        }

        if (($this->container['timeout_seconds'] < 30)) {
            $invalidProperties[] = "invalid value for 'timeout_seconds', must be bigger than or equal to 30.";
        }

        if ($this->container['customer_telegram_user_id'] === null) {
            $invalidProperties[] = "'customer_telegram_user_id' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets amount
     *
     * @return \OpenAPI\Client\Model\MoneyAmount
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param \OpenAPI\Client\Model\MoneyAmount $amount amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (is_null($amount)) {
            throw new \InvalidArgumentException('non-nullable amount cannot be null');
        }
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Description of the order
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            array_push($this->openAPINullablesSetToNull, 'description');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('description', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($description) && (mb_strlen($description) > 100)) {
            throw new \InvalidArgumentException('invalid length for $description when calling CreateOrderRequest., must be smaller than or equal to 100.');
        }
        if (!is_null($description) && (mb_strlen($description) < 5)) {
            throw new \InvalidArgumentException('invalid length for $description when calling CreateOrderRequest., must be bigger than or equal to 5.');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets return_url
     *
     * @return string|null
     */
    public function getReturnUrl()
    {
        return $this->container['return_url'];
    }

    /**
     * Sets return_url
     *
     * @param string|null $return_url Url to redirect after paying order
     *
     * @return self
     */
    public function setReturnUrl($return_url)
    {
        if (is_null($return_url)) {
            array_push($this->openAPINullablesSetToNull, 'return_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('return_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($return_url) && (mb_strlen($return_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $return_url when calling CreateOrderRequest., must be smaller than or equal to 255.');
        }

        $this->container['return_url'] = $return_url;

        return $this;
    }

    /**
     * Gets fail_return_url
     *
     * @return string|null
     */
    public function getFailReturnUrl()
    {
        return $this->container['fail_return_url'];
    }

    /**
     * Sets fail_return_url
     *
     * @param string|null $fail_return_url Url to redirect after unsuccessful order completion (expiration/cancelation/etc)
     *
     * @return self
     */
    public function setFailReturnUrl($fail_return_url)
    {
        if (is_null($fail_return_url)) {
            array_push($this->openAPINullablesSetToNull, 'fail_return_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('fail_return_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($fail_return_url) && (mb_strlen($fail_return_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $fail_return_url when calling CreateOrderRequest., must be smaller than or equal to 255.');
        }

        $this->container['fail_return_url'] = $fail_return_url;

        return $this;
    }

    /**
     * Gets custom_data
     *
     * @return string|null
     */
    public function getCustomData()
    {
        return $this->container['custom_data'];
    }

    /**
     * Sets custom_data
     *
     * @param string|null $custom_data Any custom string, will be provided through webhook and order status polling, length is limited
     *
     * @return self
     */
    public function setCustomData($custom_data)
    {
        if (is_null($custom_data)) {
            array_push($this->openAPINullablesSetToNull, 'custom_data');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('custom_data', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($custom_data) && (mb_strlen($custom_data) > 255)) {
            throw new \InvalidArgumentException('invalid length for $custom_data when calling CreateOrderRequest., must be smaller than or equal to 255.');
        }

        $this->container['custom_data'] = $custom_data;

        return $this;
    }

    /**
     * Gets external_id
     *
     * @return string
     */
    public function getExternalId()
    {
        return $this->container['external_id'];
    }

    /**
     * Sets external_id
     *
     * @param string $external_id Order ID in Merchant system. Use to prevent orders duplication due to request retries
     *
     * @return self
     */
    public function setExternalId($external_id)
    {
        if (is_null($external_id)) {
            throw new \InvalidArgumentException('non-nullable external_id cannot be null');
        }
        if ((mb_strlen($external_id) > 255)) {
            throw new \InvalidArgumentException('invalid length for $external_id when calling CreateOrderRequest., must be smaller than or equal to 255.');
        }

        $this->container['external_id'] = $external_id;

        return $this;
    }

    /**
     * Gets timeout_seconds
     *
     * @return int
     */
    public function getTimeoutSeconds()
    {
        return $this->container['timeout_seconds'];
    }

    /**
     * Sets timeout_seconds
     *
     * @param int $timeout_seconds Order TTL, if the order is not paid within the timeout period
     *
     * @return self
     */
    public function setTimeoutSeconds($timeout_seconds)
    {
        if (is_null($timeout_seconds)) {
            throw new \InvalidArgumentException('non-nullable timeout_seconds cannot be null');
        }

        if (($timeout_seconds > 864000)) {
            throw new \InvalidArgumentException('invalid value for $timeout_seconds when calling CreateOrderRequest., must be smaller than or equal to 864000.');
        }
        if (($timeout_seconds < 30)) {
            throw new \InvalidArgumentException('invalid value for $timeout_seconds when calling CreateOrderRequest., must be bigger than or equal to 30.');
        }

        $this->container['timeout_seconds'] = $timeout_seconds;

        return $this;
    }

    /**
     * Gets customer_telegram_user_id
     *
     * @return int
     */
    public function getCustomerTelegramUserId()
    {
        return $this->container['customer_telegram_user_id'];
    }

    /**
     * Sets customer_telegram_user_id
     *
     * @param int $customer_telegram_user_id The customer's telegram id (`User_id`). For more details please follow the link https://core.telegram.org/bots/api#available-types
     *
     * @return self
     */
    public function setCustomerTelegramUserId($customer_telegram_user_id)
    {
        if (is_null($customer_telegram_user_id)) {
            throw new \InvalidArgumentException('non-nullable customer_telegram_user_id cannot be null');
        }
        $this->container['customer_telegram_user_id'] = $customer_telegram_user_id;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


