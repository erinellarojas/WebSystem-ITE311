public function up()
{
    $fields = [
        'role' => [
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
            'default'    => 'student',
            'after'      => 'email'
        ],
    ];
    $this->forge->addColumn('users', $fields);
}

public function down()
{
    $this->forge->dropColumn('users', 'role');
}
