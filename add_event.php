<?php
// add_event.php - handle new event submissions
require_once __DIR__ . '/app/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Basic validation and sanitization
$title = trim($_POST['title'] ?? '');
$event_date = trim($_POST['event_date'] ?? '');
$location = trim($_POST['location'] ?? '');
$description = trim($_POST['description'] ?? '');

$errors = [];
if ($title === '') {
    $errors[] = 'Title is required.';
}
if ($event_date === '') {
    $errors[] = 'Date is required.';
} else {
    $d = DateTime::createFromFormat('Y-m-d', $event_date);
    if (!$d || $d->format('Y-m-d') !== $event_date) {
        $errors[] = 'Invalid date format.';
    }
}
if ($location === '') {
    $errors[] = 'Location is required.';
}

if (!empty($errors)) {
    // For simplicity redirect back with first error message (could be improved)
    $msg = urlencode($errors[0]);
    header('Location: index.php?error=' . $msg);
    exit;
}

try {
    $pdo = getPDO();
    $sql = 'INSERT INTO ' . table('events') . ' (title, event_date, location, description) VALUES (:title, :event_date, :location, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':event_date' => $event_date,
        ':location' => $location,
        ':description' => $description,
    ]);

    header('Location: index.php?success=added');
    exit;
} catch (Exception $e) {
    // In production, log error. Here, show a simple message.
    $msg = urlencode('Database error: ' . $e->getMessage());
    header('Location: index.php?error=' . $msg);
    exit;
}

?>