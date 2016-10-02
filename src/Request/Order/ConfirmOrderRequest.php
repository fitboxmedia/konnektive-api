<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:31 AM
 */

namespace Konnektive\Request\Order;

use Konnektive\Request\Request;

/**
 * Class ConfirmOrderRequest
 * @link https://api2.konnektive.com/docs/confirm_order/
 * @package Konnektive\Request\Order
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 */
class ConfirmOrderRequest extends Request
{
    protected $endpointUri = "/order/confirm/";
    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'max:30',
    ];
}