<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:58 PM
 */

namespace Konnektive\Request\Transaction;


use Konnektive\Request\Request;

/**
 * Class UpdateTransactionRequest
 * @link https://api2.konnektive.com/docs/transaction_update/
 * @package Konnektive\Request\Transaction
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $transactionId    transactionId returned by the query transaction api call
 * @property    double $chargebackAmount    The amount that was charged back
 * @property    string $chargebackDate    the date of the chargeback
 * @property    string $chargebackReasonCode    reason code provided by the issuer
 * @property    string $chargebackNote    Any additional notes about the chargeback
 */
class UpdateTransactionRequest extends Request
{
    protected $endpointUri = "/transactions/update/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'transactionId' => 'required|max:30',
        'chargebackAmount' => 'required|numeric',
        'chargebackDate' => 'required|date_format:"m/d/Y"',
        'chargebackReasonCode' => 'required|max:10',
        'chargebackNote' => 'required|max:500',
    ];
}