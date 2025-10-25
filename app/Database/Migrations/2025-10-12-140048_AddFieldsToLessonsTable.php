<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToLessonsTable extends Migration
{
    public function up()
    {
        $fields = [
            'video_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'title'
            ],
        ];
        $this->forge->addColumn('lessons', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('lessons', 'video_url');
    }
}
