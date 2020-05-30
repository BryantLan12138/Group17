<?php

namespace Tests\Unit;

use App\User;
use Auth;
use Tests\TestCase;

class AdminTest extends TestCase
{

    public function testAdminLogin()
    {
        $login = Auth::attempt(['email' => 'admin@carabc.com', 'password' => 'foobar']);

        $this->assertTrue($login);

        return Auth::user();
    }

    /**
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
