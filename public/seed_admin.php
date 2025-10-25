<?php
require_once '../system/bootstrap.php';

$db = \Config\Database::connect();

$user = $db->table('users')->where('username', 'admin')->get()->getRow();

if (!$user) {
    $db->table('users')->insert([
        'username' => 'admin',
        'email' => 'admin@example.com',
        'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
        'role' => 'admin',
        'created_at' => date('Y-m-d H:i:s')
    ]);
    echo "Admin user inserted.\n";
} else {
    echo "Admin user already exists.\n";
}
?>
