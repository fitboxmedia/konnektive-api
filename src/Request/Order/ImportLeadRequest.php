<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/1/2016
 * Time: 10:30 PM
 */

namespace Konnektive\Request\Order;


use Konnektive\Request\Request;

/**
 * Class ImportLeadRequest
 * @link https://api2.konnektive.com/docs/leads_import/
 * @package Konnektive\Request\Order
 *
 * @property string $loginId Api Login Id provided by Konnektive
 * @property string $password Api password provided by Konnektive
 * @property string $orderId The orderId returned by a previous import lead call. Setting this will update the existing lead instead of creating a new record.
 * @property string $firstName customer's first name
 * @property string $lastName customer's last name
 * @property string $emailAddress must be a valid email address format
 * @property string $phoneNumber may contain numeric digits and hyphens
 * @property string $shipAddress1 line 1 of customer shipping address, should include street address and number
 * @property string $shipCity customer's shipping city
 * @property string $shipPostalCode customer's shipping postal code
 * @property string $shipState customer's shipping state, abbreviated state code (varies from country to country) A list of valid values can be found here: https://api2.konnektive.com/docs/states_list/
 * @property string $shipCountry customer's shipping country
 * @property int $campaignId Konnektive hexidecimal campaignId for which the order is being placed.
 * @property string $redirectTo customer's next station url
 * @property string $errorRedirectTo customer's redirect with error
 * @property string $sessionId customer's session id
 */
class ImportLeadRequest extends Request
{
    protected $endpointUri = "/leads/import/";
    protected $rules = [
        'loginId'         => 'required|max:32',
        'password'        => 'required|max:32',
        'orderId'         => 'max:30',
        'firstName'       => 'required|max:50',
        'lastName'        => 'required|max:50',
        'emailAddress'    => 'required|max:255',
        'phoneNumber'     => 'required|max:32',
        'shipAddress1'    => 'required|max:100',
        'shipCity'        => 'required|max:30',
        'shipPostalCode'  => 'required|max:20',
        'shipState'       => 'required|max:6|valid_state_for_country:shipCountry',
        'shipCountry'     => 'required|max:2',
        'campaignId'      => 'int',
        'redirectTo'      => 'required|max:100',
        'errorRedirectTo' => 'required|max:100',
        'sessionId'       => 'required|max:32',
    ];
}
