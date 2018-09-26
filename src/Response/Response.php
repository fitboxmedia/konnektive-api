<?php


namespace Konnektive\Response;

/**
 * Class Response
 * @package Konnektive\Response
 */
class Response
{
    public $result;
    public $message;
    public $raw;

    protected $successCodes = ["SUCCESS"];

    public function __construct($rawResponse)
    {
        $data = @json_decode($rawResponse, true);
        if (is_array($data) && isset($data['result'], $data['message'])) {
            $this->result = $data['result'];
            $this->message = $data['message'];
            $this->raw = $rawResponse;
        }
    }

    public function isSuccessful()
    {
        return in_array($this->result, $this->successCodes);
    }
}