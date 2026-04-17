<img width="1234" height="664" alt="image" src="https://github.com/user-attachments/assets/111ef959-d7ea-4aee-bbca-14dfb3862c8c" />


# Obscura

A fine-dining reservation system built to explore minimalist design and solid Laravel fundamentals. I created this as a portfolio piece to handle a very specific business case: a restaurant with only one table, one seating per night, and a strict ten-course tasting menu. 

The idea was to build a system that feels exclusive. Instead of just booking a slot, users "request" a table, and the admin has to manually review and approve or reject it.

## Stack
- Laravel 12.x / PHP 8.2
- SQLite (kept it simple for the portfolio, easy to swap out)
- Vanilla CSS. No Tailwind, no Bootstrap. I wanted full control over the aesthetic (dark theme, glassmorphism, completely zero border-radius everywhere).

## What it does
- **Public site:** A landing page explaining the philosophy and showing the tasting menu.
- **Reservation flow:** Users submit a request and get a tracking code. They can check the status of their request later using that code.
- **Admin panel:** A custom dashboard to process reservations (which automatically fires beautifully styled emails to the user) and manage the tasting menu items.
- **Email notifications:** fully customized HTML emails for states like "received", "confirmed", "rejected", etc.

## Setup
If you want to spin this up locally:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

The seeder creates a default admin account and some dummy menu items so you don't start with a blank slate.

**Default Admin:**
`admin@obscura.com` / `password`
