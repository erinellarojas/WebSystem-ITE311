<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateSampleData extends Seeder
{
    public function run()
    {
        // Check if admin user exists, insert if not
        $adminExists = $this->db->table('users')->where('username', 'admin')->countAllResults();
        if ($adminExists == 0) {
            $this->db->table('users')->insert([
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Insert sample teachers if not exist
        $teacher1Exists = $this->db->table('users')->where('username', 'teacher1')->countAllResults();
        if ($teacher1Exists == 0) {
            $this->db->table('users')->insert([
                'username' => 'teacher1',
                'email' => 'teacher1@example.com',
                'password_hash' => password_hash('Teacher@123', PASSWORD_DEFAULT),
                'role' => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $teacher2Exists = $this->db->table('users')->where('username', 'teacher2')->countAllResults();
        if ($teacher2Exists == 0) {
            $this->db->table('users')->insert([
                'username' => 'teacher2',
                'email' => 'teacher2@example.com',
                'password_hash' => password_hash('Teacher@123', PASSWORD_DEFAULT),
                'role' => 'teacher',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Insert sample students if not exist
        $student1Exists = $this->db->table('users')->where('username', 'student1')->countAllResults();
        if ($student1Exists == 0) {
            $this->db->table('users')->insert([
                'username' => 'student1',
                'email' => 'student1@example.com',
                'password_hash' => password_hash('Student@123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $student2Exists = $this->db->table('users')->where('username', 'student2')->countAllResults();
        if ($student2Exists == 0) {
            $this->db->table('users')->insert([
                'username' => 'student2',
                'email' => 'student2@example.com',
                'password_hash' => password_hash('Student@123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Insert sample courses
        $this->db->table('courses')->insertBatch([
            [
                'course_name' => 'Introduction to Programming',
                'description' => 'Learn the basics of programming with PHP',
                'teacher_id' => 2, // teacher1
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'course_name' => 'Web Development Fundamentals',
                'description' => 'Build dynamic websites using HTML, CSS, and JavaScript',
                'teacher_id' => 3, // teacher2
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'course_name' => 'Database Management',
                'description' => 'Master SQL and database design principles',
                'teacher_id' => 2, // teacher1
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        // Insert sample enrollments
        $this->db->table('enrollments')->insertBatch([
            [
                'user_id' => 4, // student1
                'course_id' => 1,
                'enrollment_date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4, // student1
                'course_id' => 2,
                'enrollment_date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 5, // student2
                'course_id' => 1,
                'enrollment_date' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
