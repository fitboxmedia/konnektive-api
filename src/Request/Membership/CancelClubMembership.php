<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 1:13 PM
 */

namespace Konnektive\Request\Membership;


use Konnektive\Request\Request;

/**
 * Class CancelClubMembership
 * @link https://api2.konnektive.com/docs/members_cancel/
 * @package Konnektive\Request\Membership
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    int $clubId    The Id of the club as defined in konnektive CRM
 * @property    string $memberId    memberId returned by the members query api
 */
class CancelClubMembership extends Request
{
    protected $endpointUri = "/members/cancel/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'clubId' => 'required|integer',
        'memberId' => 'required|max:32'
    ];
}