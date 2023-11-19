<?php

namespace Tests\Feature;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UserEventTest extends TestCase
{
   public function test_comment_written_event(): void
   {
    //create comment
    $comment = \App\Models\Comment::factory()->create();

    $dispatcher = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');

    // create instance of event listener
    $listener = new \App\Listeners\CommentWrittenListener();

    // Specify that the event listener should receive the event
    $dispatcher->shouldReceive('dispatch')
        ->once()
        ->with(Mockery::type(CommentWritten::class));

    // Dispatch the event
    $dispatcher->dispatch(new CommentWritten($comment));
   }

   public function test_lesson_watched_event(): void
   {
    // lesson
    $lesson = Lesson::factory()->create();

    //user
    $user = User::factory()->create();

    $dispatcher = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');

    // create instance of event listener
    $listener = new \App\Listeners\LessonWatchedListener();

    // Specify that the event listener should receive the event
    $dispatcher->shouldReceive('dispatch')
        ->once()
        ->with(Mockery::type(LessonWatched::class));

    // Dispatch the event
    $dispatcher->dispatch(new LessonWatched($lesson, $user));
   }

   public function test_achievement_unlocked_event(): void
   {
    $achievement_name = 'First Comment Written';
    $user = User::factory()->create();

    $dispatcher = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');

    // create instance of event listener
    $listener = new \App\Listeners\AchievementUnlockedListener();

    // Specify that the event listener should receive the event
    $dispatcher->shouldReceive('dispatch')
        ->once()
        ->with(Mockery::type(AchievementUnlocked::class));

    // Dispatch the event
    $dispatcher->dispatch(new AchievementUnlocked($achievement_name, $user));
   }
}
