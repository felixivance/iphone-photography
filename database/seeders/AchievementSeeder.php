<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // "name","type","achievement_index"
//         - First Lesson Watched
// - 5 Lessons Watched
// - 10 Lessons Watched
// - 25 Lessons Watched
// - 50 Lessons Watched
        Achievement::create([
            "name"=>"First Lesson Watched",
            "type"=>"lesson_watched",
            "achievement_index"=>1,
        ]);
        Achievement::create([
            "name"=>"5 Lessons Watched",
            "type"=>"lesson_watched",
            "achievement_index"=>2,
        ]);
        Achievement::create([
            "name"=>"10 Lessons Watched",
            "type"=>"lesson_watched",
            "achievement_index"=>3,
        ]);
        Achievement::create([
            "name"=>"25 Lessons Watched",
            "type"=>"lesson_watched",
            "achievement_index"=>4,
        ]);
        Achievement::create([
            "name"=>"50 Lessons Watched",
            "type"=>"lesson_watched",
            "achievement_index"=>5,
        ]);
        // - First Comment Written
        // - 3 Comments Written
        // - 5 Comments Written
        // - 10 Comments Written
        // - 20 Comments Written
        Achievement::create([
            "name"=>"First Comment Written",
            "type"=>"comment_written",
            "achievement_index"=>1,
        ]);

        Achievement::create([
            "name"=>"3 Comments Written",
            "type"=>"comment_written",
            "achievement_index"=>2,
        ]);

        Achievement::create([
            "name"=>"5 Comments Written",
            "type"=>"comment_written",
            "achievement_index"=>3,
        ]);

        Achievement::create([
            "name"=>"10 Comments Written",
            "type"=>"comment_written",
            "achievement_index"=>4,
        ]);

        Achievement::create([
            "name"=>"20 Comments Written",
            "type"=>"comment_written",
            "achievement_index"=>5,
        ]);
    }
}
