<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Models\Achievement;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserAchievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CommentWrittenListener
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
    public function handle(CommentWritten $event): void
    {
        $comment = $event->comment;
        $userAchievement = null;
        $achievement = null;
       // check if this is the first comment written
        $count = Comment::query()->where('user_id',Auth::id())->count();
        if($count == 1){
            //record new user achievement
            $achievement = Achievement::query()->where('type','comment_written')->where('achievement_index',1)->first();
            $userAchievement = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 3){
            //record new user achievement
            $achievement = Achievement::query()->where('type','comment_written')->where('achievement_index',2)->first();
            $userAchievement = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 5){
            //record new user achievement
            $achievement = Achievement::query()->where('type','comment_written')->where('achievement_index',3)->first();
            $userAchievement  = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 10){
            //record new user achievement
            $achievement = Achievement::query()->where('type','comment_written')->where('achievement_index',4)->first();
            $userAchievement = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }else if($count == 20){
            //record new user achievement
            $achievement = Achievement::query()->where('type','comment_written')->where('achievement_index',5)->first();
            $userAchievement  = UserAchievement::query()->create([
                'user_id' => Auth::id(),
                'achievement_id' => $achievement->id,
            ]);
        }

        if(isset($userAchievement) && isset($achievement)){
            //broadcast new user achievement
            $user = User::query()->where('id',Auth::id())->first();
            event( new AchievementUnlocked($achievement->name,$user));
        }
    }
}
