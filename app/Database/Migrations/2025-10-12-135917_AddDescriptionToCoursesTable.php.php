<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToCoursesTable extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fields = [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'title'
            ],
        ];


        if (!$db->fieldExists('description', 'courses')) {
            $this->forge->addColumn('courses', $fields);
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();


        if ($db->fieldExists('description', 'courses')) {
            $this->forge->dropColumn('courses', 'description');
        }
    }
}
