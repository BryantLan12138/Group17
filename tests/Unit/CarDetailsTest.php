<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarDetailsTest extends TestCase
{
    /**
     * A basic unit test example.
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
     * @test
     */
    public function book_cancel_page(){
        $response = $this->get('/car_details/cancel/{cars}');
        $response->assertStatus(302);
        $this->assertTrue(true);
    }
}
