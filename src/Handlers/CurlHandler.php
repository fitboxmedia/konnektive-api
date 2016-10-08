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

        return new Response(curl_exec($ch));
    }
}