Laravel SaaS Church Management System (Ghana Edition)
Overview

This is a multi-tenant Laravel-based SaaS Church Management System tailored for the Ghanaian market. It provides church-specific features, membership management, contributions tracking, event scheduling, and local payment integrations.

Features

Multi-tenant architecture for managing multiple churches

Role-based access control (Admin, Pastor, Member)

Contributions and tithes management

Event and announcements management

Attendance tracking

Local payment integrations (Mobile Money, Paystack, Bank Transfer)

Analytics dashboard

Export features across modules (PDF, CSV, Excel)

Nova Admin Panel for advanced church management

Tech Stack

Laravel

Laravel Nova

Blade + Alpine.js + Tailwind

MySQL

Paystack + Mobile Money integrations

Setup

Clone the repository
git clone https://github.com/sptech-gh/laravel-saas-cms-gh.git

Install dependencies
composer install
npm install && npm run build

Configure environment
cp .env.example .env
php artisan key:generate

Run migrations
php artisan migrate

Seed demo data
php artisan db:seed --class=DemoSeeder

Start local server
php artisan serve

Demo Credentials

Admin: admin@example.com / password
Pastor: pastor@example.com / password
Member: member@example.com / password

Security Note

For production, remove demo credentials and seeders before deployment.

Roadmap

See Roadmap.md for development milestones and planned features.



