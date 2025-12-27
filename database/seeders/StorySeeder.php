<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stories = [
            [
                'student_name' => 'Maria Santos',
                'title' => 'From Struggling Student to Honor Roll',
                'content' => "When I first entered high school, I was struggling with my grades and lacked confidence. The teachers at our school never gave up on me. They provided extra tutoring sessions and encouraged me every step of the way. By my senior year, I made it to the honor roll and even received a scholarship for college. This school taught me that with dedication and the right support, anything is possible.",
                'grade_level' => 'Grade 12',
                'image' => null,
                'created_at' => now()->subDays(30),
            ],
            [
                'student_name' => 'Juan Dela Cruz',
                'title' => 'Discovering My Passion for Science',
                'content' => "I never thought I would love science until I joined our school's science club. Our teacher, Ma'am Rodriguez, made every experiment exciting and relatable to real life. She encouraged me to join the Regional Science Fair where I won 2nd place for my project on renewable energy. This experience opened my eyes to the wonders of scientific discovery and inspired me to pursue engineering in college.",
                'grade_level' => 'Grade 11',
                'image' => null,
                'created_at' => now()->subDays(45),
            ],
            [
                'student_name' => 'Anna Reyes',
                'title' => 'Finding My Voice Through Theater',
                'content' => "I used to be extremely shy and afraid to speak in front of people. When our English teacher invited me to join the school's theater group, I was terrified. But the supportive environment and constant encouragement from my peers and teachers helped me overcome my fears. Last semester, I played the lead role in our school play, and it was the most empowering experience of my life. I've learned that our school doesn't just teach academics - it helps us discover who we truly are.",
                'grade_level' => 'Grade 10',
                'image' => null,
                'created_at' => now()->subDays(20),
            ],
            [
                'student_name' => 'Mark Gonzales',
                'title' => 'Sports Taught Me Discipline and Teamwork',
                'content' => "Joining the basketball team was the best decision I made in high school. Coach Martinez taught us that being a good athlete means more than just skills - it's about discipline, teamwork, and perseverance. Through countless practice sessions and games, I learned time management, leadership, and how to handle both victory and defeat with grace. These lessons have helped me not just in sports, but in all aspects of my life.",
                'grade_level' => 'Grade 12',
                'image' => null,
                'created_at' => now()->subDays(15),
            ],
            [
                'student_name' => 'Sofia Mendoza',
                'title' => 'Community Service Changed My Perspective',
                'content' => "Our school's community outreach program took us to teach elementary students in underserved areas. Initially, I joined just for the extra credit, but it became so much more. Seeing the excitement in those children's eyes when they learned something new made me realize the impact one person can have. This experience taught me gratitude, compassion, and the importance of giving back to the community. I'm now planning to become a teacher to continue making a difference.",
                'grade_level' => 'Grade 11',
                'image' => null,
                'created_at' => now()->subDays(10),
            ],
        ];

        foreach ($stories as $story) {
            \App\Models\Story::create($story);
        }
    }
}
