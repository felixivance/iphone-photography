<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddCommentTest extends TestCase
{


    public function test_add_comment(): void
    {
        $user = User::factory()->create();
        // login user
       $response =  $this->actingAs($user)->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);


       $response->assertStatus(200);

       $token = $response->json('token');

       //use token to post comment
        $res = $this->withHeaders([
            'Authorization'=> 'Bearer '.$token
            ])->postJson('/api/v1/add-comment', [
            'body' => 'test comment'
        ]);

        $res->assertStatus(200);

        $this->assertDatabaseHas('comments', [
            'body' => 'test comment',
            'user_id' => $user->id,
        ]);

        // $response = $this->actingAs($user)->postJson('/api/v1/add-comment', [
        //     'body' => 'test comment'
        // ]);
        // \Log::info($response->getContent());
        // $response->assertStatus(200);

        // $this->assertDatabaseHas('comments', [
        //     'body' => 'test comment',
        //     'user_id' => $user->id,
        // ]);

    }
}
