<img width="1234" height="664" alt="Obscura" src="https://github.com/user-attachments/assets/111ef959-d7ea-4aee-bbca-14dfb3862c8c" />

# Obscura

![laravel](https://img.shields.io/badge/laravel-12.x-FF2D20?style=flat-square&labelColor=2d2d2d)
![php](https://img.shields.io/badge/php-8.2-777BB4?style=flat-square&labelColor=2d2d2d)
![database](https://img.shields.io/badge/database-sqlite-003B57?style=flat-square&labelColor=2d2d2d)
![styling](https://img.shields.io/badge/styling-vanilla_css-1572B6?style=flat-square&labelColor=2d2d2d)
![docker](https://img.shields.io/badge/docker-ready-2496ED?style=flat-square&labelColor=2d2d2d)
![license](https://img.shields.io/badge/license-MIT-yellow?style=flat-square&labelColor=2d2d2d)

A fine-dining reservation system built to explore minimalist design and solid Laravel fundamentals. I created this as a portfolio piece to handle a very specific business case: a restaurant with only one table, one seating per night, and a strict ten-course tasting menu.

The idea was to build a system that feels exclusive. Instead of just booking a slot, users *request* a table, and the admin has to manually review and approve or reject it.

## Stack

- **Laravel 12.x** / PHP 8.2
- **SQLite** — kept it simple for the portfolio, easy to swap out
- **Vanilla CSS** — no Tailwind, no Bootstrap. Wanted full control over the aesthetic: dark theme, glassmorphism, zero border-radius everywhere

## What it does

- **Public site** — landing page explaining the philosophy and showing the tasting menu
- **Reservation flow** — users submit a request and get a tracking code; they can check the status later using that code
- **Admin panel** — custom dashboard to process reservations, which automatically fires styled emails to the user, and to manage tasting menu items
- **Email notifications** — fully customized HTML emails for states like *received*, *confirmed*, *rejected*

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

## License

MIT
