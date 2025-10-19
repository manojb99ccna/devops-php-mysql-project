<?php
// app/config/config.php
// Database configuration for Event Planner app.
// IMPORTANT: Do NOT commit real credentials to public repos. Use environment variables or a local copy.

// Default values - safe for development with XAMPP local MySQL.
// You can override these by setting environment variables or creating a copy named config.local.php

if (file_exists(__DIR__ . '/config.local.php')) {
    // Local override for sensitive data (not committed)
    require_once __DIR__ . '/config.local.php';
} else {
    // Read from environment variables if available, otherwise use defaults suitable for local XAMPP
    define('DB_HOST', getenv('DB_HOST') !== false ? getenv('DB_HOST') : '127.0.0.1');
    define('DB_PORT', getenv('DB_PORT') !== false ? getenv('DB_PORT') : '3306');
    define('DB_NAME', getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'studypro_devops_php_mysql_project_db');
    define('DB_USER', getenv('DB_USER') !== false ? getenv('DB_USER') : 'root');
    define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
}

// Optional: table name
if (!defined('DB_TABLE_EVENTS')) {
    define('DB_TABLE_EVENTS', 'events');
}

// Recommended timezone
date_default_timezone_set('UTC');

// App base URL (relative). Adjust if hosting in subfolder.
if (!defined('APP_BASE_URL')) {
    define('APP_BASE_URL', '/StudyPro/devops-php-mysql-project/');
}

?>