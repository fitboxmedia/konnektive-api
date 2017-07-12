<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:31 AM
 */

namespace Konnektive\Request\Order;

use Konnektive\Request\Request;

/**
 * Class RerunDeclinedSaleRequest
 * @link https://api2.konnektive.com/docs/order_rerun/
 * @package Konnektive\Request\Order
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 * @property    string $forceBillerId   billerId to use to rerun (will override item defaults)
 * @property    string $forceLoadBalancerId     loadBalancer to use to rerun (will override item defaults)
 */
class RerunDeclinedSaleRequest extends Request
{
    protected $endpointUri = "/order/rerun/";
    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'required|max:30',
        'forceBillerId' => 'max:30',
        'forceLoadBalancerId' => 'max:30',
    ];
}