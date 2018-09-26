<?php

namespace Konnektive\Request\Report;

use Konnektive\Request\Request;

/**
 * Class QueryCampaignRequest
 * @link https://api2.konnektive.com/docs/campaign_query/
 * @package Konnektive\Request\Report
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    int $campaignId    Konnektive campaign Id for campaign
 * @property    string $campaignName    campaign's name
 * @property    string $campaignType    campaign's type
 * @property    string $startDate    only purchases created on or after this date
 * @property    string $endDate    only purchases created on or before this date
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    int $page    which page of the query results to return
 */
class QueryCampaignRequest extends Request
{
    protected $endpointUri = "/campaign/query/";

    protected $verb = "GET";

    protected $rules = [
        'loginId'        => 'required|max:32',
        'password'       => 'required|max:32',
        'campaignId'     => 'integer',
        'campaignName'   => 'max:30',
        'campaignType'   => 'in:PHONE,ECOMMERCE,LANDER',
        'startDate'      => 'date_format:"m/d/Y"',
        'endDate'        => 'date_format:"m/d/Y"',
        'resultsPerPage' => 'integer|max:200',
        'page'           => 'integer',
    ];

}
