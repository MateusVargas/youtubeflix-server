<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Models\Categoria;
use Tymon\JWTAuth\Facades\JWTAuth;

class VideoCreateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_video()
    {
        $this->withoutExceptionHandling();
        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $cat = Categoria::where('user_id', $user->id)->first();

        $data = ['categoria' => $cat->id,'titulo' => 'gols brasileirão', 'url' => 'www.google.com'];

        $response = $this->json('POST',"videos?token=" . $token, $data);

        $response->assertStatus(201);
    }
}
