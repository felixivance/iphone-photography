<?php

namespace Tests\Unit;

use App\Models\Lesson;
use App\Models\User;
use Tests\TestCase;

class AddWatchedLessonTest extends TestCase
{

    public function test_add_watched_lesson(): void
    {
        //get lesson
        $lesson = Lesson::factory()->create();

        $user = User::factory()->create();
        // login user
        $response =  $this->actingAs($user)->postJson('/api/v1/login', [
                'email' => $user->email,
                'password' => 'password'
            ]);

        $response->assertStatus(200);

        $token = $response->json('token');

            $res = $this->withHeaders([
                'Authorization'=> 'Bearer '.$token
                ])->postJson('/api/v1/add-watched-lesson', [
                'lesson_id' => $lesson->id
            ]);

        $res->assertStatus(200);

        // assert user has watched lesson
        $this->assertDatabaseHas('lesson_user', [
            'lesson_id' => $lesson->id,
            'user_id' => $user->id,
            'watched' => true
        ]);
    }
}
