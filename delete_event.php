<?php
// delete_event.php - delete an event by id
require_once __DIR__ . '/app/includes/db.php';

$id = $_GET['id'] ?? null;
if ($id === null) {
    header('Location: index.php');
    exit;
}

// Ensure numeric id
$id = filter_var($id, FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: index.php');
    exit;
}

try {
    $pdo = getPDO();
    $sql = 'DELETE FROM ' . DB_TABLE_EVENTS . ' WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    header('Location: index.php?success=deleted');
    exit;
} catch (Exception $e) {
    $msg = urlencode('Database error: ' . $e->getMessage());
    header('Location: index.php?error=' . $msg);
    exit;
}

?>