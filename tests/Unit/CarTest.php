<?php

namespace Tests\Unit;

use App\Car;
use App\Order;
use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CarTest extends TestCase
{   
    /**
     * Test can get the car list data from database.
     *
     * @return void
     */
    public function testCarList()
    {
        $cars = Car::all();

        $hasVolkswage = false;
        $hasFord = false;
        $hasHonda = false;

        foreach ($cars as $car) {
            if ($car->make == 'Volkswagen') {
                $hasVolkswage = true;
            }

            if ($car->make == 'Ford') {
                $hasFord = true;
            }

            if ($car->make == 'Honda') {
                $hasHonda = true;
            }
        }

        $this->assertTrue($hasVolkswage);
        $this->assertTrue($hasHonda);
        $this->assertTrue($hasFord);
    }

    /**
     * Test can use car cache in database.
     */

    public function testCarDetail()
    {
        $car = Car::find(1);

        $this->assertTrue($car instanceof Car);

        return $car;
    }

    /**
     * 
     * Test show whether the car is booked or not, and the location of the car.
     * @depends testCarDetail
     *
     * @return void
     */
    public function testCarBook(Car $car)
    {
        $this->assertEquals(1, $car->id);

        if ($car->status != 'booked') {
            $car->status = 'booked';
            $car->save();

            $geocache = DB::table('gmaps_geocache')->where('id', $car->id)->first();
            $order = new Order();
            $order->hour = 0;
            $order->minute = 0;
            $order->start_location = $geocache->address;
            $order->end_location = '';

            $order->save();

            $this->assertTrue($order instanceof Order);
        } else {
            $geocache = DB::table('gmaps_geocache')->where('id', $car->id)->first();

            $order = Order::where('start_location', $geocache->address)->get();

            $this->assertTrue($order[0] instanceof Order);
        }
    }
}
