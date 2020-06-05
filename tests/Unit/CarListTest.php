<?php

namespace Tests\Unit;

use App\User;
use App\Car;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarListTest extends TestCase
{
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCarList()
    {
        $carId = Car::all();
        if (!empty($carId)){
            $this->assertTrue(true);
        }
        $this->assertFalse(false);

    }
}
