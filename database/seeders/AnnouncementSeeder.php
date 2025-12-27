<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user as author
        $admin = \App\Models\User::where('access_rights', 'Admin')->first();

        if (!$admin) {
            $admin = \App\Models\User::create([
                'user_name' => 'admin_school',
                'first_name' => 'School',
                'midle_name' => '',
                'last_name' => 'Administrator',
                'email' => 'admin@school.edu',
                'password' => bcrypt('password'),
                'access_rights' => 'Admin',
            ]);
        }

        $announcements = [
            [
                'title' => 'Second Semester Classes Begin January 8, 2026',
                'content' => "We are pleased to announce that classes for the second semester will commence on Monday, January 8, 2026. All students are expected to be in attendance on the first day of classes.\n\nPlease note the following important reminders:\n\n• Ensure that all enrollment requirements are completed before January 6, 2026\n• Students should be in complete uniform starting the first day\n• Report to your respective classrooms by 7:30 AM\n• Bring all necessary school supplies and materials\n\nFor returning students who have not yet enrolled, the enrollment window closes on January 5, 2026. Please process your enrollment at the Registrar's Office during office hours.\n\nWe look forward to a productive and successful second semester. Let us all work together towards academic excellence!",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(5),
            ],
            [
                'title' => 'Scholarship Application Period Now Open',
                'content' => "The school is now accepting applications for various scholarship programs for the academic year 2025-2026. This is an excellent opportunity for deserving students to receive financial assistance for their education.\n\nAvailable Scholarship Programs:\n\n1. Academic Excellence Scholarship - For students with outstanding academic performance (minimum GPA of 3.5)\n2. Leadership Scholarship - For students demonstrating exceptional leadership qualities\n3. Sports Scholarship - For student-athletes who excel in sports competitions\n4. Financial Assistance Program - For students from low-income families who show academic potential\n\nApplication Requirements:\n• Completed scholarship application form\n• Recent report card or grades\n• Certificate of good moral character\n• Letter of recommendation from a teacher\n• Essay (200-300 words) on why you deserve the scholarship\n\nDeadline for submission: January 15, 2026\nApplication forms are available at the Scholarship Office or can be downloaded from the school website.\n\nFor more information, please contact the Scholarship Office at scholarship@school.edu or visit during office hours.",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(12),
            ],
            [
                'title' => 'Parent-Teacher Conference Scheduled for January 20, 2026',
                'content' => "Dear Parents and Guardians,\n\nYou are cordially invited to attend the Parent-Teacher Conference scheduled for Saturday, January 20, 2026, from 8:00 AM to 4:00 PM.\n\nThis conference is an important opportunity for parents and teachers to discuss student progress, address concerns, and collaborate on strategies to support student learning and development.\n\nSchedule:\n• 8:00 AM - 10:00 AM: Grades 7-9\n• 10:00 AM - 12:00 PM: Grades 10-12\n• 1:00 PM - 4:00 PM: Individual consultations (by appointment)\n\nWhat to Expect:\n• Review of student academic performance\n• Discussion of behavioral observations\n• Feedback on student strengths and areas for improvement\n• Recommendations for supporting learning at home\n\nPre-registration is encouraged to avoid long waiting times. Please contact your child's adviser or visit the school office to schedule your appointment.\n\nYour active participation in your child's education makes a significant difference. We look forward to seeing you at the conference!\n\nSincerely,\nThe Administration",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(18),
            ],
            [
                'title' => 'School Intramurals 2026: Registration Now Open',
                'content' => "Get ready for the most exciting event of the year! The Annual School Intramurals 2026 will be held from February 10-14, 2026.\n\nThis year's theme: \"One School, One Heart, One Champion!\"\n\nParticipating Sports and Events:\n• Basketball (Boys and Girls)\n• Volleyball (Boys and Girls)\n• Badminton (Singles and Doubles)\n• Table Tennis\n• Chess\n• Track and Field Events\n• Swimming\n• E-Sports Competition (NEW!)\n\nAll students from grades 7-12 are encouraged to participate. This is not just about winning—it's about showing school spirit, building teamwork, and promoting a healthy, active lifestyle.\n\nRegistration:\n• Deadline: January 25, 2026\n• Where: PE Office or online through the school portal\n• Team captains, please coordinate with your PE teachers\n\nColor Coding by Grade Level:\n• Grade 7 & 8 - Blue\n• Grade 9 & 10 - Green\n• Grade 11 & 12 - Red\n\nPractice sessions will begin on January 27, 2026. Schedule will be posted on the bulletin board and school website.\n\nLet's make this the best intramurals yet! Show your school spirit and athletic prowess. Register now!",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(25),
            ],
            [
                'title' => 'Important: Updated COVID-19 Health and Safety Protocols',
                'content' => "In compliance with the latest guidelines from the Department of Health and Department of Education, we are implementing updated health and safety protocols effective immediately.\n\nKey Updates:\n\n1. Face Masks:\n   • Optional in well-ventilated outdoor areas\n   • Strongly recommended in indoor settings and crowded spaces\n   • Required in the clinic and for students showing symptoms\n\n2. Daily Health Monitoring:\n   • Students must report any symptoms (fever, cough, colds) to the clinic immediately\n   • Temperature checks at the gate will continue\n\n3. Hygiene Practices:\n   • Regular handwashing and use of hand sanitizers encouraged\n   • Hand sanitizing stations available throughout campus\n\n4. Ventilation:\n   • All classroom windows and doors should remain open for air circulation\n   • Electric fans and air purifiers in use\n\n5. Vaccination:\n   • While not mandatory, COVID-19 vaccination is strongly encouraged\n   • Vaccination certificates should be submitted to the clinic for records\n\n6. If You Feel Sick:\n   • Stay home and inform your teacher/adviser\n   • Consult a doctor and get medical clearance before returning\n   • COVID-19 testing recommended for symptomatic cases\n\nLet us all continue to be responsible and look after each other's health and safety. Together, we can maintain a safe learning environment for everyone.\n\nFor questions or concerns, contact the School Clinic or the Administration Office.",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(30),
            ],
            [
                'title' => 'Career Guidance Seminar: Preparing for Your Future',
                'content' => "Attention Grade 11 and 12 Students!\n\nThe Guidance Office is organizing a Career Guidance Seminar series to help you make informed decisions about your future career paths and college choices.\n\nSeminar Schedule:\n\nWeek 1 (January 15-16, 2026): Discovering Your Strengths and Interests\n• Career assessment activities\n• Identifying your skills and passions\n• Understanding different career paths\n\nWeek 2 (January 22-23, 2026): College and Course Selection\n• Overview of college programs and universities\n• Admission requirements and processes\n• Scholarship and financial aid opportunities\n\nWeek 3 (January 29-30, 2026): Industry Insights\n• Guest speakers from various professions\n• Q&A with industry professionals\n• Tips for career success\n\nWeek 4 (February 5-6, 2026): Practical Skills Workshop\n• Resume writing and interview skills\n• Professional communication\n• Goal setting and action planning\n\nAll sessions will be held in the Auditorium from 2:00 PM to 4:00 PM.\n\nThis seminar is designed to give you valuable insights and practical tools for planning your future. Attendance is highly encouraged.\n\nFor more information, visit the Guidance Office or email guidance@school.edu.\n\nYour future starts with the choices you make today!",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(35),
            ],
            [
                'title' => 'Reminder: School Uniform Policy',
                'content' => "This is a reminder to all students and parents regarding our school uniform policy. Proper wearing of school uniform is required at all times while on campus or during school-related activities.\n\nPrescribed School Uniform:\n\nFor Boys:\n• White collared polo shirt with school logo\n• Black or dark blue pants (not jeans or skinny fit)\n• Black leather shoes\n• Black belt\n• School ID worn visibly\n\nFor Girls:\n• White blouse with school logo\n• Black or dark blue skirt (knee-length)\n• Black leather shoes\n• School ID worn visibly\n\nPE Uniform (for PE classes only):\n• School PE shirt\n• School PE pants/shorts\n• White rubber shoes\n\nImportant Reminders:\n• Uniforms should be clean and properly fitted\n• Colored or patterned shirts are not allowed\n• Rubber shoes, sneakers, or sandals are not allowed except during PE classes\n• Extreme hairstyles and hair colors are not permitted\n• Excessive accessories and jewelry are not allowed\n\nStudents not in proper uniform may not be allowed to enter classes and will be asked to correct their attire. Repeated violations will result in disciplinary action.\n\nSchool uniforms are available for purchase at the school cooperative or authorized uniform suppliers.\n\nThank you for your cooperation in maintaining our school's standards and identity.",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(40),
            ],
            [
                'title' => 'New Online Learning Portal Features Available',
                'content' => "We are excited to announce new features on our school's online learning portal designed to enhance your learning experience and make access to educational resources more convenient.\n\nNew Features Include:\n\n1. Digital Library Access\n   • Browse and download e-books and research materials\n   • Access academic journals and online resources\n   • Search catalog of available materials\n\n2. Assignment Submission Portal\n   • Submit assignments online\n   • Check submission status and feedback\n   • View grades and assessment rubrics\n\n3. Virtual Classroom Integration\n   • Join online classes when needed\n   • Access recorded lectures and presentations\n   • Participate in discussion forums\n\n4. Grade Viewing System\n   • Check your grades in real-time\n   • View detailed breakdown of assessments\n   • Track your academic progress\n\n5. Communication Hub\n   • Message teachers directly\n   • Receive important announcements\n   • Join class group discussions\n\n6. Calendar and Schedule\n   • View your class schedule\n   • Track assignment deadlines\n   • See upcoming school events\n\nHow to Access:\n• Go to portal.school.edu\n• Log in using your student credentials\n• First-time users: Your default password is your student ID number\n• Please change your password after first login\n\nFor technical support or forgotten passwords, contact the IT Department at itsupport@school.edu.\n\nWe encourage all students to explore these new features and integrate them into your study routine. The portal is accessible 24/7 from any device with internet connection.\n\nHappy learning!",
                'posted_by' => $admin->id,
                'created_at' => now()->subDays(50),
            ],
        ];

        foreach ($announcements as $announcement) {
            \App\Models\Announcement::create($announcement);
        }
    }
}
