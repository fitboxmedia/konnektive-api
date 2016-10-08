<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/8/2016
 * Time: 11:34 AM
 */

namespace Konnektive\Tests;


use Konnektive\Dispatcher;
use Konnektive\Request\Customer\AddCustomerNoteRequest;
use Konnektive\Request\Membership\ReactiveClubMembership;
use Konnektive\Tests\Mocks\MockHandler;

class DispatcherTest extends TestCase
{
    public function testMockDispatch()
    {
        $handler = new MockHandler();
        $dispatcher = new Dispatcher($handler);

        //TEST POST DISPATCH
        $request = new AddCustomerNoteRequest();
        $request->loginId = "SomeValidStringForID";
        $request->password = "SomeValidPassword";
        $request->customerId = "123123";
        $request->message = "TestMessage";

        $response = $dispatcher->handle($request);

        $this->assertEquals($response->raw['url'], "https://api.konnektive.com/customer/addnote/");

        //TEST GET DISPATCH
        $request = new ReactiveClubMembership();
        $request->loginId = "SomeValidStringForID";
        $request->password = "SomeValidPassword";
        $request->clubId = "123123";
        $request->memberId = "123123";

        $response = $dispatcher->handle($request);

        $this->assertEquals($response->raw['url'], "https://api.konnektive.com/members/reactivate/?loginId=SomeValidStringForID&password=SomeValidPassword&clubId=123123&memberId=123123");
    }
}