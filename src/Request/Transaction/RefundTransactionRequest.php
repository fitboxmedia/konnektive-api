<?php
/**
 * Author: Denys Siroshtan <siroshtand@gmail.com>
 * Date: 10/06/2017
 * Time: 12:58 PM
 */

namespace Konnektive\Request\Transaction;


use Konnektive\Request\Request;

/**
 * Class RefundTransactionRequest
 * @link https://api2.konnektive.com/docs/transaction_refund/
 * @package Konnektive\Request\Transaction
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $transactionId    transactionId returned by the query transaction api call
 * @property    double $refundAmount    The amount that was refund
 * @property    boolean $fullRefund    Full refund will be issued on the order
 * @property    boolean $cancelPurchase    any purchase associated with the order will be cancelled
 * @property    boolean $externalRefund    no requests will be made to the processor
 * @property    boolean $refundMerchantTxnId    this sets the processor's Transaction Id of the refund
 */
class RefundTransactionRequest extends Request
{
    protected $endpointUri = "/transactions/refund/";

    protected $rules = [
        'loginId'             => 'required|max:32',
        'password'            => 'required|max:32',
        'transactionId'       => 'required|max:30',
        'refundAmount'        => 'required|numeric',
        'fullRefund'          => 'boolean',
        'cancelPurchase'      => 'boolean',
        'externalRefund'      => 'boolean',
        'refundMerchantTxnId' => 'required|max:500',
    ];
}