<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:55 AM
 */

namespace Konnektive\Request\Order;


use Konnektive\Request\Request;

/**
 * Class OrderQARequest
 * @link https://api2.konnektive.com/docs/order_qa/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 * @property    string $action    If APPROVE, order will pass QA. If DECLINE, order will be rejected.
 */
class OrderQARequest extends Request
{
    protected $endpointUri = "/order/qa/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'required|max:30',
        'action' => 'required|in:APPROVE,DECLINE'
    ];
}