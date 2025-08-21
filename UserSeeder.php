<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Erica Buhisan',
                'email'    => 'buhisanerica2gmail.com',
                'role'     => 'student',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
            ],
            [
                'name'     => 'Taehyung Kim',
                'email'    => 'thv@gmail.com',
                'role'     => 'instructor',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
            ],
            [
                'name'     => 'Erin Pogi',
                'email'    => 'erinbuhisan@gmail.com',
                'role'     => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
        ];

        // Insert multiple records at once
        $this->db->table('users')->insertBatch($data);
    }
}
