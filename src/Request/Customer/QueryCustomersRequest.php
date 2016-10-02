<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:29 PM
 */

namespace Konnektive\Request\Customer;


use Konnektive\Request\Request;

/**
 * Class QueryCustomersRequest
 * @link https://api2.konnektive.com/docs/customer_query/
 * @package Konnektive\Request\Customer
 *
 * @property    string loginId    Api Login Id provided by Konnektive
 * @property    string password    Api password provided by Konnektive
 * @property    string firstName    customer's first name
 * @property    string lastName    customer's last name
 * @property    string companyName    customer's company
 * @property    string address1    line 1 of customer billing address, should include street address and number
 * @property    string address2    line 2 of customer billing address (apt. number, suite number, etc)
 * @property    string postalCode    customer's billing postal code
 * @property    string city    customer's city
 * @property    string state    customer's billing state, 2 character ISO codes for US states, foreign countries use country iso code + 3 digit number
 * @property    string country    customer's billing country
 * @property    string emailAddress    customers email address
 * @property    string phoneNumber    customers phone number
 * @property    string ipAddress    customers ip address
 * @property    string dateRangeType    defaults to dateCreated
 * @property    string startDate    only purchases created on or after this date
 * @property    string endDate    only purchases created on or before this date
 * @property    string sortDir    0 is descending, while 1 is ascending
 * @property    int resultsPerPage    Number of results to return (defaults to 25)
 * @property    int page    which page of the query results to return
 */
class QueryCustomersRequest extends Request
{
    protected $endpointUri = "/customer/query/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'firstName' => 'max:30',
        'lastName' => 'max:30',
        'companyName' => 'max:30',
        'address1' => 'max:30',
        'address2' => 'max:30',
        'postalCode' => 'max:20',
        'city' => 'max:30',
        'state' => 'max:6|valid_state_for_country:country',
        'country' => 'max:2',
        'emailAddress' => 'email',
        'phoneNumber' => 'max:20',
        'ipAddress' => 'max:64',
        'dateRangeType' => 'in:dateCreated,dateUpdated,mostRecentActivity',
        'startDate' => 'required_without:customerId|date_format:"m/d/Y"',
        'endDate' => 'required_without:customerId|date_format:"m/d/Y"',
        'sortDir' => 'in:0,1',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}