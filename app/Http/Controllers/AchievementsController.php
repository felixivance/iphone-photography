<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use App\Models\UserAchievement;
use App\Models\UserBadge;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {

        $achievements = UserAchievement::query()
                    ->join('achievements','achievements.id','=','user_achievements.achievement_id')
                    ->where('user_id',$user->id)
                    ->select('achievements.name', 'achievements.id')
                    ->get();

        $unlockedAchievements = $achievements->pluck('name');

        $unlockedAchievementsIds = $achievements->pluck('id');

        $nextAchievements = Achievement::query()->whereNotIn('id',$unlockedAchievementsIds)
                ->orderBy('type','asc')
                ->get()
                ->pluck('name');

        $currentBadge = UserBadge::query()
            ->join('badges','badges.id','=','user_badges.badge_id')
            ->where('user_id',$user->id)
            ->select('badges.name as badge_name','badges.id','user_id')
            ->first();

        $nextBadge = Badge::query()
            ->where('id','>', $currentBadge->id)
            ->orderBy('badges.id','asc')
            ->select('name','achievements')
            ->first();


        $remaining_achievements = $nextBadge->achievements - $unlockedAchievements->count();


        return response()->json([
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $nextAchievements,
            'current_badge' => $currentBadge->badge_name,
            'next_badge' => $nextBadge->name,
            'remaining_to_unlock_next_badge' => $remaining_achievements
        ]);
    }

    public function index2($id)
    {
        $user = User::query()->where('id',$id)->first();

        $achievements = UserAchievement::query()
                    ->join('achievements','achievements.id','=','user_achievements.achievement_id')
                    ->where('user_id',$id)
                    ->select('achievements.name', 'achievements.id')
                    ->get();

        $unlockedAchievements = $achievements->pluck('name');

        $unlockedAchievementsIds = $achievements->pluck('id');

        $nextAchievements = Achievement::query()->whereNotIn('id',$unlockedAchievementsIds)
                ->orderBy('type','asc')
                ->get()
                ->pluck('name');

        $currentBadge = UserBadge::query()
            ->join('badges','badges.id','=','user_badges.badge_id')
            ->where('user_id',$id)
            ->select('badges.name as badge_name','badges.id','user_id')
            ->first();

        $nextBadge = Badge::query()
            ->where('id','>', $currentBadge->id)
            ->orderBy('badges.id','asc')
            ->select('name','achievements')
            ->first();


        $remaining_achievements = $nextBadge->achievements - $unlockedAchievements->count();


        return response()->json([
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $nextAchievements,
            'current_badge' => $currentBadge->badge_name,
            'next_badge' => $nextBadge->name,
            'remaining_to_unlock_next_badge' => $remaining_achievements
        ]);
    }
}
