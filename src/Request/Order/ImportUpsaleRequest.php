<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 11:26 AM
 */

namespace Konnektive\Request\Order;


use Konnektive\Request\Request;

/**
 * Class ImportUpsaleRequest
 * @link https://api2.konnektive.com/docs/upsale_import/
 * @package Konnektive\Request\Order
 *
 * @property    string $loginId    Api Login Id provided by Konnektive
 * @property    string $password    Api password provided by Konnektive
 * @property    string $orderId    orderId returned by the import order api call
 * @property    int $productId    cproduct Id of upsale
 * @property    int $productQty    quantity of upsale, defaults to quantity of 1 if not set
 * @property    double $productPrice    if set this will override the default price as setup in Konnektive CRM
 * @property    double $productShipPrice    if set this will override the default shipping price as setup in Konnektive CRM
 * @property    double $productSalesTax    if set this will be added to any existing sales tax for the current order
 * @property    int $replaceProductId    cproduct Id of previously selected offer in order. If passed, upsell will replace the existing offer.
 */
class ImportUpsaleRequest extends Request
{
    protected $endpointUri = "/upsale/import/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'orderId' => 'required|max:32',
        'productId' => 'required|integer',
        'productQty' => 'integer',
        'productPrice' => 'numeric',
        'productShipPrice' => 'numeric',
        'productSalesTax' => 'numeric',
        'replaceProductId' => 'integer'
    ];
}