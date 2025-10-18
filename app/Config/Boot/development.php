<?php

/*
 |----------------------------------------------------------------------
 | ERROR DISPLAY
 |----------------------------------------------------------------------
 | In development, we want to show all errors so you can debug easily.
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

/*
 |----------------------------------------------------------------------
 | DEBUG BACKTRACES
 |----------------------------------------------------------------------
 | If true, the error screens will display debug backtraces.
 */
defined('SHOW_DEBUG_BACKTRACE') || define('SHOW_DEBUG_BACKTRACE', true);

/*
 |----------------------------------------------------------------------
 | DEBUG MODE
 |----------------------------------------------------------------------
 | Enables CI4's debug features. Set true for development.
 */
defined('CI_DEBUG') || define('CI_DEBUG', true);
