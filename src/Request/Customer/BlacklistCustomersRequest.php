<?php

namespace Konnektive\Request\Customer;


use Konnektive\Request\Request;

/**
 * Class QueryCustomersRequest
 * @link https://api.konnektive.com/docs/customer_blacklist/
 * @package Konnektive\Request\Customer
 *
 * @property    string loginId    Api Login Id provided by Konnektive
 * @property    string password    Api password provided by Konnektive
 * @property    string blacklistType    blacklist type in: cardBin,stateCountry,emailAddress,phoneNumber,ipAddress
 * @property    string customerId    customer ID
 * @property    string cardBin    Card bin
 * @property    string country    Country code
 * @property    string state    customer's billing state, 2 character ISO codes for US states, foreign countries use country iso code + 3 digit number
 * @property    string emailAddress    customers email address
 * @property    string phoneNumber    customers phone number
 * @property    string ipAddress    customers ip address
 * @property    string productId    customers product ID
 */
class BlacklistCustomersRequest extends Request
{
    protected $endpointUri = "/customer/blacklist/";

    protected $verb = "GET";

    protected $rules = [
        'loginId'       => 'required|max:32',
        'password'      => 'required|max:32',
        'blacklistType' => 'required|in:cardBin,stateCountry,emailAddress,phoneNumber,ipAddress',
        'customerId'    => 'integer',
        'cardBin'       => 'max:6',
        'country'       => 'max:2',
        'state'         => 'max:6|valid_state_for_country:country',
        'emailAddress'  => 'email',
        'phoneNumber'   => 'max:20',
        'ipAddress'     => 'max:64',
        'productId'     => 'integer',
    ];
}
