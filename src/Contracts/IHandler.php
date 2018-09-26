<?php

namespace Konnektive\Contracts;

interface IHandler
{
    /**
     * @param $request \Konnektive\Request\Request
     * @return \Konnektive\Response\Response
     */
    public function handle(\Konnektive\Request\Request $request);
}