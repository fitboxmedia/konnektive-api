<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:40 PM
 */

namespace Konnektive\Request\Customer;


use Konnektive\Request\Request;

/**
 * Class UpdateCustomerRequest
 * @link https://api2.konnektive.com/docs/customer_update/
 * @package Konnektive\Request\Customer
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
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
 * @property    string $shipFirstName    customer's ship to first name
 * @property    string $shipLastName    customer's ship to last name
 * @property    string $shipCompanyName    customer's ship to company
 * @property    string $shipAddress1    line 1 of customer shipping address, should include street address and number
 * @property    string $shipAddress2    line 2 of customer shipping address (apt. number, suite number, etc)
 * @property    string $shipPostalCode    customer's shipping postal code
 * @property    string $shipCity    customer's shipping city
 * @property    string $shipState    customer's shipping state, abbreviated state code (varies from country to country) View full List
 * @property    string $shipCountry    customer's shipping country
 * @property    string $custom1    Custom value to store along with the order record
 * @property    string $custom2    Custom value to store along with the order record
 * @property    string $custom3    Custom value to store along with the order record
 * @property    string $custom4    Custom value to store along with the order record
 * @property    string $custom5    Custom value to store along with the order record
 */
class UpdateCustomerRequest extends Request
{
    protected $endpointUri = "/customer/update/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'customerId' => 'required|max:30',
        'firstName' => 'max:30',
        'lastName' => 'max:30',
        'companyName' => 'max:30',
        'address1' => 'max:30',
        'address2' => 'max:30',
        'postalCode' => 'max:20',
        'city' => 'max:30',
        'state' => 'max:6|valid_state_for_country:country',
        'country' => 'max:2',
        'emailAddress' => 'max:255',
        'phoneNumber' => 'max:20',
        'shipFirstName' => 'max:30',
        'shipLastName' => 'max:30',
        'shipCompanyName' => "max:30",
        'shipAddress1' => 'max:30',
        'shipAddress2' => 'max:30',
        'shipPostalCode' => 'max:20',
        'shipCity' => "max:30",
        'shipState' => "max:6|valid_state_for_country:shipCountry",
        'shipCountry' => "size:2",
        'custom1' => "max:50",
        'custom2' => "max:50",
        'custom3' => "max:50",
        'custom4' => "max:50",
        'custom5' => "max:50",
    ];
}