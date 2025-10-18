<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    // Aliases for filters
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,

        // Role-based filters
        'authAdmin'     => \App\Filters\AuthAdmin::class,
        'authTeacher'   => \App\Filters\AuthTeacher::class,
        'authStudent'   => \App\Filters\AuthStudent::class,
    ];

    // Filters that are required globally
    public array $required = [
        'before' => [
            'forcehttps', // Force HTTPS
            'pagecache',  // Cache pages
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    // Global filters for every request
    public array $globals = [
        'before' => [
            'csrf',        // CSRF protection
            'honeypot',    // Bot protection
            'invalidchars' // Invalid character filter
        ],
        'after' => [
            'secureheaders', // Secure headers
        ],
    ];

    // Filters by HTTP methods (optional)
    public array $methods = [];

    // Filters applied to specific URI patterns
    public array $filters = [
        'authAdmin'   => ['before' => ['admin/*']],
        'authTeacher' => ['before' => ['teacher/*']],
        'authStudent' => ['before' => ['student/*']],
    ];
}
