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
            ['order_id' => 1,'user_id' => 2,'car_id' => 5,'firstname' => 'Tester','lastname' => 'Tester','mobile' => '0403020100','user_address' => 'Tester address','created_at'=>'21-04-2020 12:19:41','updated_at'=>'21-04-2020 14:33:04'],
            ['order_id' => 2,'user_id' => 2,'car_id' => 7,'firstname' => 'Tester','lastname' => 'Tester','mobile' => '0403020100','user_address' => 'Tester address','created_at'=>'29-04-2020 08:33:04','updated_at'=>'21-04-2020 14:33:04'],
            ['order_id' => 3,'user_id' => 2,'car_id' => 1,'firstname' => 'Tester','lastname' => 'Tester','mobile' => '0403020100','user_address' => 'Tester address','created_at'=>'01-05-2020 14:17:56','updated_at'=>'21-04-2020 14:33:04'],
        ];
        Report::insert($report);

        DB::table('orders')->delete();
        $order = [
            ['id'=>1,'duration_hour' => 5,'charge' => 25.00, 'start_location' => 'State Library Victoria, Melbourne, au','end_location' => 'National Gallery of Victoria, Melbourne, au','created_at'=>'21-04-2020 12:19:41','updated_at'=>'21-04-2020 14:33:04'],
            ['id'=>2,'duration_hour' => 10,'charge' => 50.00, 'start_location' => 'National Gallery of Victoria, Melbourne, au','end_location' => 'State Library Victoria, Melbourne, au','created_at'=>'29-04-2020 08:33:04','updated_at'=>'29-04-2020 14:33:04'],
            ['id'=>3,'duration_hour' => 8,'charge' => 40.00, 'start_location' => 'State Library Victoria, Melbourne, au','end_location' => 'National Gallery of Victoria, Melbourne, au','created_at'=>'01-05-2020 14:17:56','updated_at'=>'01-05-2020 14:33:04'],
        ];
        Order::insert($order);
    }
}
