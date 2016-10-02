<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/1/2016
 * Time: 10:12 PM
 */

namespace Konnektive;

use Illuminate\Validation\ValidationException;
use Konnektive\Request\Request;
use Konnektive\Response\Response;

/**
 * Class Dispatcher
 * Primary handler of requests to the Konnektive v2 API
 * @package Konnektive
 */
class Dispatcher
{
    /**
     * @param Request $request
     * @throws ValidationException
     * @return Response
     */
    public function handle(Request $request)
    {
        /**
         * Serialize all data from the request object and prepare it for final send off to konnektive.
         */
        $request->validate();

        //open connection
        $ch = curl_init();

        $data = $request->toArray();

        switch ($request->getVerb()) {
            case "POST":
                curl_setopt($ch, CURLOPT_URL, $request->getUrl());
                curl_setopt($ch, CURLOPT_POST, count($data));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "GET":
                curl_setopt($ch, CURLOPT_URL, $request->getUrl() . "?" . http_build_query($data));
                break;
        }

        return new Response(curl_exec($ch));
    }
}