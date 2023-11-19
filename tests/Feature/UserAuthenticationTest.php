<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{

    public function test_user_can_register(): void
    {
        $response = $this->postJson('/api/v1/register', [
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'test@email.com',
        ]);
    }

    public function test_user_can_login(): void
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'test@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'user',
            'token'
        ]);
    }

}
