<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 1:07 PM
 */

namespace Konnektive\Request\Membership;


use Konnektive\Request\Request;

/**
 * Class QueryClubMembersRequest
 * @link https://api2.konnektive.com/docs/members_query/
 * @package Konnektive\Request\Membership
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $memberId    customer club memberId
 * @property    int $customerId    customerId returned by customer query
 * @property    string $orderId    orderId returned by order query
 * @property    string $purchaseId    purchaseId as returned by purchase query
 * @property    int $clubId    The Id of the club as defined in konnektive CRM
 * @property    string $startDate    only purchases created on or after this date
 * @property    string $endDate    only purchases created on or before this date
 * @property    int $resultsPerPage    Number of results to return (defaults to 25)
 * @property    string $page    which page of the query results to return
 */
class QueryClubMembersRequest extends Request
{
    protected $endpointUri = "/members/query/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'memberId' => 'max:30',
        'customerId' => 'required|integer',
        'orderId' => 'max:30',
        'purchaseId' => 'max:30',
        'clubId' => 'required|integer',
        'startDate' => 'required_without_all:memberId,orderId,purchaseId,customerId|date_format:"m/d/Y"',
        'endDate' => 'required_without_all:memberId,orderId,purchaseId,customerId|date_format:"m/d/Y"',
        'resultsPerPage' => 'integer|max:200',
        'page' => 'integer'
    ];
}