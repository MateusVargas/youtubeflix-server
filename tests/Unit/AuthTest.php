<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        $this->withoutExceptionHandling();

        $data = ['email' => 'joao@joao', 'password' => '1234'];

        $response = $this->postJson('auth/login',$data);

        $response->assertStatus(200)->assertJsonStructure([
            'user', 'access_token', 'token_type', 'expires_in'
        ]);
    }

    public function test_login_incorrect_password()
    {
        $this->withoutExceptionHandling();

        $data = ['email' => 'joao@joao', 'password' => '12345'];

        $response = $this->postJson('auth/login',$data);

        $response->assertStatus(404);
    }

    public function test_login_incorrect_email()
    {
        $this->withoutExceptionHandling();

        $data = ['email' => 'joao222@joao', 'password' => '1234'];

        $response = $this->postJson('auth/login',$data);

        $response->assertStatus(404);
    }

    public function test_logout()
    {
        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson("auth/logout?token=" . $token, []);

        $response->assertStatus(200)
        ->assertExactJson(['message' => 'Successfully logged out']);
            //dd($token);
    }

    public function test_refresh()
    {
        $this->withoutExceptionHandling();

        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson("auth/refresh?token=" . $token, []);

        $response->assertStatus(200)->assertJsonStructure([
            'user', 'access_token', 'token_type', 'expires_in'
        ]);
    }

    public function test_me()
    {
        $this->withoutExceptionHandling();

        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->getJson("auth/me?token=" . $token, []);

        $response->assertStatus(200)->assertJsonStructure([
            'id', 'email', 'created_at', 'updated_at'
        ]);
    }
}
