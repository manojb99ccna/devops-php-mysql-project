<?php
// app/config/config.php
// Database configuration for Event Planner app.
// IMPORTANT: Do NOT commit real credentials to public repos. Use environment variables or a local copy.

// Default values - safe for development with XAMPP local MySQL.
// You can override these by setting environment variables or creating a copy named config.local.php

// Load .env from project root if present (do not overwrite existing environment variables)
$envPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        [$k, $v] = array_map('trim', explode('=', $line, 2) + [1 => '']);
        if ($k === '') continue;
        // Remove optional surrounding quotes
        $v = trim($v, "\"'");
        if (getenv($k) === false) {
            putenv("$k=$v");
            $_ENV[$k] = $v;
            $_SERVER[$k] = $v;
        }
    }
}

// Allow local PHP config override
if (file_exists(__DIR__ . '/config.local.php')) {
    // Local override for sensitive data (not committed)
    require_once __DIR__ . '/config.local.php';
}

// Read from environment variables if available, otherwise use defaults suitable for local XAMPP
define('DB_HOST', getenv('DB_HOST') !== false ? getenv('DB_HOST') : '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') !== false ? getenv('DB_PORT') : '3306');
define('DB_NAME', getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'studypro_devops_php_mysql_project_db');
define('DB_USER', getenv('DB_USER') !== false ? getenv('DB_USER') : 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');

// Table prefix (like WordPress). Set DB_TABLE_PREFIX in .env if you want a prefix such as "wp_"
define('DB_TABLE_PREFIX', getenv('DB_TABLE_PREFIX') !== false ? getenv('DB_TABLE_PREFIX') : '');

// Recommended timezone
date_default_timezone_set('UTC');

// App base URL (relative). Adjust if hosting in subfolder.
if (!defined('APP_BASE_URL')) {
    define('APP_BASE_URL', '/StudyPro/devops-php-mysql-project/');
}

?>