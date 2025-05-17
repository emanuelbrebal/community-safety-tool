<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CommunitySeeder::class,
            GenderSeeder::class,
            SectionTitleSeeder::class,
            HousingProfileQuestionsSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            UrgencySeeder::class,
            IncidentSeeder::class,
        ]);
    }
}
