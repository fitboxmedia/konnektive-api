<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/1/2016
 * Time: 10:22 PM
 */

namespace Konnektive\Request\LandingPage;


use Konnektive\Request\Request;

/**
 * Class ImportClickRequest
 * @link https://api2.konnektive.com/docs/click_import/
 * @package Konnektive\Request\LandingPage
 *
 * @property string $loginId Api Login Id provided by Konnektive
 * @property string $password Api password provided by Konnektive
 * @property string $pageType Which page in the funnel the user landed on. Valid values are presellPage,leadPage,checkoutPage,upsellPage1,upsellPage2,upsellPage3,upsellPage4,thankyouPage
 * @property string $ipAddress must be a valid ip format (xxx.xxx.xxx.xxx)
 * @property string $userAgent User Agent Header, used for reporting on browser and device type
 * @property int $campaignId Konnektive campaignId for which the order is being placed.
 * @property string $requestUri The URL that the user requested when they landed on the page (Ex. https://mylander.com/nutra/?affId=AF54B33412&c1=fb&c2=5000234)
 * @property string $sessionId sessionId returned by a previous import click call
 */
class ImportClickRequest extends Request
{
    protected $endpointUri = "/landers/clicks/import";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'pageType' => 'required|in:presellPage,leadPage,checkoutPage,upsellPage1,upsellPage2,upsellPage3,upsellPage4,thankyouPage',
        'ipAddress' => 'required_without:sessionId',
        'userAgent' => 'required|max:300',
        'campaignId' => 'required|int',
        'requestUri' => 'required_without:sessionId|max:500',
        'sessionId' => 'max:32'
    ];
}