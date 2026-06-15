# Maison Doree Fragrance E-Shop

Maison Doree is a small PHP 8 fragrance storefront converted from a mostly static HTML/CSS/JavaScript website into a school PHP project. The original visual design is preserved, while products, collections, hero slides, testimonials, appointment requests, and admin product management now use PHP and MySQL/MariaDB.

## Requirements

- PHP 8.0 or higher
- MySQL 8.0+ or MariaDB 10.5+
- XAMPP recommended on Windows
- No PHP framework
- No CMS
- No Composer or npm required

## Project Structure

- `app/Core` - autoloader, PDO database connection, session authentication helpers, base controller
- `app/Controllers` - request logic for login, product and testimonial CRUD, and appointment form submissions
- `app/Models` - OOP model classes that work with database tables
- `app/Views/admin` - reusable admin view files
- `admin` - protected administration pages
- `config/database.php` - database connection settings
- `database/setup.sql` - the single source of truth for schema and seed data
- `partials` - shared header, footer, and mobile navigation
- `styles/style.css` - original site styling plus admin styles
- `defense-docs` - independent documentation page for oral defense preparation

## Database Setup

1. Open phpMyAdmin from XAMPP.
2. Import `database/setup.sql`.
3. Check `config/database.php` and update credentials if needed.

Run only `database/setup.sql`. Do not run separate migrations or update
scripts. All future database structure and seed changes belong in this file.
The script uses `CREATE TABLE IF NOT EXISTS` and duplicate-safe seed inserts,
so it can be rerun without creating duplicate default records.

Default XAMPP settings are already configured:

```php
host: 127.0.0.1
database: maison_doree_shop
username: root
password:
```

## Admin Login

Open:

```text
http://localhost/Fragrance-Perfumes-E-Shop/admin/login.php
```

Credentials:

```text
Email: admin@maisondoree.test
Password: admin123
```

The password in the database is stored with `password_hash`, and login checks it with `password_verify`.

## Test Customer Accounts

The setup script seeds `user1@example.com` through `user5@example.com`.
All five customer accounts use:

```text
Password: Password123!
```

## Run Locally

With XAMPP:

```text
http://localhost/Fragrance-Perfumes-E-Shop/
```

If PHP is available in a terminal, you can also run from the project root:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000
```

## CRUD Entities

Products:

- Create: `admin/create.php`
- Read: `admin/index.php` and `shop.php`
- Update: `admin/edit.php`
- Delete: `admin/delete.php`

Database access uses PDO prepared statements in `app/Models/Product.php`.

Testimonials:

- Create: `admin/testimonial-create.php`
- Read and reorder: `admin/testimonials.php`
- Update: `admin/testimonial-edit.php`
- Delete: `admin/testimonial-delete.php`

The default perfume products, collections, testimonials, administrator, and
five regular test users are all seeded by `database/setup.sql`.

## Security Notes

- PDO is used for database access.
- Prepared statements are used for inserts, updates, deletes, and filtered selects.
- Admin authentication uses PHP sessions.
- Passwords are hashed with `password_hash`.
- Login uses `password_verify`.
- Output is escaped with `htmlspecialchars` through the `e()` helper.
- Forms use basic required field validation.

## Checks

PHP syntax check command:

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { C:\xampp\php\php.exe -l $_.FullName }
```

The project was linted with XAMPP PHP and no syntax errors were reported.
