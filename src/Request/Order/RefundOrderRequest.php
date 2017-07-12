<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:49 AM
 */

namespace Konnektive\Request\Order;


use Konnektive\Request\Request;

/**
 * Class RefundOrderRequest
 * @link https://api2.konnektive.com/docs/order_refund/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 * @property    double $refundAmount    The dollar amount to refund
 * @property    boolean $fullRefund    If set to true, a full refund will be issued on the order
 */
class RefundOrderRequest extends Request
{
    protected $endpointUri = "/order/refund/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'required|max:30',
        'refundAmount' => 'required_if:fullRefund,0|numeric',
        'fullRefund' => 'boolean'
    ];
}