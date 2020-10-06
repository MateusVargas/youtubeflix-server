<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserCreateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_create()
    {
        $this->withoutExceptionHandling();
        $data = ['email' => 'joao@joao','password' => '1234', 'passwordconfirm' => '1234'];
        $this->json('POST','user/create',$data)
        ->assertStatus(201);
    }
}
