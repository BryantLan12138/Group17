<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class DbTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        $user = new User();
        $user->name = 'abc';
        $user->email = 'abc@me.com';
        $user->password = 'xyz';

        $savedUser = $user->save();

        $this->assertTrue($savedUser);
    }
}
