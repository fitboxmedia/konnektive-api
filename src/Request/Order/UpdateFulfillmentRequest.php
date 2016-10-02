<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:58 AM
 */

namespace Konnektive\Request\Order;


use Konnektive\Request\Request;

/**
 * Class UpdateFulfillmentRequest
 * @package Konnektive\Request\Order
 *
 * @property	string	$loginId	Api Login Id provided by Konnektive
 * @property	string	$password	Api password provided by Konnektive
 * @property	string	$orderId	orderId returned by the import order api call
 * @property	string	$fulfillmentId	fulfillmentId returned by the query order api call
 * @property	string	$fulfillmentStatus	status of fulfillment
 * @property	string	$trackingNumber	tracking number of fulfillment
 * @property	string	$dateShipped	shipping date of fulfillment
 * @property	double	$refundAmount	The dollar amount to refund
 * @property	string	$rmaNumber	rma number of fulfillment
 * @property	string	$dateReturned	return date of fulfillment
 * @property	string	$shipCarrier	name of shipping carrier
 * @property	string	$shipMethod	shipping method of fulfillment
 */
class UpdateFulfillmentRequest extends Request
{
    protected $endpointUri = "/fulfillment/update/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'required_without:fulfillmentId|max:32',
        'fulfillmentId' => 'required_without:orderId|max:32',
        'fulfillmentStatus' => 'required_with:fulfillmentId|max:32|in:SHIPPED,RMA_PENDING,RETURNED,CANCELLED',
        'trackingNumber' => 'required_if:fulfillmentStatus,SHIPPED|max:32',
        'dateShipped' => 'required_if:fulfillmentStatus,SHIPPED|date_format:"m/d/Y"',
        'refundAmount' => 'required_if:fulfillmentStatus,RMA_PENDING|numeric',
        'rmaNumber' => 'required_if:fulfillmentStatus,RMA_PENDING|max:32',
        'dateReturned' => 'required_if:fulfillmentStatus,RETURNED|date_format:"m/d/Y"',
        'shipCarrier' => 'max:32',
        'shipMethod' => 'max:32',
    ];
}