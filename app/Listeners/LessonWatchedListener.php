<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LessonWatchedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LessonWatched $event): void
    {
       $user = $event->user;

        // check if this is the first lesson watched
        $count = $user->watched->count();
        $userAchievement =null;
        $achievement = null;
        if($count == 1){
            //record new user achievement
            $achievement = Achievement::query()->where('type','lesson_watched')->where('achievement_index',1)->first();
            $userAchievement = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 5){
            //record new user achievement
            $achievement = Achievement::query()->where('type','lesson_watched')->where('achievement_index',2)->first();
            $userAchievement = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 10){
            //record new user achievement
            $achievement = Achievement::query()->where('type','lesson_watched')->where('achievement_index',3)->first();
            $userAchievement  = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 25){
            //record new user achievement
            $achievement = Achievement::query()->where('type','lesson_watched')->where('achievement_index',4)->first();
            $userAchievement = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 50){
            //record new user achievement
            $achievement = Achievement::query()->where('type','lesson_watched')->where('achievement_index',5)->first();
            $userAchievement  = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }

        if($userAchievement){
            event( new AchievementUnlocked($achievement->name,$user));
        }
    }
}
