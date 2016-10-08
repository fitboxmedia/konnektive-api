<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 9:17 AM
 */

namespace Konnektive\Request\Order;

use Carbon\Carbon;
use Konnektive\Request\Request;

/**
 * Class ImportOrderRequest
 * @link https://api2.konnektive.com/docs/order_import/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    The orderId returned by a previous import lead call. If passed, address and other values created with Import Lead do not need to be passed again.
 * @property    string $customerId    The customerId of an existing CRM customer. This parameter is useful when using paySource=ACCTONFILE
 * @property    string $firstName    customer's first name
 * @property    string $lastName    customer's last name
 * @property    string $companyName    customer's company
 * @property    string $address1    line 1 of customer billing address, should include street address and number
 * @property    string $address2    line 2 of customer billing address (apt. number, suite number, etc)
 * @property    string $postalCode    customer's billing postal code
 * @property    string $city    customer's city
 * @property    string $state    customer's billing state, abbreviated state code (varies from country to country) View full List
 * @property    string $country    customer's billing country
 * @property    string $emailAddress    must be a valid email address format
 * @property    string $phoneNumber    may contain numeric digits and hyphens
 * @property    string $ipAddress    must be a valid ip format (xxx.xxx.xxx.xxx)
 * @property    boolean $billShipSame    If set indicates that shipping address fields are the same as billing address fields
 * @property    string $shipFirstName    customer's ship to first name
 * @property    string $shipLastName    customer's ship to last name
 * @property    string $shipCompanyName    customer's ship to company
 * @property    string $shipAddress1    line 1 of customer shipping address, should include street address and number
 * @property    string $shipAddress2    line 2 of customer shipping address (apt. number, suite number, etc)
 * @property    string $shipPostalCode    customer's shipping postal code
 * @property    string $shipCity    customer's shipping city
 * @property    string $shipState    customer's shipping state, abbreviated state code (varies from country to country) View full List
 * @property    string $shipCountry    customer's shipping country
 * @property    string $paySource    the pay source used for the purchase.
 * @property    int $cardNumber    customer's credit card number
 * @property    string $cardMonth    credit card month of expiration
 * @property    string $cardYear    credit card year of expiration
 * @property    int $cardSecurityCode    credit card security code
 * @property    int $preAuthBillerId    merchantId from konnektive CRM
 * @property    string $preAuthMerchantTxnId    The transactionId returned by the processor for the preauth transaction
 * @property    double $salesTax    if set this will override the default sales tax
 * @property    string $achAccountType    account type of customer's ach account
 * @property    int $achRoutingNumber    bank routing number, must be a valid routing number
 * @property    int $achAccountNumber    account number of customer's ach account
 * @property    int $campaignId    Konnektive hexidecimal campaignId for which the order is being placed.
 * @property    boolean $forceQA    If set places order into Quality Assurance
 * @property    boolean $insureShipment    Charges Shipping Insurance according to CRM configuration
 * @property    int $product1_id    campaign product Id (found on campaign page)
 * @property    int $product1_qty    quantity of product in order, defaults to quantity of 1 if not set
 * @property    double $product1_price    if set this will override the default price as setup in Konnektive CRM
 * @property    double $product1_shipPrice    if set this will override the default shipping price as setup in Konnektive CRM
 * @property    string $couponCode    coupon code for order discount as setup in Konnektive CRM
 * @property    int $shipProfileId    Ship profile id of a shipping profile as setup in Konnektive CRM
 * @property    string $affId    Konnektive affiliate Id for Online Campaigns
 * @property    string $sourceValue1    affiliate subId for Online Campaigns
 * @property    string $sourceValue2    affiliate subId for Online Campaigns
 * @property    string $sourceValue3    affiliate subId for Online Campaigns
 * @property    string $sourceValue4    affiliate subId for Online Campaigns
 * @property    string $sourceValue5    affiliate subId for Online Campaigns
 * @property    string $custom1    Custom value to store along with the order record
 * @property    string $custom2    Custom value to store along with the order record
 * @property    string $custom3    Custom value to store along with the order record
 * @property    string $custom4    Custom value to store along with the order record
 * @property    string $custom5    Custom value to store along with the order record
 * @property    string $redirectsTo    Indicates where the bank should redirect the customer on a successful 3DS transaction
 * @property    string $errorRedirectsTo    Indicates where the bank should redirect the customer on a failed 3DS transaction
 */
