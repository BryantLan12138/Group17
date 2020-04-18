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
        DB::table('users')->delete();
        $user = [
            ['name' => 'admin','email' => 'admin@example.com','password' => '$2y$10$Y0k2MBnBv.5tds9I0dFJfOSReC0pOctvpmHGE2xlxFw2DkN3jjU5q'],
        ];
        User::insert($user);
    }
}
