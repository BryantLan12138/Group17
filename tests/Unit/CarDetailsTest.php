<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarDetailsTest extends TestCase
{
    /**
     * Testing booking can get data of car details.
     *
     * @return void
     */
    public function testCarDetails()
    {
        $response = $this->get('/car_details/{cars}');
        $response->assertStatus(302);
        $this->assertTrue(true);
    }

    /**
     * Testing can direct to booking cancel page.
     * @test
     */
    public function book_cancel_page(){
        $response = $this->get('/car_details/cancel/{cars}');
        $response->assertStatus(302);
        $this->assertTrue(true);
    }
}
