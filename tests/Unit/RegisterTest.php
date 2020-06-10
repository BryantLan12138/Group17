<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use WithFaker;
    /**
     * Test can get to register page.
     * @test
     */
    public function testRegisterPage(){
        $response = $this->get("/register");
        $response->assertStatus(200);
    }

    /**
     * Test a registered account can log in.
     *
     * @return void
     */
    public function testLoginRegisteredUser()
    {
        //faker new user
        $importantTask = factory(User::class)->create();
//        get recorded data
        $task = User::orderBy('id','DESC')->first();

        //login the registered user
        $this->actingAs($importantTask)->withSession(['foo' => 'bar'])->get('/home');

//        test if both id are matching
        $this->assertEquals($importantTask->id, $task->id);
    }
    

    /**
     * Test register a new user and authenticate it.
     */
    public function testRegisterCreatesAndAuthenticatesAUser()
{
    $name = $this->faker->name;
    $email = $this->faker->safeEmail;
    $password = $this->faker->password(8);

    $response = $this->post('register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ]);

    $response->assertRedirect(route('home'));

    $user = User::where('email', $email)->where('name', $name)->first();
    $this->assertNotNull($user);

    $this->assertAuthenticatedAs($user);
}

}
