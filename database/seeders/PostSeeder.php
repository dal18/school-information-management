<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user as author
        $admin = \App\Models\User::where('access_rights', 'Admin')->first();

        if (!$admin) {
            // If no admin exists, create one
            $admin = \App\Models\User::create([
                'user_name' => 'admin_school',
                'first_name' => 'School',
                'middle_name' => '',
                'last_name' => 'Administrator',
                'email' => 'admin@school.edu',
                'password' => bcrypt('password'),
                'access_rights' => 'Admin',
            ]);
        }

        $posts = [
            [
                'title' => 'Celebrating Academic Excellence: Honor Roll Students Recognized',
                'content' => "Last Friday, our school held a special ceremony to recognize the outstanding achievements of our honor roll students for the first semester. Over 150 students from grades 7 to 12 were honored for their dedication to academic excellence.\n\nThe ceremony, attended by proud parents, teachers, and fellow students, highlighted not just the high grades achieved, but the hard work, perseverance, and commitment these students demonstrated throughout the semester. Principal Dr. Garcia emphasized that academic success is a result of collaboration between students, teachers, and families.\n\nSpecial recognition was given to the top 10 students from each grade level who maintained a perfect GPA of 4.0. These exceptional students received certificates of achievement and book prizes to encourage their continued pursuit of excellence.\n\nWe congratulate all our honor roll students and encourage all learners to strive for their personal best in the coming semester. Remember, success is not just about grades—it's about growth, learning, and becoming the best version of yourself.",
                'author_id' => $admin->id,
                'created_at' => now()->subDays(7),
            ],
            [
                'title' => 'STEM Program Launches Innovative Robotics Club',
                'content' => "We are excited to announce the launch of our new Robotics Club as part of our enhanced STEM (Science, Technology, Engineering, and Mathematics) program. This initiative aims to provide hands-on learning experiences and foster innovation among our students.\n\nThe Robotics Club will meet twice a week after school, giving students the opportunity to design, build, and program robots. Under the guidance of our STEM teachers and industry mentors, students will work on various projects, from simple automated machines to complex problem-solving robots.\n\nThis program is open to students in grades 9-12 with an interest in technology and engineering. No prior experience is necessary—just curiosity and a willingness to learn. The club will also prepare interested students for regional and national robotics competitions.\n\nWe believe this program will not only enhance technical skills but also develop critical thinking, teamwork, and creativity. Registration for the Robotics Club is now open. Interested students can sign up at the STEM office or contact Ms. Rivera at stem@school.edu.",
                'author_id' => $admin->id,
                'created_at' => now()->subDays(14),
            ],
            [
                'title' => 'School Athletes Bring Home Championship Trophy',
                'content' => "Our school's basketball team has done it again! Last weekend, they competed in the Inter-School Athletic Meet and emerged as champions, bringing home the coveted trophy for the third consecutive year.\n\nThe championship game was intense, with our team facing last year's runners-up. Through excellent teamwork, strategic plays, and unwavering determination, our athletes secured a 78-72 victory. Team captain Marco Rodriguez was named Most Valuable Player of the tournament, averaging 24 points per game.\n\nCoach Martinez praised the team's dedication, noting that their success is the result of months of rigorous training, discipline, and commitment. 'These young athletes have shown that with hard work and teamwork, excellence is achievable,' he stated.\n\nBeyond basketball, our school also won medals in volleyball, track and field, and swimming events. This overall performance placed our school second in the general championship standings among 20 participating schools.\n\nCongratulations to all our student-athletes, coaches, and the entire school community for supporting our sports program. Your hard work and school spirit continue to make us proud!",
                'author_id' => $admin->id,
                'created_at' => now()->subDays(21),
            ],
            [
                'title' => 'Environmental Awareness Week: Students Lead Green Initiatives',
                'content' => "This week, our school community came together to celebrate Environmental Awareness Week, a student-led initiative promoting sustainability and environmental responsibility.\n\nThe week-long celebration featured various activities including tree planting, waste segregation workshops, eco-art exhibitions, and seminars on climate change. Student volunteers from the Environmental Club organized these events, demonstrating remarkable leadership and passion for environmental causes.\n\nA highlight of the week was the 'Green Campus Challenge,' where each grade level competed in reducing waste and implementing eco-friendly practices. Grade 10 students won the challenge by establishing a comprehensive recycling system in their classrooms and creating a vertical garden using recycled materials.\n\nGuest speaker Dr. Maria Lopez, an environmental scientist, delivered an inspiring talk on 'Youth as Climate Champions,' encouraging students to take action in their communities. Her message resonated strongly with our students, many of whom pledged to continue environmental initiatives beyond this week.\n\nWe are proud of our students for taking the lead in environmental stewardship. As a school, we commit to supporting these green initiatives and integrating sustainability into our curriculum and daily operations. Together, we can make a difference for our planet's future.",
                'author_id' => $admin->id,
                'created_at' => now()->subDays(28),
            ],
            [
                'title' => 'Arts Festival Showcases Student Creativity and Talent',
                'content' => "The annual Arts Festival held last week was a spectacular celebration of student creativity, featuring performances, exhibitions, and demonstrations across various artistic disciplines.\n\nThe three-day festival transformed our campus into a vibrant showcase of talent. The visual arts exhibition displayed paintings, sculptures, photography, and digital art created by students throughout the year. Many pieces explored themes of identity, culture, and social issues, demonstrating both artistic skill and thoughtful reflection.\n\nPerforming arts took center stage each evening with musical concerts, dance performances, and theatrical presentations. The drama club's production of a modern Filipino adaptation of a classic play received standing ovations. The school choir, band, and individual musicians also delivered memorable performances that left the audience in awe.\n\nWorkshops on pottery, calligraphy, printmaking, and other art forms allowed students to learn new skills from professional artists. These hands-on sessions were particularly popular, with many students discovering hidden talents and new interests.\n\nThe Arts Festival not only celebrates creativity but also builds confidence, cultural appreciation, and community. We thank all the student artists, performers, teachers, and volunteers who made this event possible. Your passion and dedication to the arts continue to enrich our school community.",
                'author_id' => $admin->id,
                'created_at' => now()->subDays(35),
            ],
            [
                'title' => 'New Library Facilities Now Open for Student Use',
                'content' => "We are delighted to announce the opening of our newly renovated and expanded library facilities, providing students with a modern, conducive environment for learning and research.\n\nThe upgraded library now features over 10,000 books across various subjects, including the latest academic references, fiction, and digital resources. A dedicated computer area with 30 workstations provides students access to online databases, e-books, and educational software.\n\nNew additions include quiet study pods for individual focus, collaborative study rooms for group work, and a comfortable reading lounge with bean bags and soft seating. These spaces are designed to accommodate different learning styles and preferences.\n\nThe library has also implemented a modern digital catalog system, making it easier for students to search for and locate materials. Students can now check out books using their student IDs and even reserve materials online through the school portal.\n\nLibrary hours have been extended, opening from 7:00 AM to 7:00 PM on weekdays and 8:00 AM to 5:00 PM on Saturdays. Our librarians are available to assist with research, provide reading recommendations, and support student learning.\n\nWe encourage all students to explore these new facilities and make the most of the resources available. The library is not just a place for books—it's a hub for learning, discovery, and academic growth.",
                'author_id' => $admin->id,
                'created_at' => now()->subDays(42),
            ],
        ];

        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }
    }
}
