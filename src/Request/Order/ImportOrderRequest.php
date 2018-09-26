<?php

namespace Konnektive\Request\Order;

use Konnektive\Request\Request;

/**
 * Class ImportOrderRequest
 * @link https://api2.konnektive.com/docs/order_import/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    The orderId returned by a previous import lead call. If passed, address and other values created with Import Lead do not need to be passed again.
 * @property    boolean $billShipSame    If set indicates that shipping address fields are the same as billing address fields
 * @property    string $paySource    the pay source used for the purchase.
 * @property    int $cardNumber    customer's credit card number
 * @property    int $cardSecurityCode    credit card security code
 * @property    string $cardMonth    credit card month of expiration
 * @property    string $cardYear    credit card year of expiration
 * @property    array $orderItems customer's orders list
 * @property    string $redirectsTo    Indicates where the bank should redirect the customer on a successful 3DS transaction
 * @property    string $errorRedirectsTo    Indicates where the bank should redirect the customer on a failed 3DS transaction
 * @property    string $salesUrl current customer url
 * @property    int $campaignId    Konnektive hexidecimal campaignId for which the order is being placed.
 * @property    int $product1_id    campaign product Id (found on campaign page)
 * @property    int $product1_qty    quantity of product in order, defaults to quantity of 1 if not set
 * @property    double $product1_price    if set this will override the default price as setup in Konnektive CRM
 * @property    double $product1_shipPrice    if set this will override the default shipping price as setup in Konnektive CRM
 * @property string $sessionId customer's session id
 */
class ImportOrderRequest extends Request
{
    protected $endpointUri = "/order/import/";

    protected $rules = [
        'loginId'            => 'required|max:32',
        'password'           => 'required|max:32',
        'orderId'            => 'max:30',
        'billShipSame'       => 'boolean',
        'paySource'          => 'required|in:CREDITCARD,PREPAID,CHECK,ACCTONFILE,COD,DIRECTDEBIT',
        'cardNumber'         => 'required_if:paySource,CREDITCARD|numeric|digits:16|creditcard',
        'cardSecurityCode'   => 'required_if:paySource,CREDITCARD|numeric|digits_between:3,4',
        'cardMonth'          => 'required_if:paySource,CREDITCARD|between:1,12',
        'cardYear'           => 'required_if:paySource,CREDITCARD|date_format:"Y"',
        'redirectsTo'        => 'max:300',
        'errorRedirectsTo'   => 'max:300',
        'salesUrl'           => 'max:300',
        'campaignId'         => 'required|numeric',
        'product1_id'        => 'required|numeric',
        'product1_qty'       => 'numeric',
        'sessionId'          => 'required|max:32',
        'product1_price'     => 'numeric',
        'product1_shipPrice' => 'numeric',
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
                    if (!isset($this->rules["product" . $matches[1] . "_id"])) {
                        $this->rules["product" . $matches[1] . "_id"] = "required|numeric";
                    }
                    $this->rules[$key] = "numeric";
                    break;
                case preg_match('/^product(\\d+)_price$/', $key, $matches):
                    if (!isset($this->rules["product" . $matches[1] . "_id"])) {
                        $this->rules["product" . $matches[1] . "_id"] = "required|numeric";
                    }
                    $this->rules[$key] = "numeric";
                    break;
                case preg_match('/^product(\\d+)_shipPrice$/', $key, $matches):
                    if (!isset($this->rules["product" . $matches[1] . "_id"])) {
                        $this->rules["product" . $matches[1] . "_id"] = "required|numeric";
                    }
                    $this->rules[$key] = "numeric";
                    break;
            }
        }

        return $this->rules;
    }
}
