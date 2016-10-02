<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 1:25 PM
 */

namespace Konnektive\Request\Report;

use Konnektive\Request\Request;

/**
 * Class QueryRetentionReportRequest
 * @link https://api2.konnektive.com/docs/report_retention/
 * @package Konnektive\Request\Report
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $reportType    View report by report type
 * @property    int $campaignId    The numeric Konnektive campaign id
 * @property    int $productId    The numberic Konnektive product id
 * @property    string $affiliateId    The numeric Konnektive affiliate id
 * @property    string $callCenterId    The numeric Konnektive call center id
 * @property    int $maxCycles    The number of billing cycles
 * @property    string $include    If provided, includes the corresponding subrows as given in the CRM (BySubAff will necessarily also include ByPublisher)
 * @property    string $startDate    only transactions processed on or after this date
 * @property    string $endDate    only transactions processed on or before this date
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class QueryRetentionReportRequest extends Request
{
    protected $endpointUri = "/reports/retention/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'reportType' => 'required|in:campaign,source,mid',
        'campaignId' => 'integer',
        'productId' => 'integer',
        'affiliateId' => 'max:255',
        'callCenterId' => 'max:255',
        'maxCycles' => 'integer',
        'include' => 'in:ByProduct,ByPublisher,BySubAff',
        'startDate' => 'date_format:"m/d/Y"',
        'endDate' => 'date_format:"m/d/Y"',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}