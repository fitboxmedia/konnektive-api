<?php

namespace Konnektive\Tests\Mocks;


use Konnektive\Contracts\IHandler;
use Konnektive\Request\Request;
use Konnektive\Response\Response;

/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/8/2016
 * Time: 11:30 AM
 */
class MockHandler implements IHandler
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
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                break;
            case "GET":
                curl_setopt($ch, CURLOPT_URL, $request->getUrl() . "?" . $request->getQuery());
                break;
        }

        $result = curl_getinfo($ch);
        curl_close($ch);

        $response = new Response($result);
        $response->result = "TEST";
        $response->message = "FAKE TEST OF MOCK HANDLER";
        $response->raw = $result;
        return $response;
    }
}