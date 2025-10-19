<?php
// index.php - Event Planner App
require_once __DIR__ . '/app/includes/db.php';

// Fetch events sorted by date (ascending)
try {
	$pdo = getPDO();
	$stmt = $pdo->prepare('SELECT id, title, event_date, location, description, created_at FROM ' . table('events') . ' ORDER BY event_date ASC');
	$stmt->execute();
	$events = $stmt->fetchAll();
} catch (Exception $e) {
	$events = [];
	$error = $e->getMessage();
}

// Success messages from redirects
$success = $_GET['success'] ?? null;
$message = null;
if ($success === 'added') {
	$message = 'Event added successfully.';
} elseif ($success === 'deleted') {
	$message = 'Event deleted successfully.';
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>📅 Event Planner</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body { background-color: #f8f9fa; }
		.card { box-shadow: 0 6px 18px rgba(32,33,36,0.06); }
	</style>
</head>
<body>
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<header class="mb-4 text-center">
				<h1 class="h3">📅 Event Planner</h1>
				<p class="text-muted">Plan and manage your events</p>
			</header>

			<?php if (!empty($message)): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?php echo htmlspecialchars($message); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<div class="card mb-4">
				<div class="card-body">
					<h5 class="card-title">Add New Event</h5>
					<form action="add_event.php" method="post">
						<div class="mb-3">
							<label for="title" class="form-label">Title</label>
							<input type="text" class="form-control" id="title" name="title" maxlength="255" required>
						</div>
						<div class="mb-3">
							<label for="event_date" class="form-label">Date</label>
							<input type="date" class="form-control" id="event_date" name="event_date" required>
						</div>
						<div class="mb-3">
							<label for="location" class="form-label">Location</label>
							<input type="text" class="form-control" id="location" name="location" maxlength="255" required>
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Description</label>
							<textarea class="form-control" id="description" name="description" rows="3"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Add Event</button>
					</form>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Upcoming Events</h5>
					<?php if (!empty($error)): ?>
						<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
					<?php endif; ?>

					<?php if (empty($events)): ?>
						<p class="text-muted">No events found. Add your first event above.</p>
					<?php else: ?>
						<div class="table-responsive">
							<table class="table table-striped table-hover align-middle">
								<thead>
								<tr>
									<th>Title</th>
									<th>Date</th>
									<th>Location</th>
									<th>Description</th>
									<th class="text-end">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($events as $ev): ?>
									<tr>
										<td><?php echo htmlspecialchars($ev['title']); ?></td>
										<td><?php echo htmlspecialchars($ev['event_date']); ?></td>
										<td><?php echo htmlspecialchars($ev['location']); ?></td>
										<td><?php echo nl2br(htmlspecialchars($ev['description'])); ?></td>
										<td class="text-end">
											<a href="delete_event.php?id=<?php echo urlencode($ev['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?');">Delete</a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<footer class="mt-4 text-center text-muted small">&copy; <?php echo date('Y'); ?> Event Planner</footer>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
