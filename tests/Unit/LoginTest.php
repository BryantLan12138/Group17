<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    use RefreshDatabase;
    //use Authenticatable;
//    private $id;

    /**
     * Test can get log in page.
     * @test
     */
    public function testLoginPage(){
        $response = $this->get("/login");
        $response->assertStatus(200);
    }

    /**
     * Test can create a new user successful.
     *
     * @return void
     */

    public function testCreateUser()
    {
        //create user
        $user = factory(User::class)->make();

        $logedinuser = $this->actingAs($user);
        $logedinuser->withSession(['foo' => 'bar'])
            ->get('/home');

        $this->assertAuthenticatedAs($logedinuser->getAuthIdentifier(), '');
//        $logedinuser->assertStatus(200);
     }

     public function getAuthIdentifier()
    {
        return Auth::user();
    }

    /**
     * Test user will be directed to home page if no authentication.
     */
    public function testUserGetHomeWithoutAuthenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    /**
     * Test user can log in with correct email and password.
     */
    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test user cannot log in with wrong password.
     */
    public function testUserCannotLoginWithIncorrectPassword()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);
        
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);
        
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * Test the functionality of "remember me" token.
     */
    public function testRememberMeFunctionality()
    {
        $user = factory(User::class)->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
        
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);
        
        $response->assertRedirect('/home');
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);

        $value = vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]);
    }

}
