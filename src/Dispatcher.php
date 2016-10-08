<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/1/2016
 * Time: 10:12 PM
 */

namespace Konnektive;

use Illuminate\Validation\ValidationException;
use Konnektive\Contracts\IHandler;
use Konnektive\Handlers\CurlHandler;
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
     * @var IHandler
     */
    protected $handler;

    public function __construct(IHandler $handler = null)
    {
        $this->handler = $handler ? : new CurlHandler();
    }

    /**
     * @param IHandler $handler
     * @return void
     */
    public function setHandler(IHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return IHandler
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param Request $request
     * @throws ValidationException
     * @return Response
     */
    public function handle(Request $request)
    {
        $request->validate();

        return $this->getHandler()->handle($request);
    }
}