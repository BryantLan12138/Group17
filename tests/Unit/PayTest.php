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
    /**
     * Test using paypal to pay
     * @test
     */
    public function testPaypalPay(){

        $create = factory(Report::class)->create();
        $response = $this->post('/car_details/1/payment/paypal');
//        $create->assertStatus(400);
        $response->assertStatus(302);
    }
    /**
     * Test get to payment success page.
     * @test
     */
    public function testPaymentSuccess(){
        $response = $this->get('/paymentsuccess');
        $response->assertStatus(302);
    }
    /**
     * Test can get car details in pay page.
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


   protected function setUp() :void
    {
        $this->paymentProvider = $this->getMockBuilder(\PaymentProvider::class)
                ->setMethods(['pay'])
                ->getMock();
                
        parent::setUp();
    }


}
