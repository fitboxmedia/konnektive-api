<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:18 PM
 */

namespace Konnektive\Request\Purchase;


use Konnektive\Request\Request;

/**
 * Class UpdatePurchaseRequest
 * @link https://api2.konnektive.com/docs/purchase_update/
 * @package Konnektive\Request\Purchase
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $purchaseId    purchaseId returned by the query purchases api call
 * @property    boolean $reactivate    Reactivates a cancelled or inactive purchase
 * @property    string $status    Update purchase status
 * @property    boolean $billNow    Attempts to immediately bill the next recurring billing
 * @property    int $newMerchantId    A new Merchant ID (as specified within Konnektive CRM) that this purchase will be billed against
 * @property    double $price    Sets the price of the next recurring billing
 * @property    double $shippingPrice    Sets the shipping price of the next recurring billing
 * @property    string $nextBillDate    Sets the date of the next recurring billing
 * @property    int $billingIntervalDays    Number of days between each recurring bill
 * @property    int $finalBillingCycle    The final billing cycle for this purchase
 */
class UpdatePurchaseRequest extends Request
{
    protected $endpointUri = "/purchase/update/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'purchaseId' => 'required|max:30',
        'reactivate' => 'boolean',
        'status' => 'in:RECYCLE_BILLING,RECYCLE_FAILED',
        'billNow' => 'boolean',
        'newMerchantId' => 'integer',
        'price' => 'numeric',
        'shippingPrice' => 'numeric',
        'nextBillDate' => 'date_format:"m/d/Y"',
        'billingIntervalDays' => 'integer',
        'finalBillingCycle' => 'integer'
    ];
}