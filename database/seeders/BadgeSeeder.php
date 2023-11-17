<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// - Beginner: 0 Achievements
// - Intermediate: 4 Achievements
// - Advanced: 8 Achievements
// - Master: 10 Achievements

        $badges = [
            [
                'name' => 'Beginner',
                'achievements' => 0,
            ],
            [
                'name' => 'Intermediate',
                'achievements' => 4,
            ],
            [
                'name' => 'Advanced',
                'achievements' => 8,
            ],
            [
                'name' => 'Master',
                'achievements' => 10,
            ],
        ];

        foreach ($badges as $badge) {
            \App\Models\Badge::create($badge);
        }
    }
}
