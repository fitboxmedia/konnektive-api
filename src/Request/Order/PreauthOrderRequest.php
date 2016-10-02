<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 8:53 AM
 */

namespace Konnektive\Request\Order;


use Carbon\Carbon;
use Konnektive\Request\Request;

/**
 * Class PreauthOrderRequest
 * @link https://api2.konnektive.com/docs/order_preauth/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    int $customerId    Id of the customer as assigned by Konnektive (Import Lead call)
 * @property    string $orderId    Id of the order as assigned by Konnektive (Import Lead call)
 * @property    string $paySource    the pay source used for the purchase
 * @property    string $cardNumber    customer's credit card number
 * @property    string $cardExpiryDate    credit card expiration date
 * @property    int $cardSecurityCode    credit card security code
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
 */
class PreauthOrderRequest extends Request
{
    protected $endpointUri = "/order/preauth/";
    public $paySource = "CREDITCARD";

    protected $rules = [
        'loginId' => "required|max:32",
        'password' => "required|max:32",
        'customerId' => "required|max:10",
        'orderId' => "required|max:20",
        'paySource' => "required|in:CREDITCARD",
        'cardNumber' => "required|creditcard",
        'cardExpiryDate' => "required|date_multi_format:'m/Y','m/y'",
        'cardSecurityCode' => "required|max:4",
        'firstName' => "max:30",
        'lastName' => "max:30",
        'companyName' => "max:30",
        'address1' => "max:30",
        'address2' => "max:30",
        'postalCode' => "max:20",
        'city' => "max:30",
        'state' => "max:6",
        'country' => "max:2",
        'emailAddress' => "max:255",
        'phoneNumber' => "max:20",
        'ipAddress' => "max:255"
    ];
}