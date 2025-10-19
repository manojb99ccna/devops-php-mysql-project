<?php
// app/includes/db.php
// Returns a PDO instance connected to the configured database.

require_once __DIR__ . '/../config/config.php';

/**
 * Get a PDO connection.
 *
 * @return PDO
 * @throws PDOException on failure
 */
function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        // In production you might log this instead of echoing.
        echo "Database connection failed: " . htmlspecialchars($e->getMessage());
        exit;
    }
}

?>