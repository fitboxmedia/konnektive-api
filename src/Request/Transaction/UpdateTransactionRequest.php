<?php

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
 * @property    string $markChargeback    If set to true, a chargeback will be marked or updated for the transaction
 * @property    string $revertChargeback    If set to true, any chargeback for the transaction will be reverted
 */
class UpdateTransactionRequest extends Request
{
    protected $endpointUri = "/transactions/update/";

    protected $rules = [
        'loginId'              => 'required|max:32',
        'password'             => 'required|max:32',
        'transactionId'        => 'required|max:30',
        'chargebackAmount'     => 'required_if:markChargeback,1|numeric',
        'chargebackDate'       => 'required_if:markChargeback,1|date_format:"m/d/Y"',
        'chargebackReasonCode' => 'required_if:markChargeback,1|max:10',
        'chargebackNote'       => 'required_if:markChargeback,1|max:500',
        'markChargeback'       => 'required_without:revertChargeback',
        'revertChargeback'     => 'required_without:markChargeback',
    ];
}