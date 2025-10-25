<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\Forge;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true
            ],
            'course_id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true
            ],
            'enrollment_date' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('enrollments');
    }

    public function down()
    {
        $this->forge->dropForeignKey('enrollments', 'enrollments_user_id_foreign');
        $this->forge->dropForeignKey('enrollments', 'enrollments_course_id_foreign');
        $this->forge->dropTable('enrollments');
    }
}