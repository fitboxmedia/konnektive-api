<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 1:21 PM
 */

namespace Konnektive\Request\Report;

use Konnektive\Request\Request;

/**
 * Class QueryMidSummaryReportRequest
 * @link https://api2.konnektive.com/docs/report_midsummary/
 * @package Konnektive\Request\Report
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    int $midId    MerchantId as setup in the Konnektive System
 * @property    string $startDate    only orders taken on or after this date
 * @property    string $endDate    only orders taken on or before this date
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class QueryMidSummaryReportRequest extends Request
{
    protected $endpointUri = "/reports/mid-summary/";

    protected $verb = "GET";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'midId' => 'integer',
        'startDate' => 'date_format:"m/d/Y"|before:endDate',
        'endDate' => 'date_format:"m/d/Y"|after:startDate',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}