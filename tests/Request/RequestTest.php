<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/6/2016
 * Time: 6:28 PM
 */

namespace Konnektive\Tests\Request;


use Illuminate\Validation\ValidationException;
use Konnektive\Request\Customer\AddCustomerNoteRequest;
use Konnektive\Request\Customer\QueryCustomerHistoryRequest;
use Konnektive\Request\Customer\QueryCustomersRequest;
use Konnektive\Request\Customer\UpdateCustomerRequest;
use Konnektive\Request\LandingPage\ImportClickRequest;
use Konnektive\Request\Membership\CancelClubMembership;
use Konnektive\Request\Membership\QueryClubMembersRequest;
use Konnektive\Request\Membership\ReactiveClubMembership;
use Konnektive\Request\Order\CancelOrderRequest;
use Konnektive\Request\Order\ConfirmOrderRequest;
use Konnektive\Request\Order\ImportLeadRequest;
use Konnektive\Request\Order\ImportOrderRequest;
use Konnektive\Request\Order\ImportUpsaleRequest;
use Konnektive\Request\Order\OrderQARequest;
use Konnektive\Request\Order\PreauthOrderRequest;
use Konnektive\Request\Order\QueryOrderRequest;
use Konnektive\Request\Order\RefundOrderRequest;
use Konnektive\Request\Order\UpdateFulfillmentRequest;
use Konnektive\Request\Purchase\CancelPurchaseRequest;
use Konnektive\Request\Purchase\QueryPurchasesRequest;
use Konnektive\Request\Purchase\RefundPurchaseRequest;
use Konnektive\Request\Purchase\UpdatePurchaseRequest;
use Konnektive\Request\Report\QueryCampaignRequest;
use Konnektive\Request\Report\QueryMidSummaryReportRequest;
use Konnektive\Request\Report\QueryRetentionReportRequest;
use Konnektive\Request\Request;
use Konnektive\Request\Transaction\QueryTransactionsRequest;
use Konnektive\Request\Transaction\UpdateTransactionRequest;
use Konnektive\Tests\TestCase;

class RequestTest extends TestCase
{
    private $testClasses = [
        //Customer
        AddCustomerNoteRequest::class,
        QueryCustomerHistoryRequest::class,
        QueryCustomersRequest::class,
        UpdateCustomerRequest::class,
        //Landing Page
        ImportClickRequest::class,
        //Membership
        CancelClubMembership::class,
        QueryClubMembersRequest::class,
        ReactiveClubMembership::class,
        //Order
        CancelOrderRequest::class,
        ConfirmOrderRequest::class,
        ImportLeadRequest::class,
        ImportOrderRequest::class,
        ImportUpsaleRequest::class,
        OrderQARequest::class,
        PreauthOrderRequest::class,
        QueryOrderRequest::class,
        RefundOrderRequest::class,
        UpdateFulfillmentRequest::class,
        //Purchase
        CancelPurchaseRequest::class,
        QueryPurchasesRequest::class,
        RefundPurchaseRequest::class,
        UpdatePurchaseRequest::class,
        //Report
        QueryCampaignRequest::class,
        QueryMidSummaryReportRequest::class,
        QueryRetentionReportRequest::class,
        //Transaction
        QueryTransactionsRequest::class,
        UpdateTransactionRequest::class
    ];

