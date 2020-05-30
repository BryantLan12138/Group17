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
            ['order_id' => 1,'user_id' => 2,'car_id' => 5,'firstname' => 'Tester','lastname' => 'Tester','mobile' => '0403020100','user_address' => 'Tester address','created_at'=>'2020-04-21 12:19:41','updated_at'=>'2020-04-21 14:33:04'],
            ['order_id' => 2,'user_id' => 2,'car_id' => 7,'firstname' => 'Tester','lastname' => 'Tester','mobile' => '0403020100','user_address' => 'Tester address','created_at'=>'2020-04-21 08:33:04','updated_at'=>'2020-04-21 14:33:04'],
            ['order_id' => 3,'user_id' => 2,'car_id' => 1,'firstname' => 'Tester','lastname' => 'Tester','mobile' => '0403020100','user_address' => 'Tester address','created_at'=>'2020-04-21 14:17:56','updated_at'=>'2020-04-21 14:33:04'],
        ];
        Report::insert($report);

        DB::table('orders')->delete();
        $order = [
            ['id'=>1,'hour' => 5,'minute' => 15, 'start_location' => 'State Library Victoria, Melbourne, au','end_location' => 'National Gallery of Victoria, Melbourne, au','created_at'=>'2020-04-21 12:19:41','updated_at'=>'2020-04-21 14:33:04'],
            ['id'=>2,'hour' => 6,'minute' => 17, 'start_location' => 'National Gallery of Victoria, Melbourne, au','end_location' => 'State Library Victoria, Melbourne, au','created_at'=>'2020-04-21 08:33:04','updated_at'=>'2020-04-21 14:33:04'],
            ['id'=>3,'hour' => 7,'minute' => 23, 'start_location' => 'State Library Victoria, Melbourne, au','end_location' => 'National Gallery of Victoria, Melbourne, au','created_at'=>'2020-04-21 14:17:56','updated_at'=>'2020-04-21 14:33:04'],
        ];
        Order::insert($order);
    }
}
