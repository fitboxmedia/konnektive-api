<?php

namespace Konnektive\Request\Transaction;

use Konnektive\Request\Request;

/**
 * Class UpdateTransactionRequest
 * @link https://api.konnektive.com/docs/composite_query/
 * @package Konnektive\Request\Transaction
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $transactionId    transactionId returned by the query transaction api call
 * @property    string $dateRangeType    ENUM - dateCreated or dateUpdated
 * @property    string $startDate    startDate - only records falling on or after this date
 * @property    string $endDate    endDate - only records falling on or before this date
 * @property    string $startTime    startTime - only records falling on or after this time. Must include startDate if passing this value.
 * @property    string $endTime    endTime - only records falling on or before this time. Must include endDate if passing this value.
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class CompositeDataQueryRequest extends Request
{
    protected $endpointUri = "/cbdata/query/";

    protected $rules = [
        'loginId'        => 'required|max:32',
        'password'       => 'required|max:32',
        'transactionId'  => 'required_without:startDate|max:30',
        'dateRangeType'  => 'in:dateCreated,dateUpdated',
        'startDate'      => 'required_without:transactionId|date_format:m/d/Y|before_or_equal:endDate',
        'endDate'        => 'required_without:transactionId|date_format:m/d/Y|after_or_equal:startDate',
        'startTime'      => 'string|date_format:H:i|before_or_equal:endTime',
        'endTime'        => 'string|date_format:H:i|after_or_equal:startTime',
        'resultsPerPage' => 'integer|max:200',
        'page'           => 'integer',
    ];
}