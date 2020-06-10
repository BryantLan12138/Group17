<?php

namespace Tests\Unit;

use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * Test user can register an account with name, email and password.
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
