<?php

use App\Order;
use App\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->delete();
        $report = [
            ['order_id' => 1,'user_id' => 1,'car_id' => 1,'firstname' => 'Admin test firstname','lastname' => 'Admin test lastname','mobile' => '0403020100','address' => 'Admin test address','created_at'=>'2020-05-01 14:33:04','updated_at'=>'2020-05-01 14:33:04'],
        ];
        Report::insert($report);

        DB::table('orders')->delete();
        $order = [
            ['user_name' => 'Admin','car_licenseplate' => 'CAR190','duration_hour' => 10,'start_location' => 'State Library Victoria, Melbourne, au','end_location' => 'National Gallery of Victoria, Melbourne, au'],
        ];
        Order::insert($order);
    }
}
