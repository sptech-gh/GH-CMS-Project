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



//extra member registration details
1. Ghana card/Passport/
2. Residence
3. Emergency contact and name
4. Occupation
5. Level of education
6. Marital status
7. Spouse
8. Children names of each and age
9. Member ID
10. Picture

//region and description data not storing when creating churches

//github

git add .
git commit -m "Your descriptive commit message"
git pull origin main

git push origin main

//
Pushing a file to GitHub: If you want to push a specific file:

Terminal
git add filename
git commit -m "Add filename"
git push origin main


Pushing a new branch:

Terminal
git checkout -b branch-name
git push -u origin branch-name

//Common scenarios and additional commands
Pushing a local repo to GitHub for the first time:

Terminal
git remote add origin https://github.com/username/repository.git
git push -u origin main


// New branch
How to push a local branch to GitHub
To push a new or existing local branch to GitHub, follow these steps:

Create a new branch (if necessary):
Terminal
git checkout -b new-branch


Make your changes and commit them:
Terminal
git add .
git commit -m "Commit message"


Push the branch:
Terminal
git push origin new-branch








//SettingsController, migration/model (for configs), and the blade views so the link is functional right away?


add export button to donation.index.blade.php

//add inline validation error messages under each input (like @error('amount')...) so users see why submission fails

//add a global dashboard view (for super-admins to see all churches + global totals), while keeping this per-church dashboard for pastors/admins?


//
Recommendations (Based on Scope & Current State)
1. Fix Dashboard Stats (Immediate Priority)

Create a DashboardService class to fetch all stats in one place.

Use dependency injection instead of cluttering the controller.

Always scope queries to auth()->user()->church_id (or tenant id).

Provide default values (0) if no records exist, to avoid undefined variable errors.

2. Strengthen Multi-Tenant Foundation

If you haven’t already, decide: subdomain-based tenancy (church1.yourapp.com) or single domain + scoped by user’s church_id.

Standardize queries via a ChurchScope (GlobalScope) so that every model respects tenancy automatically.

3. Donation & Payment Flow

Build a DonationsService that:

Logs all payment attempts (pending).

Marks them as successful only after Paystack/Mobile Money webhook confirms.

Ensures dashboard reflects reconciled transactions only.

4. Event Management

Clean up event queries (remove null AND not null).

Add event repository to return upcoming, past, and ongoing events cleanly.

5. Roadmap Fit

Your scope (multi-tenant SaaS with churches, members, events, donations, analytics) is ambitious but on track.

You’re in the stats/dashboard integration phase, which is a natural point before final rollout.

Next step after dashboard stability = Payments + Analytics polish → Deployment readiness.

My Recommendation (Action Order)

✅ Refactor DashboardController → Use DashboardService → Ensure all variables are defined and defaulted.

✅ Fix global tenant scoping (church_id) to avoid incorrect queries.

✅ Finalize donations/payment integration with safe reconciliation flow.

🚀 Deploy to a staging server (e.g. Forge or Laravel Vapor) and test with dummy churches.

//add a pie chart for donation status breakdown (successful, pending, failed) so admins instantly see proportions
