<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'       => '',
        'hostname'  => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'database'  => 'lms_buhisan',
        'DBDriver'  => 'MySQLi',
        'DBPrefix'  => '',
        'pConnect'  => false,
        'DBDebug'   => true,
        'charset'   => 'utf8mb4',
        'DBCollat'  => 'utf8mb4_general_ci',
        'swapPre'   => '',
        'encrypt'   => false,
        'compress'  => false,
        'strictOn'  => false,
        'failover'  => [],
        'port'      => 3306,
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

        // Override default database from .env
        $this->default['hostname'] = $_ENV['database.default.hostname'] ?? $this->default['hostname'];
        $this->default['username'] = $_ENV['database.default.username'] ?? $this->default['username'];
        $this->default['password'] = $_ENV['database.default.password'] ?? $this->default['password'];
        $this->default['database'] = $_ENV['database.default.database'] ?? $this->default['database'];
        $this->default['DBDriver'] = $_ENV['database.default.DBDriver'] ?? $this->default['DBDriver'];
        $this->default['DBPrefix'] = $_ENV['database.default.DBPrefix'] ?? $this->default['DBPrefix'];
        $this->default['port'] = (int)($_ENV['database.default.port'] ?? $this->default['port']);
        $this->default['DBDebug'] = $_ENV['database.default.DBDebug'] ?? $this->default['DBDebug'];

        // Override test database from .env
        $this->tests['hostname'] = $_ENV['database.tests.hostname'] ?? $this->tests['hostname'];
        $this->tests['username'] = $_ENV['database.tests.username'] ?? $this->tests['username'];
        $this->tests['password'] = $_ENV['database.tests.password'] ?? $this->tests['password'];
        $this->tests['database'] = $_ENV['database.tests.database'] ?? $this->tests['database'];
        $this->tests['DBDriver'] = $_ENV['database.tests.DBDriver'] ?? $this->tests['DBDriver'];
        $this->tests['DBPrefix'] = $_ENV['database.tests.DBPrefix'] ?? $this->tests['DBPrefix'];
        $this->tests['port'] = (int)($_ENV['database.tests.port'] ?? $this->tests['port']);
        $this->tests['charset'] = $_ENV['database.tests.charset'] ?? $this->tests['charset'];
        $this->tests['DBCollat'] = $_ENV['database.tests.DBCollat'] ?? $this->tests['DBCollat'];

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
