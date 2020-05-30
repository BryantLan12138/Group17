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

    /*public function testUserLogin()
    {
        $login = Auth::attempt(['email' => 'foo@bar.com', 'password' => 'foobar']);

        $this->assertTrue($login);

        return Auth::user();
    }

    /**
     * @depends testUserLogin
     */
    /*public function testUserLogout(User $loggedUser)
    {
        Auth::login($loggedUser);

        Auth::logout();

        $user = Auth::user();

        $this->assertNull($user);
    }*/
}
