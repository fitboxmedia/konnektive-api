<?php

namespace Konnektive\Request\Purchase;


use Konnektive\Request\Request;

/**
 * Class RefundPurchaseRequest
 * @link https://api2.konnektive.com/docs/purchase_refund/
 * @package Konnektive\Request\Purchase
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $purchaseId    purchaseId returned by the query purchase api call
 * @property    double $refundAmount    The dollar amount to refund
 * @property    boolean $fullRefund    If set to true, a full refund will be issued on the order
 */
class RefundPurchaseRequest extends Request
{
    protected $endpointUri = "/purchase/refund/";

    protected $rules = [
        'loginId'      => 'required|max:32',
        'password'     => 'required|max:32',
        'purchaseId'   => 'required|max:30',
        'refundAmount' => 'required_unless:fullRefund,1|numeric',
        'fullRefund'   => 'boolean',
    ];
}