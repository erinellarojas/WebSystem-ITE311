<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        // Create users table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin','teacher','student'],
                'default' => 'student'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        // Insert default admin user
        $db = \Config\Database::connect();
        $db->table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => password_hash('Admin@123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
