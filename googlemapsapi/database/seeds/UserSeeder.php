<?php

use App\Feedback;
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
            ['id'=>1,'name' => 'admin','email' => 'admin@carabc.com','password' => '$2y$10$Y0k2MBnBv.5tds9I0dFJfOSReC0pOctvpmHGE2xlxFw2DkN3jjU5q','is_admin'=>1],
            ['id'=>2,'name' => 'testuser','email' => 'tester@carabc.com','password' => '$2y$10$oRdJOfLb3md.R59TNb/38.PYJ9JRObTVl1ZEIdEopUe07mOF8mPQG','is_admin'=>0],
            ['id'=>3,'name' => 'carabc','email' => 'carabc@carabc.com','password' => '$2y$10$s4MJFmt9ZbSSJzO1S7QeP.J6uOlxLSABZC3hfg2xHhFLi32Ws46o6','is_admin'=>0],
        ];
        User::insert($user);

        DB::table('feedback')->delete();
        $feedback = [
            ['id'=>1,'name' => 'Natalie Portman','email' => 'natalie@example.com','subject' => 'Good website!','message' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi voluptate hic provident nulla repellat facere esse molestiae ipsa labore porro minima quam quaerat rem, natus repudiandae debitis est sit pariatur.','created_at'=>'2020-04-21 14:17:56'],
            ['id'=>2,'name' => 'Sophie Marceau','email' => 'sophie@example.com','subject' => 'Excellent vehicles.','message' => 'Quasi voluptate hic provident nulla repellat facere esse molestiae ipsa labore porro minima quam quaerat rem, natus repudiandae debitis est sit pariatur.','created_at'=>'2020-04-27 08:43:17'],
        ];
        Feedback::insert($feedback);

    }
}
