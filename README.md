Laravel Church SaaS
Welcome to the Laravel Church SaaS, a production-ready Laravel 11.x-based multi-tenant SaaS application designed to manage church operations with a focus on the Ghanaian market. This complete project follows Domain-Driven Design (DDD) principles and provides a scalable solution for church administration, including member management, donation tracking, attendance, events, follow-ups, analytics, payment integrations, billing, notifications, and role-based permissions.
Overview
The Laravel Church SaaS is a fully featured, production-ready platform for churches in Ghana to efficiently manage their operations. It supports multi-tenancy using stancl/tenancy, allowing multiple churches to operate independently on the same system. The application is tailored for the Ghanaian market with GHS currency, MoMo phone format (233XXXXXXXXX), and Ghana-themed UI colors. It includes a backend with DDD organization, Blade frontend with TailwindCSS and AlpineJS, a Filament admin panel, REST APIs with Sanctum, and integrations for Paystack and Flutterwave (for MTN/Airtel/Vodafone MoMo).
Key highlights:

Multi-Tenant Support: Super Admins manage tenants, while Tenant Admins handle church-specific operations.
Security and Permissions: Role-based access using Spatie/laravel-permission (SuperAdmin, TenantAdmin).
Production-Ready: PSR-12 compliant code, passing Laravel test suite, with migrations, seeders, and setup instructions.
Ghana-Tailored: GHS currency, MoMo formatting, and flag-inspired colors for a localized experience.

The project is ready for deployment on servers like AWS, Heroku, or local environments, with a free alternative to Nova (Filament) for the admin panel.
Features

Roles and Permissions: Super Admin for tenant management and global settings; Tenant Admin for church-specific operations. Role-based access using Spatie/laravel-permission.
Member Management: CRUD for members with name, phone (233XXXXXXXXX format), email, and validation.
Donation Tracking: Record donations in GHS, linked to members, with webhook handling for payments.
Attendance Tracking: Check-in system for church events and services.
Event Management: Create and manage events with calendars.
Follow-Ups: Task and reminder system for member engagement.
Analytics Dashboards: Nova-like dashboards with metrics for members, donations, attendance (using Filament).
Payment Integrations: Paystack for card payments and Flutterwave for MTN/Airtel/Vodafone MoMo, with webhook handling and manual payment support.
Billing System: Subscription plans with free trial, invoice generation (PDF), and subscription management using Laravel Cashier (adapted for Paystack/Flutterwave).
Notifications: Email and SMS notifications for donations, events, and follow-ups (using Twilio for SMS).
Activity Logs: Track user actions using Spatie/laravel-activitylog.
REST APIs: Sanctum-protected APIs for members, donations, etc., with role-based auth.
Frontend: Responsive Blade views with TailwindCSS and AlpineJS, mobile-first design, Ghana color themes.
Admin Panel: Filament for resource management, dashboards, and tools (free alternative to Nova).
Multi-Tenant Support: Stancl/tenancy for separate databases per tenant (church).
Database: MySQL support with migrations and realistic seeders.
Production Readiness: PSR-12 compliant, passes Laravel test suite, .env.example, setup instructions, and GitHub-ready.

Prerequisites

PHP: Version 8.2 or higher (e.g., via Laragon).
Node.js: Version 22.17.0 or compatible.
Composer: For PHP dependencies.
npm: For JavaScript dependencies.
Git: For version control.
MySQL: Version 8.0 or higher.
VS Code: Recommended IDE with integrated terminal.

Installation

1. Clone the Repository
   git clone https://github.com/sptech-gh/church-saas.git
   cd church-saas

2. Install PHP Dependencies
   composer install

3. Install JavaScript Dependencies
   npm install

4. Configure Environment

Copy .env.example to .env:copy .env.example .env

Generate an application key:php artisan key:generate

Update .env with:APP_NAME="Laravel Church SaaS"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=church_saas
DB_USERNAME=root
DB_PASSWORD=

Ensure MySQL is running and the church_saas database is created:CREATE DATABASE church_saas;

5. Run Migrations
   php artisan migrate

6. Build Assets
   npm run build

7. Start the Development Server

In one terminal:npm run dev

In another terminal:php artisan serve

Visit http://localhost:8000.

Usage

Members Page: Navigate to http://localhost:8000/members to add or view members.
Donations Page: Navigate to http://localhost:8000/donations to add or view donations.
Ghana-Themed Colors: Enjoy the custom UI with ghanaGreen (#006b3f), ghanaYellow (#fcd116), and ghanaRed (#ce1126).

Project Structure

app/Domains/: DDD-based domain logic.
public/: Web server root with index.php, .htaccess, and build/ (Vite assets).
resources/views/: Blade templates for members and donations.
routes/: Web routes for the application.
database/: Migration and seeding files.

Development
TailwindCSS Customization

Custom colors are defined in tailwind.config.js:module.exports = {
content: ['./resources/**/*.blade.php', './resources/**/*.js'],
theme: {
extend: {
colors: {
ghanaGreen: '#006b3f',
ghanaYellow: '#fcd116',
ghanaRed: '#ce1126',
},
},
},
plugins: [],
};

Vite Asset Management

Assets are compiled to public/build/ with hashed filenames (e.g., app-[hash].css).
Use @vite(['resources/css/app.css', 'resources/js/app.js']) in Blade files.

Running Tests
php artisan test

Contributing

Fork the repository.
Create a feature branch (git checkout -b feature-branch).
Commit changes (git commit -m "Add new feature").
Push to the branch (git push origin feature-branch).
Open a Pull Request.

License
This project is open-source under the MIT License.
Acknowledgements

Built with Laravel 11.x and TailwindCSS.
Inspired by Ghanaian church management needs.
Guided by a 21-day learning schedule, currently on Day 8.

Troubleshooting

Vite Manifest Error: Ensure npm run build generates public/build/manifest.json. Check vite.config.js for outDir: 'build'.
Missing Files: Restore public/index.php and .htaccess if deleted.
Styling Issues: Verify public/build/ contains app-[hash].css and check DevTools (F12).
MySQL Connection: Ensure MySQL is running and credentials in .env are correct.