    private function getValidFillData()
    {
        return [
            "achAccountNumber" => "22222222222222",
            "achAccountType" => "CHECKING",
            "achRoutingNumber" => "111111111",
            "action" => "APPROVE",
            "address1" => "123 Fake St.",
            "address2" => "Suite 12",
            "affId" => "TestAff",
            "affiliateId" => "TestAff",
            "afterNextBill",
            "billNow",
            "billShipSame" => "0",
            "billingIntervalDays",
            "callCenterId",
            "campaignId" => "22",
            "campaignName" => "Test Face Cream",
            "campaignType",
            "cancelReason" => "I don't like stuff",
            "cardBin" => "444444",
            "cardExpiryDate" => "02/2020",
            "cardLast4" => "1111",
            "cardMonth" => "02",
            "cardNumber" => "4111111111111111",
            "cardSecurityCode" => "123",
            "cardYear" => "2020",
            "chargebackAmount" => "20.02",
            "chargebackDate" => "02/15/2020",
            "chargebackNote" => "Chargebacking for some reason",
            "chargebackReasonCode" => "666",
            "city" => "Denver",
            "clubId" => "200",
            "companyName" => "TestCompany",
            "country" => "US",
            "couponCode" => "Testcoupon",
            "custom1" => "Customization",
            "custom2" => "Customization",
            "custom3" => "Customization",
            "custom4" => "Customization",
            "custom5" => "Customization",
            "customerId" => "123123",
            "dateRangeType",
            "dateReturned" => '02/15/2002',
            "dateShipped" => "02/15/2020",
            "emailAddress" => "test@email.com",
            "endDate" => "02/15/2019",
            "errorRedirectsTo" => "http://localhost",
            "finalBillingCycle",
            "firstName" => "TestFirst",
            "forceQA",
            "fulfillmentId" => "999",
            "fulfillmentStatus" => "SHIPPED", //SHIPPED,RMA_PENDING,RETURNED,CANCELLED
            "fullRefund" => true,
            "include",
            "insureShipment",
            "ipAddress" => "192.168.0.1",
            "isChargedback",
            "isDeclineSave",
            "lastName" => "TestLast",
            "loginId" => "SomeValidStringForID",
            "maxCycles",
            "memberId" => "444",
            "merchantId" => "555",
            "merchantTxnId" => "666",
            "message" => "TestMessage",
            "midId" => "123123",
            "newMerchantId" => "834384",
            "nextBillDate",
            "orderId" => "10",
            "orderStatus",
            "page",
            "pageType" => "thankyouPage", //presellPage,leadPage,checkoutPage,upsellPage1,upsellPage2,upsellPage3,upsellPage4,thankyouPage
            "password" => "SomeValidPassword",
            "paySource" => "CREDITCARD", //CREDITCARD,CHECK,ACCTONFILE,PREPAID
            "phoneNumber" => "8018888888",
            "postalCode" => "80188",
            "preAuthBillerId",
            "preAuthMerchantTxnId",
            "price",
            'product1_id' => '1',
            'product1_qty' => '2',
            'product1_price' => '2.00',
            'product1_shipPrice' => '1.00',
            "productId" => "123123123",
            "productPrice",
            "productQty",
            "productSalesTax",
            "productShipPrice",
            "purchaseId" => "1000001",
            "reactivate",
            "redirectsTo",
            "refundAmount" => "10.00",
            "replaceProductId",
            "reportType" => "campaign", //campaign,source,mid
            "requestUri" => "http://localhost",
            "responseType",
            "resultsPerPage",
            "rmaNumber" => "123123123",
            "salesTax",
            "sessionId" => "454545",
            "shipAddress1" => "123 Fake St.",
            "shipAddress2",
            "shipCarrier",
            "shipCity" => "Salt Lake City",
            "shipCompanyName" => "Fake shipping company",
            "shipCountry" => "US",
            "shipFirstName" => "Test",
            "shipLastName" => "Tester",
            "shipMethod",
            "shipPostalCode" => "84040",
            "shipProfileId",
            "shipState" => "TN",
            "shippingPrice",
            "sortDir",
            "sourceValue1",
            "sourceValue2",
            "sourceValue3",
            "sourceValue4",
            "sourceValue5",
            "startDate" => "02/15/2002",
            "state" => "UT",
            "status",
            "trackingNumber" => "AA123456789AA",
            "transactionId" => "123123123",
            "txnType",
            "userAgent" => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
        ];
    }

    public function testRequestValidationSuccess()
    {
        $data = $this->getValidFillData();
        foreach ($this->testClasses as $class) {
            /**
             * @var $request Request
             */
            $request = new $class();
            switch ($class) {
                case QueryTransactionsRequest::class:
                    $data['achAccountNumber'] = substr($data['achAccountNumber'], -4, 4);
                    break;
            }
            $this->fillModel($request, $data);
            $this->assertValid($request);
        }
    }

    private function fillModel(&$request, $data = null)
    {
        if (!isset($data) || !is_array($data)) {
            $data = $this->getValidFillData();
        }

        switch (get_class($request)) {
            case QueryTransactionsRequest::class:
                $data['achAccountNumber'] = substr($data['achAccountNumber'], -4, 4);
                break;
        }

        foreach ($request->rules() as $key => $rule) {
            if (isset($data[$key])) {
                $request->$key = $data[$key];
            }
        }
    }

    public function testDynamicProductsInOrderRequestSuccess()
    {
        $request = new ImportOrderRequest();
        $this->fillModel($request);

        $request->product2_id = "20";
        $request->product2_price = "2.00";

        $this->assertValid($request);
    }

    public function testDynamicProductsWithJustProductId(){
        $request = new ImportOrderRequest();
        $this->fillModel($request);

        $request->product1_id = "10";
        $request->product2_id = "20";

        $this->assertValid($request);
    }

    public function testDynamicProductsInOrderRequestFailure()
    {
        $request = new ImportOrderRequest();
        $this->fillModel($request);
        //Should fail with product2_id being required
        $request->product2_price = "2.00";
        $this->assertInvalid($request);
    }

