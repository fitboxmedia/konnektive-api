<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:44 PM
 */

namespace Konnektive\Request\Customer;


use Konnektive\Request\Request;

/**
 * Class QueryCustomerHistoryRequest
 * @link https://api2.konnektive.com/docs/customerHistory_query/
 * @package Konnektive\Request\Customer
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    int $customerId    Customer's Id provided by Konnektive
 * @property    string $startDate    only purchases created on or after this date
 * @property    string $endDate    only purchases created on or before this date
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class QueryCustomerHistoryRequest extends Request
{
    protected $endpointUri = "/customer/history/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'customerId' => 'nullable|numeric',
        'startDate' => 'required_without:customerId|date_format:"m/d/Y"|before:endDate',
        'endDate' => 'required_without:customerId|date_format:"m/d/Y"|after:startDate',
        'resultsPerPage' => 'numeric|max:200',
        'page' => 'numeric'
    ];
}