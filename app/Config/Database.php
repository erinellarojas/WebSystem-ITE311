<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'         => '',
        'hostname'    => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'database'    => 'lms_buhisan',
        'DBDriver'    => 'MySQLi',
        'DBPrefix'    => '',
        'pConnect'    => false,
        'DBDebug'     => (ENVIRONMENT !== 'production'),
        'charset'     => 'utf8mb4',
        'DBCollat'    => 'utf8mb4_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
    ];

    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => 'root',
        'password'    => '',
        'database'    => 'lms_buhisan_test',
        'DBDriver'    => 'MySQLi',
        'DBPrefix'    => '',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8mb4',
        'DBCollat'    => 'utf8mb4_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Optional: Override database settings using .env (if available)
        $this->default['hostname'] = $_ENV['database.default.hostname'] ?? $this->default['hostname'];
        $this->default['username'] = $_ENV['database.default.username'] ?? $this->default['username'];
        $this->default['password'] = $_ENV['database.default.password'] ?? $this->default['password'];
        $this->default['database'] = $_ENV['database.default.database'] ?? $this->default['database'];
        $this->default['DBDriver'] = $_ENV['database.default.DBDriver'] ?? $this->default['DBDriver'];
        $this->default['port']     = (int)($_ENV['database.default.port'] ?? $this->default['port']);

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
