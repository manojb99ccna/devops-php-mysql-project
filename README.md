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
