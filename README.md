# Blumin Mini CRM

A small Laravel CRM application for managing prospects and accounts.

The application allows authenticated users to manage prospects, promote them into accounts, and send email notifications when new accounts are created. It also includes a scheduled daily summary of newly added prospects and accounts.

## Setup

```bash
git clone https://github.com/pmepham/blumin-mini-crm.git
cd blumin-mini-crm

composer install
npm install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate --seed

npm run build
php artisan serve
```

## Login

A test user is created by the database seeder:

```text
Email: test@test.com
Password: password
```

## Environment

The account notification recipient is configured via:

```env
CRM_NOTIFICATION_EMAIL=test@example.com
MAIL_MAILER=log
```

When using the log mailer, emails are written to:

```text
storage/logs/laravel.log
```

## Scheduler

The daily summary email is handled by Laravel's scheduler.

To run the scheduler locally:

```bash
php artisan schedule:work
```

## Design Notes

Prospects and accounts are stored in a single `contacts` table, with a `status` column used to distinguish between them.

I chose this approach because both record types share the same core fields. Account-specific fields, such as account reference and territory code, are populated when a contact becomes an account. This keeps promotion simple, as the existing record can be updated rather than copied into a separate table.

Validation is handled with Form Request classes to keep controller actions focused on application flow rather than request validation.

## Events and Notifications

When a prospect is promoted to an account, the application dispatches an event to handle the promote-prospect email notification.

I chose this approach to keep the promotion logic separate from the notification logic. Promoting a contact should only be responsible for updating the contact into an account, while the event listener handles what should happen afterwards.

This keeps the controller/service method cleaner and makes the notification behaviour easier to extend later. For example, if the application needed to add audit logging, Slack notifications, or additional account onboarding steps, those could be added as separate listeners without changing how promotions work.

