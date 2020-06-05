<?php

namespace Tests\Unit;

use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserRegister()
    {
        $name = 'foo' . time();
        $user = User::create([
            'name' => $name,
            'email' => $name . '@bar.com',
            'password' => Hash::make('foobar'),
        ]);

        $this->assertEquals($name, $user->name);
    }

}
