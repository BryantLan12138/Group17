<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordTest extends TestCase
{
    use WithFaker;

    const ROUTE_PASSWORD_EMAIL = 'password.email';
    const ROUTE_PASSWORD_REQUEST = 'password.request';
    const ROUTE_PASSWORD_RESET = 'password.reset';
    const ROUTE_PASSWORD_RESET_SUBMIT = 'password.reset.submit';

    const USER_ORIGINAL_PASSWORD = 'secret';
    /**
     *  Test checking if you get reset page.
     * @test
     */
    public function testResetPage(){
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    /**
     * Test can get send email page.
     *
     * @return void
     */
    public function testSendEmail()
    {
        $response = $this->post('/password/email');

        $response->assertStatus(302);
        $this->assertTrue(true);
    }

    /**
     * Test the correct display of password reset page.
     */
    public function testShowPasswordResetRequestPage()
    {
        $this
            ->get(route(self::ROUTE_PASSWORD_REQUEST))
            ->assertSuccessful()
            ->assertSee('Reset Password')
            ->assertSee('E-Mail Address')
            ->assertSee('Send Password Reset Link');
    }

    /**
     * Test using invalid email format to reset password.
     */
    public function testSubmitPasswordResetRequestInvalidEmail()
    {
        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => str_random(),
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.email', [
                'attribute' => 'email',
            ]));
    }

    /**
     * Test using the unknown email to reset password.
     */
    public function testSubmitPasswordResetRequestEmailNotFound()
    {
        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => $this->faker->unique()->safeEmail,
            ])
            ->assertSuccessful(530)
            ->assertSee(e(__('passwords.user')));
    }


}
