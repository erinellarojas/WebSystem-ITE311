<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Logger extends BaseConfig
{
    public $threshold = 0; // disables logging
    public string $dateFormat = 'Y-m-d H:i:s';
    public array $handlers = []; // walang log handlers
}
