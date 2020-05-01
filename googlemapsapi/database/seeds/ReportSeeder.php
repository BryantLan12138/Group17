<?php

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
            ['user_id' => 1,'car_id' => 1,'firstname' => 'Admin test firstname','lastname' => 'Admin test lastname','mobile' => '0403020100','address' => 'Admin test address'],
        ];
        Report::insert($report);
    }
}