    public function testLeadsImportBillShipNotSame()
    {
        $request = new ImportLeadRequest();
        $this->fillModel($request);

        $request->billShipSame = false;
        $this->assertValid($request);
    }

    public function testImportOrderBillShipNotSame()
    {
        $request = new ImportOrderRequest();
        $this->fillModel($request);

        $request->billShipSame = false;
        $this->assertValid($request);
    }

    public function testImportOrderCheckPaySource()
    {
        $request = new ImportOrderRequest();
        $this->fillModel($request);

        $request->paySource = "CHECK";
        $this->assertValid($request);
    }

    public function testImportOrderCreditCardPaySource()
    {
        $request = new ImportOrderRequest();
        $this->fillModel($request);

        $request->paySource = "CREDITCARD";
        $this->assertValid($request);
    }

    public function testOrderQueryMissingCustomerAndOrder()
    {
        $request = new QueryOrderRequest();
        $this->fillModel($request);

        $request->customerId = null;
        $request->orderId = null;
        $this->assertValid($request);
    }

    public function testRefundOrderFullRefundFalse()
    {
        $request = new RefundOrderRequest();
        $this->fillModel($request);

        $request->fullRefund = false;
        $this->assertValid($request);
    }

    public function testUpdateFulfillmentMissingFulfillmentId()
    {
        $request = new UpdateFulfillmentRequest();
        $this->fillModel($request);

        $request->fulfillmentId = null;
        $this->assertValid($request);
    }

    public function testUpdateFulfillmentMissingOrderId()
    {
        $request = new UpdateFulfillmentRequest();
        $this->fillModel($request);

        $request->orderId = null;
        $this->assertValid($request);
    }

    public function testUpdateFulfillmentShippedStatus()
    {
        $request = new UpdateFulfillmentRequest();
        $this->fillModel($request);

        $request->fulfillmentStatus = 'SHIPPED';
        $this->assertValid($request);
    }

    public function testUpdateFulfillmentRmaPendingStatus()
    {
        $request = new UpdateFulfillmentRequest();
        $this->fillModel($request);

        $request->fulfillmentStatus = 'RMA_PENDING';
        $this->assertValid($request);
    }

    public function testUpdateFulfillmentReturnedStatus()
    {
        $request = new UpdateFulfillmentRequest();
        $this->fillModel($request);

        $request->fulfillmentStatus = 'RETURNED';
        $this->assertValid($request);
    }

    public function testImportClickMissingSessionId()
    {
        $request = new ImportClickRequest();
        $this->fillModel($request);

        $request->sessionId = null;
        $this->assertValid($request);
    }

    public function testQueryPurchasesMissingCustomerAndPurchaseAndOrder()
    {
        $request = new QueryPurchasesRequest();
        $this->fillModel($request);

        $request->purchaseId = null;
        $request->orderId = null;

        $this->assertValid($request);
    }

    public function testRefundPurchaseNotFullRefund()
    {
        $request = new RefundPurchaseRequest();
        $this->fillModel($request);

        $request->fullRefund = false;

        $this->assertValid($request);
    }

    public function testQueryCustomerHistoryMissingCustomer(){
        $request = new QueryCustomerHistoryRequest();
        $this->fillModel($request);

        $request->customerId = null;
        $this->assertValid($request);
    }

    public function testQueryClubMembersMissingMemberId(){
        $request = new QueryClubMembersRequest();
        $this->fillModel($request);

        $request->memberId = null;
        $this->assertValid($request);
    }

    public function testQueryClubMembersMissingPurchaseId(){
        $request = new QueryClubMembersRequest();
        $this->fillModel($request);

        $request->purchaseId = null;
        $this->assertValid($request);
    }

    public function testQueryClubMembersMissingOrderId(){
        $request = new QueryClubMembersRequest();
        $this->fillModel($request);

        $request->orderId = null;
        $this->assertValid($request);
    }

    public function testTransactionQueryMissingPurchaseId(){
        $request = new QueryTransactionsRequest();
        $this->fillModel($request);

        $request->purchaseId = null;
        $this->assertValid($request);
    }

    public function testTransactionQueryMissingOrderId(){
        $request = new QueryTransactionsRequest();
        $this->fillModel($request);

        $request->orderId = null;
        $this->assertValid($request);
    }

    public function assertValid(Request $request)
    {
        try {
            $request->validate();
        } catch (ValidationException $v) {
            $this->fail("Failed to validate " . get_class($request) . ": " . json_encode($v->validator->failed()));
        }
    }


    public function assertInvalid(Request $request)
    {
        try {
            $request->validate();
        } catch (ValidationException $v) {
            $this->assertTrue(true);
            return true;
        }

        $this->fail("Unexpected valid data in " . get_class($request));
    }
}