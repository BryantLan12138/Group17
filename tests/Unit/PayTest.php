<?php

namespace Tests\Unit;

use App\Report;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayTest extends TestCase
{
    use WithFaker;

    protected $paymentProvider;
    //    paypal payment
    /**
     * @test
     */
    public function testPaypalPay(){

        $create = factory(Report::class)->create();
        $response = $this->post('/car_details/1/payment/paypal');
//        $create->assertStatus(400);
        $response->assertStatus(302);
    }
    /**
     *
     * @test
     */
    public function testPaymentSuccess(){
        $response = $this->get('/paymentsuccess');
        $response->assertStatus(302);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCarDetails()
    {
        //test pay page
        $response = $this->get('car_details/1/payment');
        $response->assertStatus(302);
        $this->assertTrue(true);
    }

    /*public function testShouldCallToPaypalEndpoint()
   {
       $requiredData = $this->faker->url;
       $httpClient = $this->createMock(Report::class);
       $paypalClient = $this->getMockBuilder(PaymentProviderInterface::class)
           ->setConstructorArgs([$requiredData, $httpClient])
           ->setMethods(['call'])
           ->getMock();

        
       $this->instance(PaymentProviderInterface::class, $paypalClient);

       $paypalClient->expects($this->once())->method('call')->with($requiredData)
           ->willReturn($httpClient);

       $this->assertInstanceOf($httpClient, $paypalClient->pay());
   }*/

   
   protected function setUp() :void
    {
        $this->paymentProvider = $this->getMockBuilder(\PaymentProvider::class)
                ->setMethods(['pay'])
                ->getMock();
                
        parent::setUp();
    }

    /*public function testPay()
    {
        // here we set up all the conditions for our test
        $omnipayResponse = $this->getMockBuilder(\PaymentProvider::class)
                ->getMock();

        $omnipayResponse->expects($this->once())
                ->method('isSuccessful')
                ->willReturn(true);

        $this->paymentProvider->expects($this->once())
                ->method('purchaseThroughOmnipay')
                ->willReturn($omnipayResponse);

        $request = [
            // add relevant data here
        ];

        // call to execute the method you want to actually test
        $result = $this->paymentProvider->pay($request);

        // do assertions here on $result
    }*/


}
