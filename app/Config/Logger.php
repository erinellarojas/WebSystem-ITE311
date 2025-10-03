<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Log\Handlers\FileHandler;

class Logger extends BaseConfig
{
    /**
     * ---------------------------------------------------------------
     * Logging Threshold
     * ---------------------------------------------------------------
     * 0 = Disables logging, Error logging TURNED OFF
     * 1 = Emergency
     * 2 = Alert
     * 3 = Critical
     * 4 = Error
     * 5 = Warning
     * 6 = Notice
     * 7 = Info
     * 8 = Debug
     * 9 = All Messages
     */
    public $threshold = (ENVIRONMENT === 'production') ? 4 : 9;

    /**
     * ---------------------------------------------------------------
     * Date Format for Logs
     * ---------------------------------------------------------------
     */
    public string $dateFormat = 'Y-m-d H:i:s';

    /**
     * ---------------------------------------------------------------
     * Handlers for Logs
     * ---------------------------------------------------------------
     */
    public array $handlers = [
        FileHandler::class => [
            'handles' => [
                'critical',
                'alert',
                'emergency',
                'debug',
                'error',
                'info',
                'notice',
                'warning',
            ],
            'fileExtension'    => 'log',
            'filePermissions'  => 0644,
            'path'             => WRITEPATH . 'logs/',
        ],
    ];
}
