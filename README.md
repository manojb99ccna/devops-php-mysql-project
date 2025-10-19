# devops-php-mysql-project

Small learning project to practice DevOps for a PHP + MySQL app with Docker, GitHub Actions, Terraform, Kubernetes, and monitoring.

## Event Planner App

This repository contains a small Event Planner web application built with PHP (PDO), MySQL, and Bootstrap 5. It is intended as a learning sandbox for both application development and DevOps workflows such as containerization, CI/CD, and infrastructure automation.

Access locally at:

		http://localhost/StudyPro/devops-php-mysql-project/

## Features

- List events (title, date, location, description)
- Add events via a Bootstrap form
- Delete events with confirmation
- Events auto-sorted by date
- PDO prepared statements for secure DB access
- Table prefix support (like WordPress) via `DB_TABLE_PREFIX`

## Quick setup (local - XAMPP)

1. Ensure XAMPP is running (Apache + MySQL).
2. Create the database and table using the SQL below.
3. Configure DB credentials in one of the following ways:
	 - Create `app/config/config.local.php` (not committed) and set constants, or
	 - Edit `.env` (development convenience) — the app will parse it at runtime, or
	 - Set system environment variables (DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS, DB_TABLE_PREFIX).

Example `app/config/config.local.php` (create locally and do not commit):

```php
<?php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'studypro_devops_php_mysql_project_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_TABLE_PREFIX', ''); // optional prefix, e.g. 'wp_'
?>
```

### Database schema

Run these statements in phpMyAdmin or the MySQL CLI:

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

If you use a `DB_TABLE_PREFIX` (for example `wp_`), create the table name accordingly (e.g. `wp_events`). The app uses a `table('events')` helper so code does not need per-table constants.

## .env

A sample `.env` is included for convenience. It will be parsed at runtime and values set as environment variables if not already present.

Key variables:
- DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS
- DB_TABLE_PREFIX — optional prefix for table names
- APP_BASE_URL — application base path when hosted in a subfolder

Important: do NOT commit real credentials. Add `.env` and `app/config/config.local.php` to `.gitignore` in production.

## Development commands

Run PHP lint locally (requires PHP CLI in PATH):

```powershell
php -l .\app\config\config.php
php -l .\app\includes\db.php
php -l .\index.php
php -l .\add_event.php
php -l .\delete_event.php
```

If `php` is not found, use XAMPP's PHP directly:

```powershell
"C:\\xampp\\php\\php.exe" -l .\index.php
```

## Notes & next steps

- The app is intentionally simple to keep focus on DevOps learning goals. Consider adding:
	- CSRF protection and authentication for production
	- Unit/integration tests and a GitHub Actions workflow
	- Dockerfile and docker-compose for containerized local development

Enjoy experimenting and let me know if you want me to add a `config.local.php.example`, a Dockerfile, or CI workflow next.

