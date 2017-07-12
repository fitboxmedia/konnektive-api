<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:52 AM
 */

namespace Konnektive\Request\Order;
use Konnektive\Request\Request;

/**
 * Class CancelOrderRequest
 * @link https://api2.konnektive.com/docs/order_cancel/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 * @property    string $cancelReason    Reason the order was cancelled
 * @property    boolean $fullRefund    If set to true, a full refund will be issued on the order
 * @property    boolean $afterNextBill    If set, continuity purchases will be cancelled after the next scheduled billing
 */
class CancelOrderRequest extends Request
{
    protected $endpointUri = "/order/cancel/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'required|max:30',
        'cancelReason' => 'required|max:100',
        'fullRefund' => 'boolean',
        'afterNextBill' => 'boolean',
    ];
}