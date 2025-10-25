<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the Portal',
                'content' => 'This is the first announcement for all students.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Exam Schedule Released',
                'content' => 'Check your dashboard for the latest exam schedule.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('announcements')->insertBatch($data);
    }
}
