<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/2/2016
 * Time: 12:36 PM
 */

namespace Konnektive\Request\Customer;

use Konnektive\Request\Request;

/**
 * Class AddCustomerNoteRequest
 * @link https://api2.konnektive.com/docs/customer_addnote/
 * @package Konnektive\Request\Customer
 *
 * @property	string	$loginId	Api Login Id provided by Konnektive
 * @property	string	$password	Api password provided by Konnektive
 * @property	string	$customerId	customerId returned by the query customer api call
 * @property	string	$message	The content of the note
 */
class AddCustomerNoteRequest extends Request
{
    protected $endpointUri = "/customer/addnote/";

    protected $rules = [
        'loginId' => 'required|max:32',
        'password' => 'required|max:32',
        'customerId' => 'required|max:30',
        'message' => 'required|max:500'
    ];
}