class ImportOrderRequest extends Request
{
    protected $endpointUri = "/order/import/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'max:30',
        'customerId' => 'max:30',
        'firstName' => 'required|max:30',
        'lastName' => 'required|max:30',
        'companyName' => 'max:30',
        'address1' => 'required|max:30',
        'address2' => 'max:30',
        'postalCode' => 'required|max:20',
        'city' => 'required|max:30',
        'state' => 'required|max:6',
        'country' => 'required|max:2',
        'emailAddress' => 'required|max:255',
        'phoneNumber' => 'required|max:20',
        'ipAddress' => 'required|max:255',
        'billShipSame' => 'boolean',
        'shipFirstName' => 'required_if:billShipSame,false|max:30',
        'shipLastName' => 'required_if:billShipSame,false|max:30',
        'shipCompanyName' => "max:30",
        'shipAddress1' => 'required_if:billShipSame,false|max:30',
        'shipAddress2' => 'max:30',
        'shipPostalCode' => 'required_if:billShipSame,false|max:20',
        'shipCity' => "required_if:billShipSame,false|max:30",
        'shipState' => "required_if:billShipSame,false|max:6",
        'shipCountry' => "required_if:billShipSame,false|size:2",
        'paySource' => "required|in:CREDITCARD,CHECK,ACCTONFILE,PREPAID",
        'cardNumber' => 'required_if:paySource,CREDITCARD|numeric|digits:16|creditcard',
        'cardMonth' => 'required_if:paySource,CREDITCARD|date_format:"m"',
        'cardYear' => 'required_if:paySource,CREDITCARD|date_format:"Y"',
        'cardSecurityCode' => "required_if:paySource,CREDITCARD|numeric|digits_between:3,4",
        /**
         * These may be conditionally required in the future, but to prevent tight coupling they have been left as their type and length validation.
         */
        'preAuthBillerId' => "numeric",
        'preAuthMerchantTxnId' => "max:30",
        'salesTax' => "numeric",
        'achAccountType' => "required_if:paySource,CHECK|in:CHECKING,SAVINGS",
        'achRoutingNumber' => "required_if:paySource,CHECK|numeric|digits:9",
        'achAccountNumber' => "required_if:paySource,CHECK|numeric|digits:14",
        'campaignId' => "required|numeric",
        'forceQA' => "boolean",
        'insureShipment' => "boolean",
        'product1_id' => 'required|numeric',
        'product1_qty' => 'numeric',
        'product1_price' => 'numeric',
        'product1_shipPrice' => 'numeric',
        /**
         * Dynamic product number validation is provided in the rules() method.
         */
        'couponCode' => 'max:30',
        'shipProfileId' => 'numeric',
        'affId' => 'max:10',
        'sourceValue1' => "max:30",
        'sourceValue2' => "max:30",
        'sourceValue3' => "max:30",
        'sourceValue4' => "max:30",
        'sourceValue5' => "max:30",
        'custom1' => "max:50",
        'custom2' => "max:50",
        'custom3' => "max:50",
        'custom4' => "max:50",
        'custom5' => "max:50",
        /**
         * These depend on the 3DS process flow. Use your judgement.
         */
        'redirectsTo' => "max:300",
        'errorRedirectsTo' => "max:300",
    ];

    public function rules()
    {
        foreach ($this->attributes as $key => $val) {
            $matches = [];
            switch (true) {
                case preg_match('/^product(\\d+)_id$/', $key, $matches):
                    $this->rules[$key] = "required|numeric";
                    break;
                case preg_match('/^product(\\d+)_qty$/', $key, $matches):
                    if (!isset($this->rules["product" . $matches[1]."_id"])) {
                        $this->rules["product" . $matches[1]."_id"] = "required|numeric";
                    }
                    $this->rules[$key] = "numeric";
                    break;
                case preg_match('/^product(\\d+)_price$/', $key, $matches):
                    if (!isset($this->rules["product" . $matches[1]."_id"])) {
                        $this->rules["product" . $matches[1]."_id"] = "required|numeric";
                    }
                    $this->rules[$key] = "numeric";
                    break;
                case preg_match('/^product(\\d+)_shipPrice$/', $key, $matches):
                    if (!isset($this->rules["product" . $matches[1]."_id"])) {
                        $this->rules["product" . $matches[1]."_id"] = "required|numeric";
                    }
                    $this->rules[$key] = "numeric";
                    break;
            }
        }

        return $this->rules;
    }
}