<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToEnrollmentsTable extends Migration
{
    public function up()
    {
        $fields = [
            'enrollment_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'course_id'
            ],
        ];
        $this->forge->addColumn('enrollments', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('enrollments', 'enrollment_date');
    }
}
