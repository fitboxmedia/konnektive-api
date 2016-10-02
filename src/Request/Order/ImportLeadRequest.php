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
 * @property string $companyName customer's company
 * @property string $address1 line 1 of customer billing address, should include street address and number
 * @property string $address2 line 2 of customer billing address (apt. number, suite number, etc)
 * @property string $postalCode customer's billing postal code
 * @property string $city customer's city
 * @property string $state customer's billing state, abbreviated state code (varies from country to country). A list of valid values can be found here: https://api2.konnektive.com/docs/states_list/
 * @property string $country customer's billing country
 * @property string $emailAddress must be a valid email address format
 * @property string $phoneNumber may contain numeric digits and hyphens
 * @property string $ipAddress must be a valid ip format (xxx.xxx.xxx.xxx)
 * @property boolean $billShipSame If set indicates that shipping address fields are the same as billing address fields
 * @property string $shipFirstName customer's ship to first name
 * @property string $shipLastName customer's ship to last name
 * @property string $shipCompanyName customer's ship to company
 * @property string $shipAddress1 line 1 of customer shipping address, should include street address and number
 * @property string $shipAddress2 line 2 of customer shipping address (apt. number, suite number, etc)
 * @property string $shipPostalCode customer's shipping postal code
 * @property string $shipCity customer's shipping city
 * @property string $shipState customer's shipping state, abbreviated state code (varies from country to country) A list of valid values can be found here: https://api2.konnektive.com/docs/states_list/
 * @property string $shipCountry customer's shipping country
 * @property int $campaignId Konnektive hexidecimal campaignId for which the order is being placed.
 * @property string $affId Konnektive affiliate Id for Online Campaigns
 * @property string $sourceValue1 affiliate subId for Online Campaigns
 * @property string $sourceValue2 affiliate subId for Online Campaigns
 * @property string $sourceValue3 affiliate subId for Online Campaigns
 * @property string $custom1 Custom value to store along with the order record
 * @property string $custom2 Custom value to store along with the order record
 * @property string $custom3 Custom value to store along with the order record
 * @property string $custom4 Custom value to store along with the order record
 * @property string $custom5 Custom value to store along with the order record
 */
class ImportLeadRequest extends Request
{
    protected $endpointUri = "/leads/import/";
    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'max:30',
        'firstName' => 'required|max:30',
        'lastName' => 'required|max:30',
        'companyName' => 'max:30',
        'address1' => 'required|max:30',
        'address2' => 'max:30',
        'postalCode' => 'required|max:20',
        'city' => 'required|max:30',
        'state' => 'required|max:6|valid_state_for_country:country',
        'country' => 'required|max:2',
        'emailAddress' => 'required|max:255',
        'phoneNumber' => 'required|max:32',
        'ipAddress' => 'required|max:64',
        'billShipSame' => 'boolean',
        'shipFirstName' => 'required_if:billShipSame,1|max:30',
        'shipLastName' => 'required_if:billShipSame,1|max:30',
        'shipCompanyName' => 'max:30',
        'shipAddress1' => 'required_if:billShipSame,1|max:30',
        'shipAddress2' => 'max:30',
        'shipPostalCode' => 'required_if:billShipSame,1|max:20',
        'shipCity' => 'required_if:billShipSame,1|max:30',
        'shipState' => 'required_if:billShipSame,1|max:6|valid_state_for_country:shipCountry',
        'shipCountry' => 'required_if:billShipSame,1|max:2',
        'campaignId' => 'required|integer',
        'affId' => 'max:10',
        'sourceValue1' => 'max:30',
        'sourceValue2' => 'max:30',
        'sourceValue3' => 'max:30',
        'custom1' => 'max:30',
        'custom2' => 'max:30',
        'custom3' => 'max:30',
        'custom4' => 'max:30',
        'custom5' => 'max:30'
    ];
}