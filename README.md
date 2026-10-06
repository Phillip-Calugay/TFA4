# Simple POS System

A CodeIgniter 4 point-of-sale account demo backed by MySQL. Customer and user records can be created, edited, validated, and displayed in responsive account tables. Staff authentication protects all account-management routes, and user profiles support prepared JPG/PNG avatar thumbnails.

## Pages

- `/` - landing page
- `/about` - project information
- `/login` - staff login
- `/logout` - destroy the current session
- `/customers` - database-backed customer records
- `/users` - database-backed user accounts
- `/customers/new` and `/customers/edit/{id}` - validated customer create/edit forms
- `/users/new` and `/users/edit/{id}` - validated user create/edit forms with avatar upload on edit

## Setup

1. Start Apache and MySQL in XAMPP, then run `composer install` if dependencies are not already installed.
2. The local database connection in `.env` uses the default XAMPP MySQL account (`root` with an empty password). Change it if your account differs.
3. Create and populate the database using either option:
   - Import [database/simple_pos.sql](database/simple_pos.sql) in phpMyAdmin; or
   - Run `php spark migrate` followed by `php spark db:seed PosAccountsSeeder`.
4. If upgrading an existing database, run `php spark migrate` to add the `users.password` column. Existing migrated users receive the demo hash used by the seed data; change their password from the User Accounts edit form after logging in.
5. Run `php spark serve`, then open `http://localhost:8080/login`.

The seeded accounts all use the demo password `password` (for example, `admin` / `password`). Passwords are stored with `password_hash()` and checked with `password_verify()`; never use the demo password in a production deployment.

For hosted deployments, set `app.baseURL` in the server `.env` to the complete URL, including the scheme, for example `app.baseURL = 'https://phillip-calugay-tfa4.freedev.app/'`. The application also normalizes a host-only value to HTTPS to prevent CodeIgniter's invalid URL configuration error.

Uploaded avatars are validated as JPG/PNG files no larger than 2 MB, resized to a 300 × 300 display-ready thumbnail, and saved under `public/uploads`. Only the generated filename is stored in the database.

The repository includes both the SQL database export and CodeIgniter migration/seeder files for reproducible setup.
