# attendance-tracker-php

A small PHP + MySQL attendance and staff-details tracker: session-based login, daily attendance logging, a staff details register, a live dashboard, and CSV export.

**Live demo:** _add your hosted URL here once deployed (see Deployment below)_

## Contents

- [Features](#features)
- [Project structure](#project-structure)
- [Local setup](#local-setup)
- [Demo login](#demo-login)
- [Database schema](#database-schema)
- [API / endpoint reference](#api--endpoint-reference)
- [Deploying a live demo (InfinityFree)](#deploying-a-live-demo-infinityfree)
- [Security notes](#security-notes)
- [License](#license)

## Features

- Login/session auth (`index.php`, `home.php`)
- Mark and view daily attendance (`attendance.html`, `add_attendance.php`, `get_attendance.php`)
- Staff details register (`details.html`, `add_details.php`, `get_details.php`, `get_details_by_id.php`)
- Dashboard with present/absent counts (`dashboard.html`, `dashboard.php`)
- CSV export of any table (`records.html`, `download.php`)

All database access goes through a single shared `PDO` connection (`connection.php`) using parameterized queries throughout.

## Project structure

```
.
├── index.html / index.php        # Login page + auth handler, sets the session
├── home.php                      # Post-login shell; loads the other pages into an iframe
├── attendance.html                # Mark/view attendance (calls add_attendance.php, get_attendance.php)
├── details.html                   # Staff details register (calls add_details.php, get_details.php, get_details_by_id.php)
├── dashboard.html / dashboard.php # Present/absent summary widget
├── records.html / download.php   # CSV export of any allow-listed table
├── connection.php                 # Single shared PDO connection, reads db_config.php
├── db_config.example.php          # Template you copy to db_config.php (gitignored)
├── database/
│   └── attendance_manager.sql     # Schema + fabricated sample data (3 tables)
├── .gitignore
├── LICENSE
└── README.md
```

## Local setup

1. Requires PHP 8+ with `pdo_mysql`, and MySQL or MariaDB (e.g. via XAMPP).
2. Create a database and import the schema + sample data:
   ```
   mysql -u root -p < database/attendance_manager.sql
   ```
3. Copy the DB config template and adjust if your credentials differ from the XAMPP defaults:
   ```
   cp db_config.example.php db_config.php
   ```
4. Serve the folder with your PHP server (e.g. place it in XAMPP's `htdocs/`, or `php -S localhost:8000`).
5. Open `index.html` and log in with the demo credentials below.

## Demo login

- Username: `admin`
- Password: `demo123`

This is sample data for local evaluation only — change it before using this anywhere beyond your own machine. Passwords in this project are stored and compared in plaintext by design (kept simple for a demo); don't reuse this pattern for anything handling real user data.

## Database schema

Three tables, created and seeded by `database/attendance_manager.sql`:

**`attendance`**

| Column | Type | Notes |
|---|---|---|
| `id` | `int` | primary key, auto-increment |
| `name` | `varchar(255)` | staff member name |
| `date` | `date` | |
| `time` | `tinytext` | |
| `attendance` | `varchar(255)` | `Present` / `Absent` |

**`details`**

| Column | Type | Notes |
|---|---|---|
| `id` | `int` | primary key, auto-increment |
| `name` | `varchar(255)` | |
| `dob` | `text` | `DD-MM-YYYY` |
| `phone` | `varchar(20)` | |
| `email` | `varchar(255)` | |
| `institution` | `varchar(255)` | |
| `status` | `varchar(20)` | `active` / `inactive` |
| `role` | `varchar(50)` | `admin` / `user` |
| `timestamp` | `timestamp` | defaults to `CURRENT_TIMESTAMP` |

**`users`**

| Column | Type | Notes |
|---|---|---|
| `id` | `int` | primary key, auto-increment |
| `username` | `varchar(50)` | unique |
| `password` | `varchar(255)` | plaintext (see Security notes) |

## API / endpoint reference

| Endpoint | Method | Purpose | Request | Response |
|---|---|---|---|---|
| `index.php` | POST | Log in | form fields `username`, `password` | redirect to `home.php` on success, or `index.html?error=1` |
| `add_attendance.php` | POST | Record one attendance entry | form fields `name`, `date`, `time`, `attendance` | plain-text confirmation or error |
| `get_attendance.php` | GET | List attendance, newest first | — | `{ "attendance": [ { name, date, time, attendance }, ... ] }` |
| `add_details.php` | POST | Add/update a staff details record | form fields `name`, `dob`, `phone`, `email`, `institution`, `status`, `role` | redirect back to the referring page |
| `get_details.php` | GET | List all staff details | — | pre-rendered `<tr>` HTML rows (server-escaped) |
| `get_details_by_id.php` | GET | Look up one staff record | query param `id` | JSON object, or empty string if not found |
| `get_names.php` | GET | Names for the attendance dropdown | — | `{ "names": [ "Alex Carter", ... ] }` |
| `dashboard.php` | GET | Summary counts | — | `{ totalCandidates, present, absent }` |
| `download.php` | POST | Export a table as CSV | form field `table_name` (must be `attendance`, `details`, or `users`) | CSV file download |

All endpoints except `index.php` expect an active PHP session (set on login) and read/write through the shared `$pdo` connection.

## Deploying a live demo (InfinityFree)

1. Create a free account at infinityfree.net and create a new hosting subdomain.
2. In the control panel, create a MySQL database and note the host/database name/username/password it gives you (these are different from your local XAMPP values).
3. Open phpMyAdmin from the control panel and import `database/attendance_manager.sql` into that database.
4. Upload every file in this repo **except** `db_config.example.php`'s local values — instead, create `db_config.php` on the server (via the online file manager or FTP) using the MySQL credentials InfinityFree gave you in step 2.
5. Visit your InfinityFree subdomain and log in with the demo credentials above.

## Security notes

- `index.php` and `download.php` previously built SQL queries via raw string interpolation of POST data (SQL injection). Both now use parameterized queries / a table-name allow-list.
- `get_details.php` now escapes output with `htmlspecialchars()`, and `attendance.html` builds table rows via `textContent` instead of `innerHTML`, closing a stored-XSS gap where staff details or attendance records could have injected HTML/script into the page.
- Database credentials are no longer hardcoded — see `db_config.example.php`.
- Replaced the deprecated `FILTER_SANITIZE_STRING` (removed in PHP 9) and unified all database access from a mix of `mysqli`/PDO onto a single PDO connection.

## License

MIT — see [LICENSE](LICENSE).
