<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get subjects
        $subjects = \App\Models\Subject::all();

        if ($subjects->isEmpty()) {
            echo "No subjects found. Please run SubjectSeeder first.\n";
            return;
        }

        // Get or create teacher users
        $teacher1 = \App\Models\User::where('access_rights', 'Teacher')->first();

        if (!$teacher1) {
            // Create sample teachers
            $teacher1 = \App\Models\User::create([
                'user_name' => 'maria.santos',
                'first_name' => 'Maria',
                'middle_name' => '',
                'last_name' => 'Santos',
                'email' => 'maria.santos@school.edu',
                'password' => bcrypt('password'),
                'access_rights' => 'Teacher',
            ]);

            $teacher2 = \App\Models\User::create([
                'user_name' => 'juan.reyes',
                'first_name' => 'Juan',
                'middle_name' => '',
                'last_name' => 'Reyes',
                'email' => 'juan.reyes@school.edu',
                'password' => bcrypt('password'),
                'access_rights' => 'Teacher',
            ]);

            $teacher3 = \App\Models\User::create([
                'user_name' => 'ana.cruz',
                'first_name' => 'Ana',
                'middle_name' => '',
                'last_name' => 'Cruz',
                'email' => 'ana.cruz@school.edu',
                'password' => bcrypt('password'),
                'access_rights' => 'Teacher',
            ]);
        }

        // Get all teachers
        $teachers = \App\Models\User::where('access_rights', 'Teacher')->get();

        if ($teachers->isEmpty()) {
            echo "No teachers found. Creating default teacher.\n";
            $teachers = collect([
                \App\Models\User::create([
                    'user_name' => 'default.teacher',
                    'first_name' => 'Default',
                    'middle_name' => '',
                    'last_name' => 'Teacher',
                    'email' => 'teacher@school.edu',
                    'password' => bcrypt('password'),
                    'access_rights' => 'Teacher',
                ])
            ]);
        }

        // Create schedules for different grade levels
        $gradeLevels = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];
        $sections = ['A', 'B', 'C'];
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $rooms = ['Room 101', 'Room 102', 'Room 103', 'Room 201', 'Room 202', 'Room 203', 'Science Lab 1', 'Science Lab 2', 'Computer Lab'];

        $schedules = [];
        $scheduleCount = 0;

        foreach ($gradeLevels as $grade) {
            foreach ($sections as $section) {
                $timeSlots = [
                    ['07:30:00', '08:30:00'],
                    ['08:30:00', '09:30:00'],
                    ['09:30:00', '10:30:00'],
                    ['10:45:00', '11:45:00'],
                    ['13:00:00', '14:00:00'],
                    ['14:00:00', '15:00:00'],
                    ['15:00:00', '16:00:00'],
                ];

                $usedSubjects = [];

                foreach ($daysOfWeek as $dayIndex => $day) {
                    $slotIndex = 0;

                    foreach ($timeSlots as $timeSlot) {
                        if ($scheduleCount >= 50) break 3; // Limit total schedules to 50

                        $availableSubjects = $subjects->reject(function($subject) use ($usedSubjects, $day) {
                            return isset($usedSubjects[$day]) && in_array($subject->id, $usedSubjects[$day]);
                        });

                        if ($availableSubjects->isEmpty()) {
                            $subject = $subjects->random();
                        } else {
                            $subject = $availableSubjects->random();
                        }

                        $teacher = $teachers->random();
                        $room = $rooms[array_rand($rooms)];

                        $schedules[] = [
                            'subject_id' => $subject->id,
                            'teacher_id' => $teacher->id,
                            'grade_level' => $grade,
                            'section' => $section,
                            'day_of_week' => $day,
                            'start_time' => $timeSlot[0],
                            'end_time' => $timeSlot[1],
                            'room' => $room,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];

                        if (!isset($usedSubjects[$day])) {
                            $usedSubjects[$day] = [];
                        }
                        $usedSubjects[$day][] = $subject->id;

                        $scheduleCount++;
                        $slotIndex++;

                        if ($slotIndex >= 4) break; // Limit to 4 subjects per day per section
                    }
                }
            }
        }

        foreach ($schedules as $schedule) {
            \App\Models\Schedule::create($schedule);
        }
    }
}
