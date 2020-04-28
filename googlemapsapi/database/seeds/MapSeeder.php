<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Car;

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
            ['licenseplate' => 'CAR586','make' => 'Volkswagen','model' => 'Golf','address' => 'Metro Hobbies, Bourke Street, Melbourne, au','image' => 'golf01.png','status' => 'available'],
            ['licenseplate' => 'CAR793','make' => 'Volkswagen','model' => 'Jetta','address' => 'Queens Domain, 12 Queens Rd, Melbourne,au','image' => 'jetta01.png','status' => 'available'],
            ['licenseplate' => 'CAR165','make' => 'Volkswagen','model' => 'Tiguan','address' => 'Marvel Stadium, Melbourne,au','image' => 'tiguan01.png','status' => 'available'],
            ['licenseplate' => 'CAR210','make' => 'Volkswagen','model' => 'Golf GTI','address' => 'DFO South Wharf, Melbourne,au','image' => 'golfgti01.png','status' => 'available'],
            ['licenseplate' => 'CAR019','make' => 'Ford','model' => 'Focus','address' => 'Myer Melbourne, Melbourne, au','image' => 'focus01.png','status' => 'available'],
            ['licenseplate' => 'CAR732','make' => 'Ford','model' => 'Taurus','address' => 'Hearns Hobbies, Melbourne, au','image' => 'taurus01.png','status' => 'available'],
            ['licenseplate' => 'CAR859','make' => 'Ford','model' => 'Ranger','address' => 'Minotaur, Elizabeth Street, Melbourne, au','image' => 'ranger01.png','status' => 'available'],
            ['licenseplate' => 'CAR329','make' => 'Honda','model' => 'Fit','address' => 'State Library Victoria, Melbourne, au','image' => 'fit01.png','status' => 'available'],
            ['licenseplate' => 'CAR482','make' => 'Honda','model' => 'Insight','address' => 'Chin Chin, Melbourne, au','image' => 'insight01.png','status' => 'available'],
            ['licenseplate' => 'CAR190','make' => 'Nissan','model' => 'Altima','address' => 'National Gallery of Victoria, Melbourne, au','image' => 'altima01.png','status' => 'available'],
        ];
        Car::insert($car);

    }
}
