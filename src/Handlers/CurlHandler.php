<?php

namespace Konnektive\Handlers;

use Konnektive\Contracts\IHandler;
use Konnektive\Request\Request;
use Konnektive\Response\Response;

/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/6/2016
 * Time: 5:54 PM
 */
class CurlHandler implements IHandler
{

    /**
     * @param $request \Konnektive\Request\Request
     * @return \Konnektive\Response\Response
     */
    public function handle(Request $request)
    {
        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = $request->toArray();

        switch ($request->getVerb()) {
            case "POST":
                curl_setopt($ch, CURLOPT_URL, $request->getUrl());
                curl_setopt($ch, CURLOPT_POST, count($data));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "GET":
                curl_setopt($ch, CURLOPT_URL, $request->getUrl() . "?" . $request->getQuery());
                break;
        }

        $result = curl_exec($ch);
        curl_close($ch);

        if (json_decode($result)) {
            return new Response($result);
        } else {
            $response = new Response("");
            $response->result = "FAILURE";
            $response->raw = $result;
            $response->message = "API result was not properly formatted.";

            return $response;
        }
    }
}