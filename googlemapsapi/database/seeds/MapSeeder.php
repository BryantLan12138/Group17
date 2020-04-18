<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Car;
use App\Carpark;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->delete();
        $car = [
            ['licenseplate' => 'CAR586','make' => 'Volkswagen','model' => 'Golf','carpark' => 'Car Park 1','image' => 'golf01.png'],
            ['licenseplate' => 'CAR793','make' => 'Volkswagen','model' => 'Jetta','carpark' => 'Car Park 2','image' => 'jetta01.png'],
            ['licenseplate' => 'CAR165','make' => 'Volkswagen','model' => 'Tiguan','carpark' => 'Car Park 2','image' => 'tiguan01.png'],
            ['licenseplate' => 'CAR210','make' => 'Volkswagen','model' => 'Golf GTI','carpark' => 'Car Park 2','image' => 'golfgti01.png'],
            ['licenseplate' => 'CAR019','make' => 'Ford','model' => 'Focus','carpark' => 'Car Park 3','image' => 'focus01.png'],
            ['licenseplate' => 'CAR732','make' => 'Ford','model' => 'Taurus','carpark' => 'Car Park 3','image' => 'taurus01.png'],
            ['licenseplate' => 'CAR859','make' => 'Ford','model' => 'Ranger','carpark' => 'Car Park 4','image' => 'ranger01.png'],
            ['licenseplate' => 'CAR329','make' => 'Honda','model' => 'Fit','carpark' => 'Car Park 5','image' => 'fit01.png'],
            ['licenseplate' => 'CAR482','make' => 'Honda','model' => 'Insight','carpark' => 'Car Park 5','image' => 'insight01.png'],
            ['licenseplate' => 'CAR190','make' => 'Nissan','model' => 'Altima','carpark' => 'Car Park 5','image' => 'altima01.png'],
        ];
        Car::insert($car);

        DB::table('carparks')->delete();
        $carpark = [
            ['carpark' => 'Car Park 1','address' => 'Metro Hobbies, Bourke Street, Melbourne, au','capacity' => 10,'vacancy' => 9],
            ['carpark' => 'Car Park 2','address' => 'Queens Domain, 12 Queens Rd, Melbourne,au','capacity' => 10,'vacancy' => 7],
            ['carpark' => 'Car Park 3','address' => 'Hearns Hobbies, Melbourne, au','capacity' => 10,'vacancy' => 8],
            ['carpark' => 'Car Park 4','address' => 'Minotaur, Elizabeth Street, Melbourne, au','capacity' => 10,'vacancy' => 9],
        ];
        Carpark::insert($carpark);
    }
}
