# Blumin Mini CRM

A small Laravel CRM for managing prospects and accounts.

Authenticated users can create, update and delete contacts, promote prospects into accounts, and trigger email notifications when new accounts are created. A scheduled task also sends a daily summary of newly added prospects and accounts.

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

```text
Email: test@test.com
Password: password
```

## Environment

```env
CRM_NOTIFICATION_EMAIL=test@example.com
MAIL_MAILER=log
```

When using the log mailer, emails are written to:

```text
storage/logs/laravel.log
```

## Scheduler

To run the daily summary scheduler locally:

```bash
php artisan schedule:work
```

## Design Notes

Prospects and accounts are stored in a single `contacts` table with a `status` column, as both record types share the same core fields. Promotion updates the existing contact record and fills the account-specific fields when required.

Validation is handled with Form Request classes to keep controllers focused on application flow.

Account notification emails are triggered through an event/listener so the promotion logic stays separate from the email-sending logic.

## Future Development

Given more time, I would look to expand the permissions and ownership side of the application.

This would include adding an `is_admin` column to users, and an `added_by_id` column to contacts so the system can track which user created each contact. Admin users would then be able to view all contacts on the contacts index page, including who added them.

I would also add a `promoted_at` datetime field to record when a prospect was promoted into an account.

Another feature I would like to add is contact assignment, allowing contacts to be assigned or moved between different team members.

Finally, I would add policies around the main contact actions to ensure users can only view, create, update, promote or delete records they are authorised to manage.
