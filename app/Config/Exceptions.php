<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Debug\ExceptionHandler;
use CodeIgniter\Debug\ExceptionHandlerInterface;
use Psr\Log\LogLevel;
use Throwable;

/**
 * Setup how the exception handler works.
 */
class Exceptions extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * LOG EXCEPTIONS?
     * --------------------------------------------------------------------------
     * If true, then exceptions will be logged through Services::Log.
     */
    public bool $log = true;

    /**
     * --------------------------------------------------------------------------
     * DO NOT LOG STATUS CODES
     * --------------------------------------------------------------------------
     * Any status codes here will NOT be logged if logging is turned on.
     * By default, only 404 (Page Not Found) exceptions are ignored.
     *
     * @var list<int>
     */
    public array $ignoreCodes = [404];

    /**
     * --------------------------------------------------------------------------
     * Error Views Path
     * --------------------------------------------------------------------------
     */
    public string $errorViewPath = APPPATH . 'Views/errors';

    /**
     * --------------------------------------------------------------------------
     * HIDE FROM DEBUG TRACE
     * --------------------------------------------------------------------------
     * Any data that you would like to hide from the debug trace.
     *
     * @var list<string>
     */
    public array $sensitiveDataInTrace = [];

    /**
     * --------------------------------------------------------------------------
     * WHETHER TO THROW AN EXCEPTION ON DEPRECATED ERRORS
     * --------------------------------------------------------------------------
     */
    public bool $logDeprecations = true;

    /**
     * --------------------------------------------------------------------------
     * LOG LEVEL THRESHOLD FOR DEPRECATIONS
     * --------------------------------------------------------------------------
     */
    public string $deprecationLogLevel = LogLevel::WARNING;

    /**
     * --------------------------------------------------------------------------
     * DEFINE THE HANDLERS USED
     * --------------------------------------------------------------------------
     * Given the HTTP status code, returns exception handler that
     * should be used to deal with this error.
     */
    public function handler(int $statusCode, Throwable $exception): ExceptionHandlerInterface
    {
        return new ExceptionHandler($this);
    }
}
