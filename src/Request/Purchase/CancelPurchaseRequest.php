<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:22 PM
 */

namespace Konnektive\Request\Purchase;


use Konnektive\Request\Request;

/**
 * Class CancelPurchaseRequest
 * @link https://api2.konnektive.com/docs/purchase_cancel/
 * @package Konnektive\Request\Purchase
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $purchaseId    purchaseId returned by the query purchase api call
 * @property    string $cancelReason    Reason the order was cancelled
 * @property    boolean $fullRefund    If set to true, a full refund will be issued on the order
 * @property    boolean $afterNextBill    If set, continuity purchases will be cancelled after the next scheduled billing
 */
class CancelPurchaseRequest extends Request
{
    protected $endpointUri = "/purchase/cancel/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'purchaseId' => 'required|max:30',
        'cancelReason' => 'required|max:100',
        'fullRefund' => 'boolean',
        'afterNextBill' => 'boolean',
    ];
}