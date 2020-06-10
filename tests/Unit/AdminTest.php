<?php

namespace Tests\Unit;

use App\User;
use Auth;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * Testing administrator log in.
     */
    public function testAdminLogin()
    {
        $login = Auth::attempt(['email' => 'admin@carabc.com', 'password' => 'foobar']);

        $this->assertTrue($login);

        return Auth::user();
    }

    /**
     * Testing administrator log out.
     * @depends testAdminLogin
     */
    public function testAdminLogout(User $loggedUser)
    {
        Auth::login($loggedUser);

        Auth::logout();

        $user = Auth::user();

        $this->assertNull($user);
    }
}
