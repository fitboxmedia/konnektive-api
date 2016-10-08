<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:11 PM
 */

namespace Konnektive\Request\Purchase;


use Konnektive\Request\Request;

/**
 * Class QueryPurchasesRequest
 * @link https://api2.konnektive.com/docs/purchase_query/
 * @package Konnektive\Request\Purchase
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId of which the purchase was a part
 * @property    string $purchaseId    purchaseId returned by the query purchases API
 * @property    int $customerId    customerId returned by customer query
 * @property    string $firstName    customer's first name
 * @property    string $lastName    customer's last name
 * @property    string $emailAddress    customers email address
 * @property    string $phoneNumber    customers phone number
 * @property    string $dateRangeType    defaults to dateCreated
 * @property    string $startDate    only purchases created on or after this date
 * @property    string $endDate    only purchases created on or before this date
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class QueryPurchasesRequest extends Request
{
    protected $endpointUri = "/purchase/query/";

    protected $verb = "GET";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'max:30',
        'purchaseId' => 'max:30',
        'customerId' => 'required|numeric',
        'firstName' => 'max:30',
        'lastName' => 'max:30',
        'emailAddress' => 'email|max:255',
        'phoneNumber' => 'max:20|regex:/^[0-9-]+$/',
        'dateRangeType' => 'in:dateCreated,dateUpdated',
        'startDate' => 'required_without:orderId,customerId,purchaseId|date_format:"m/d/Y"|before:endDate',
        'endDate' => 'required_without:orderId,customerId,purchaseId|date_format:"m/d/Y"|after:startDate',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}