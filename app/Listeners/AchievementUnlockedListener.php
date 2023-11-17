<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
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

        switch($numberOfAchievements){
            case 0:
                $badgeName = 'Beginner';
                break;
            case 4:
                $badgeName = 'Intermediate';
                break;
            case 8:
                $badgeName = 'Advanced';
                break;
            case 10:
                $badgeName = 'Master';
                break;
            default:
                $badgeName = null;
                break;
        }

        if($badgeName){
            event(new BadgeUnlocked($badgeName, $event->user));
        }

    }
}
