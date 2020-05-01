<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin password: admin000
        //tester password: tester000
        DB::table('users')->delete();
        $user = [
            ['name' => 'admin','email' => 'admin@example.com','password' => '$2y$10$Y0k2MBnBv.5tds9I0dFJfOSReC0pOctvpmHGE2xlxFw2DkN3jjU5q','is_admin'=>1],
            ['name' => 'tester','email' => 'tester@example.com','password' => '$2y$10$oRdJOfLb3md.R59TNb/38.PYJ9JRObTVl1ZEIdEopUe07mOF8mPQG','is_admin'=>0],
        ];
        User::insert($user);
    }
}
