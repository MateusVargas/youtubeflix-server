<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoriaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_categoria()
    {
        $this->withoutExceptionHandling();

        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $data = ['nome' => 'filmes','cor' => 'blue'];

        $response = $this->json('POST',"categorias?token=" . $token, $data);

        $response->assertStatus(201);
    }

    public function test_index_categoria()
    {
        $this->withoutExceptionHandling();

        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->json('GET',"categorias?token=" . $token, []);

        $response->assertStatus(200);
        /*->assertJsonStructure([
            'id', 'titulo', 'cor', 'user_id', 'created_at', 'updated_at'
        ]);*/
    }

    public function test_show_categoria()
    {
        $this->withoutExceptionHandling();

        $user = User::where('email', 'joao@joao')->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->json('GET',"categorias/videos?token=" . $token, []);

        $response->assertStatus(200);
        /*->assertJsonStructure([
            'id', 'titulo', 'cor', 'user_id', 'created_at', 'updated_at'
        ]);*/
    }
}
