<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     */
    public string $baseURL = 'http://localhost/ITE311-BUHISAN/';

    /**
     * Allowed Hostnames in the Site URL other than the hostname in the baseURL.
     */
    public array $allowedHostnames = [];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     * Leave empty when using .htaccess for clean URLs
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Allowed URL Characters
     * --------------------------------------------------------------------------
     */
    // ⚠️ Removed escaping on dash, hindi kailangan sa CI4 (mas safe plain dash)
    public string $permittedURIChars = 'a-z 0-9~%.:_-';

    /**
     * --------------------------------------------------------------------------
     * Localization
     * --------------------------------------------------------------------------
     */
    public string $defaultLocale = 'en';
    public bool $negotiateLocale = false;
    public array $supportedLocales = ['en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     */
    public string $appTimezone = 'UTC';

    /**
     * --------------------------------------------------------------------------
     * Charset
     * --------------------------------------------------------------------------
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Security
     * --------------------------------------------------------------------------
     */
    public bool $forceGlobalSecureRequests = false;
    public array $proxyIPs = [];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public bool $CSPEnabled = false;
}
