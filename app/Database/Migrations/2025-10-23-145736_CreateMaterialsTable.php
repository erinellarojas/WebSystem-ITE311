<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaterialsTable extends Migration
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
            'course_id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true
            ],
            'filename' => ['type' => 'VARCHAR', 'constraint' => 255],
            'filepath' => ['type' => 'VARCHAR', 'constraint' => 255],
            'uploaded_by' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true
            ],
            'uploaded_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP']
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('materials');
    }

    public function down()
    {
        $this->forge->dropTable('materials');
    }
}
