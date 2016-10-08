# Konnektive CRM API Integration
---
## What It Is

A simple API integration that allows developers to interact with Konnektive CRM's v2 API. All methods are implemented and fully validated as of October 8, 2016

Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

## Why Use This

When processing transactions and customer data through offers, marketers can benefit substantially from the use of a well tested and consistent 3rd party API integration.


## Installation

Installation instructions using composer COMING SOON!

## Getting Started

`Konnektive` crm integration can be implemented easily by simply filling up one of the request classes and handing it off to the dispatcher for processing like so:
```php
use Konnektive\Dispatcher;

class OfferProcessor {
    public function addCustomerNote(){
        $dispatcher = new Dispatcher();
        /**
        * @var $request \Konnektive\Request\Customer\AddCustomerNoteRequest;
        */
        $request = new AddCustomerNoteRequest();
        $request->loginId = "SomeValidStringForID";
        $request->password = "SomeValidPassword";
        $request->customerId = "123123";
        $request->message = "TestMessage";
        /**
        * @var $response \Konnektive\Response\Response;
        */
        $response = $dispatcher->handle($request);
        if($response->isSuccessful()){
            //Do the thing.
        }
    }
}
```

> **Note:** Custom handlers can be created and passed to Dispatcher during construction.

## Custom Handlers

If you would like to use a custom handler for the dispatch of your request, you can create a new Handler class that implements the IHandler interface:

```php
use Konnektive\Contracts\IHandler;

class CustomHandler implements IHandler
{
    /**
    * @var $request \Konnektive\Request\Request
    * @return \Konnektive\Response\Response
    */
    public function handle(Request $request){
        //Handle that request
        return new Response(/* Some response data from cUrl */);
    }
}
```
The new `CustomHandler` can be passed into the dispatcher at construction or later:
```php
$dispatcher = new Dispatcher(new CustomHandler());
////
$dispatcher->setHandler(new CustomHandler());
```

## Validation

All requests will be validated prior to executing the handler. All validation failures are provided through the `\Illuminate\Validation\ValidationException`. These exceptions are not caught and must be handled in your own code! Validation can also be done prior to dispatch by calling `validate()` on the request object:

```php
/**
* @var $request \Konnektive\Request\Customer\AddCustomerNoteRequest;
*/
$request = new AddCustomerNoteRequest();
$request->loginId = "SomeValidStringForID";
$request->message = "TestMessage";
try {
    $request->validate();
} catch(ValidationException $ex){
    //Fails for customerId and password
}
```

## Requirements

  - PHP 5.6.3+