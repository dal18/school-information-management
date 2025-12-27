<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SubjectSeeder::class,
            FacilitySeeder::class,
            ActivitySeeder::class,
            ExtracurricularSeeder::class,
            AnnouncementSeeder::class,
            AdmissionSeeder::class,
            AdmissionStatusHistorySeeder::class,
            StudentTestimonialSeeder::class,
            ContactMessageSeeder::class,
            CulturalSportEventSeeder::class,
            StudentAchievementSeeder::class,
            CommunityInvolvementSeeder::class,
            AdministratorSeeder::class,
            StorySeeder::class,
            FeedbackSeeder::class,
            PostSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
