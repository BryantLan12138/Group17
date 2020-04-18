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
            ['licenseplate' => 'ABC111','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 1'],
            ['licenseplate' => 'ABC222','make' => 'maketest2','model' => 'modeltest2','carpark' => 'Car Park 2'],
            ['licenseplate' => 'ABC333','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 2'],
            ['licenseplate' => 'ABC444','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 2'],
            ['licenseplate' => 'ABC555','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 3'],
            ['licenseplate' => 'ABC666','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 3'],
            ['licenseplate' => 'ABC777','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 4'],
            ['licenseplate' => 'ABC888','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 5'],
            ['licenseplate' => 'ABC999','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 5'],
            ['licenseplate' => 'ABC000','make' => 'maketest1','model' => 'modeltest1','carpark' => 'Car Park 5'],
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
