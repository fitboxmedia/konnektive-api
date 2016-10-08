<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:36 AM
 */

namespace Konnektive\Request\Order;


use Konnektive\Request\Request;

/**
 * Class QueryOrderRequest
 * @link https://api2.konnektive.com/docs/order_query/
 * @package Konnektive\Request\Order
 * @property    string loginId    Api Login Id provided by Konnektive
 * @property    string password    Api password provided by Konnektive
 * @property    string orderId    orderId returned by the import order api call
 * @property    string orderStatus    The order status
 * @property    int campaignId    The numeric konnektive campaign id
 * @property    boolean isDeclineSave    Whether or not an order was completed due to a call center save
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
 * @property    string startDate    only orders taken on or after this date
 * @property    string endDate    only orders taken on or before this date
 * @property    int resultsPerPage    Number of results to return (defaults to 25)
 * @property    int page    which page of the query results to return
 */
class QueryOrderRequest extends Request
{
    protected $endpointUri = "/order/query/";

    protected $verb = "GET";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'max:30',
        'orderStatus' => 'in:COMPLETE,PARTIAL,DECLINED,REFUNDED,CANCELLED',
        'campaignId' => 'integer',
        'isDeclineSave' => 'boolean',
        'firstName' => 'max:30',
        'lastName' => 'max:30',
        'companyName' => 'max:30',
        'address1' => 'max:30',
        'address2' => 'max:30',
        'postalCode' => 'max:20',
        'city' => 'max:30',
        'state' => 'max:6|valid_state_for_country:country',
        'country' => 'max:2',
        'emailAddress' => 'email|max:255',
        'phoneNumber' => 'max:20|regex:/^[0-9-]+$/',
        'ipAddress' => 'max:64',
        'dateRangeType' => 'in:dateCreated,dateUpdated',
        'startDate' => 'required_without:orderId,customerId|date_format:m/d/Y|before:endDate',
        'endDate' => 'required_without:orderId,customerId|date_format:m/d/Y|after:startDate',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}