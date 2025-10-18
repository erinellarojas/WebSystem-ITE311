<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\{
    CSRF,
    DebugToolbar,
    Honeypot,
    InvalidChars,
    SecureHeaders
};

class Filters extends BaseFilters
{
    // --------------------------------------------------------------------
    // Filter Aliases
    // --------------------------------------------------------------------
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,

        // 🔒 Existing role-based filters
        'authAdmin'     => \App\Filters\AuthAdmin::class,
        'authTeacher'   => \App\Filters\AuthTeacher::class,
        'authStudent'   => \App\Filters\AuthStudent::class,

        // ✅ New Role Authorization Filter (for Task 4)
        'roleAuth'      => \App\Filters\RoleAuth::class,
    ];

    // --------------------------------------------------------------------
    // Global Filters (Applied to all routes)
    // --------------------------------------------------------------------
    public array $globals = [
        'before' => [
            'csrf',
            'honeypot',
            'invalidchars',
        ],
        'after' => [
            'secureheaders',
            'toolbar',
        ],
    ];

    // --------------------------------------------------------------------
    // Filters by HTTP Methods (optional)
    // --------------------------------------------------------------------
    public array $methods = [];

    // --------------------------------------------------------------------
    // Route-Specific Filters
    // --------------------------------------------------------------------
    public array $filters = [
        // Protect route groups
        'authAdmin'   => ['before' => ['admin/*']],
        'authTeacher' => ['before' => ['teacher/*']],
        'authStudent' => ['before' => ['student/*']],

        // ✅ Apply RoleAuth to secure access by role
        'roleAuth' => [
            'before' => [
                'admin/*',
                'teacher/*',
                'student/*',
            ],
        ],
    ];
}
