<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchievementUnlockedListener
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
    public function handle(AchievementUnlocked $event): void
    {

        // check the number of achievements unlocked by the user, and if it meets criteria to unlock a badge
        $numberOfAchievements = $event->user->achievements->count();

        $badge = Badge::query()->where('achievements', $numberOfAchievements)->first();


        if($badge){
            UserBadge::query()->create([
                'user_id' => $event->user->id,
                'badge_id' => $badge->id
            ]);
        }
        else{
            // pick the first badge achievements = 0
            $badge = Badge::query()->where('achievements', 0)->first();
            UserBadge::query()->create([
                'user_id' => $event->user->id,
                'badge_id' => $badge->id
            ]);
        }
        event(new BadgeUnlocked($badge->name, $event->user));
    }
}
