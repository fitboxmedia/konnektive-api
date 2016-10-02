<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:48 PM
 */

namespace Konnektive\Request\Transaction;


use Konnektive\Request\Request;

/**
 * Class QueryTransactionsRequest
 * @link https://api2.konnektive.com/docs/transaction_query/
 * @package Konnektive\Request\Transaction
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 * @property    string $purchaseId    purchaseId returned by the query purchases API
 * @property    int $customerId    customerId returned by customer query
 * @property    string $txnType    Type of transaction processed
 * @property    string $paySource    The source of payment
 * @property    string $responseType    the result of the transaction
 * @property    string $merchantTxnId    The id assigned to the transaction by the processor
 * @property    int $merchantId    The Konnektive merchantId as specified in the CRM
 * @property    string $cardLast4    Last 4 numbers of the customer's credit card
 * @property    string $cardBin    The BIN # associated with the card (first 6 digits)
 * @property    string $achAccountNumber    Last 4 of the checking account number
 * @property    string $achRoutingNumber    full bank routing number for check
 * @property    boolean $isChargedback    only return transactions that have been charged back
 * @property    string $firstName    customer's first name
 * @property    string $lastName    customer's last name
 * @property    string $companyName    customer's company
 * @property    string $address1    line 1 of customer billing address, should include street address and number
 * @property    string $address2    line 2 of customer billing address (apt. number, suite number, etc)
 * @property    string $postalCode    customer's billing postal code
 * @property    string $city    customer's city
 * @property    string $state    customer's billing state, 2 character ISO codes for US states, foreign countries use country iso code + 3 digit number
 * @property    string $country    customer's billing country
 * @property    string $emailAddress    customers email address
 * @property    string $phoneNumber    customers phone number
 * @property    string $affId    affId returned by the order query or transaction query api calls
 * @property    string $dateRangeType    defaults to dateCreated
 * @property    string $startDate    only transactions processed on or after this date
 * @property    string $endDate    only transactions processed on or before this date
 * @property    int $sortDir    0 is descending, while 1 is ascending
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class QueryTransactionsRequest extends Request
{
    protected $endpointUri = "/transactions/query/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'max:30',
        'purchaseId' => 'max:30',
        'customerId' => 'required|integer',
        'txnType' => 'in:SALE,AUTHORIZE,CAPTURE,VOID,REFUND',
        'paySource' => 'in:CREDITCARD,CHECK,PREPAID',
        'responseType' => 'in:SUCCESS,HARD_DECLINE,SOFT_DECLINE',
        'merchantTxnId' => 'max:32',
        'merchantId' => 'integer',
        'cardLast4' => 'max:4',
        'cardBin' => 'max:6',
        'achAccountNumber' => 'max:4',
        'achRoutingNumber' => 'max:9',
        'isChargedback' => 'boolean',
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
        'affId' => 'max:20',
        'dateRangeType' => 'in:dateCreated,dateUpdated',
        'startDate' => 'required_without_all:customerId,purchaseId,orderId',
        'endDate' => 'required_without_all:customerId,purchaseId,orderId',
        'sortDir' => 'integer|in:0,1',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}