# devops-php-mysql-project

Small learning project to practice DevOps for a PHP + MySQL app with Docker, GitHub Actions, Terraform, Kubernetes, and monitoring.

## Event Planner App

This repository includes a small Event Planner PHP app (Bootstrap + PDO + MySQL) for local development.

Access locally at:

		http://localhost/StudyPro/devops-php-mysql-project/

## Structure (work-in-progress)

- `/app` — PHP app source
- `/infra` — Terraform configs
- `/k8s` — Kubernetes manifests
- `/ci` — GitHub Actions workflows & CI helpers
- `/docs` — notes, runbooks, diagrams

> This repository is public — do NOT commit secrets. Use `app/config/config.local.php` or environment variables for DB credentials.

## Event Planner Setup

1. Ensure XAMPP is running (Apache + MySQL).
2. Create the database and table (example SQL below).
3. Optionally create `app/config/config.local.php` to override DB credentials locally.

### Environment configuration

This project reads configuration from environment variables. For local development an optional `.env` file is provided in the project root. You can either:

- Edit `app/config/config.local.php` (not committed) with your credentials, or
- Set system environment variables (DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS, DB_TABLE_PREFIX), or
- Use the included `.env` file and ensure your PHP/Apache process reads those variables (the project will parse `.env` at runtime).

Example `app/config/config.local.php` (create this file locally; do NOT commit):

```php
<?php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'studypro_devops_php_mysql_project_db');
define('DB_USER', 'root');
define('DB_PASS', '');
// Optional table prefix - set to empty string for no prefix
define('DB_TABLE_PREFIX', '');
?>
```

The project code uses a `table()` helper function so you only pass the base table name in your code. If you set `DB_TABLE_PREFIX=wp_` the call `table('events')` will become `wp_events` in SQL — no per-table constants needed.

### Database schema

Run the following SQL to create the database and table:

```sql
CREATE DATABASE IF NOT EXISTS studypro_devops_php_mysql_project_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE studypro_devops_php_mysql_project_db;

CREATE TABLE IF NOT EXISTS events (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	event_date DATE NOT NULL,
	location VARCHAR(255) NOT NULL,
	description TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Files

- `index.php` - main UI (list + form)
- `add_event.php` - handles creating events
- `delete_event.php` - handles deletion
- `app/includes/db.php` - PDO connection helper
- `app/config/config.php` - configuration (do not commit secrets)

## Developer notes

- `.env` is included for convenience (defaults). Values are loaded into the environment if present.
- The code uses `table('events')` to resolve the real table name with any prefix from `DB_TABLE_PREFIX`.
- All DB queries use prepared statements (PDO) to avoid injection.

### Quick local checks

Run these in PowerShell to quickly lint PHP files locally (requires PHP CLI in PATH):

```powershell
php -l .\app\config\config.php
php -l .\app\includes\db.php
php -l .\index.php
php -l .\add_event.php
php -l .\delete_event.php
```

If a `php` command is not found, add your PHP CLI to PATH or run lint through the XAMPP PHP executable, e.g.:

```powershell
"C:\\xampp\\php\\php.exe" -l .\index.php
```

### Troubleshooting

- If events do not appear, verify DB credentials and that the `events` table exists in the configured database.
- If you change `DB_TABLE_PREFIX`, existing table names must be updated accordingly (or set prefix to empty string).

Enjoy!

## Notes

- Uses prepared statements for all DB queries.
- Redirects after add/delete actions to show success messages.
- For production, add CSRF protection and authentication.

Enjoy!
# devops-php-mysql-project

Small learning project to practice DevOps for a PHP + MySQL app with Docker, GitHub Actions, Terraform, Kubernetes, and monitoring.

## Structure (work-in-progress)

- `/app` — PHP app source
- `/infra` — Terraform configs
- `/k8s` — Kubernetes manifests
- `/ci` — GitHub Actions workflows & CI helpers
- `/docs` — notes, runbooks, diagrams

> This repository is public — no secrets here. Use `.env` and GitHub Secrets for private data.
