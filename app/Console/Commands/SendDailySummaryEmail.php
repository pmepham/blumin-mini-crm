<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Notifications\DailySummaryNotification;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

#[Signature('app:send-daily-summary-email')]
#[Description('Command description')]
class SendDailySummaryEmail extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $contacts = Contact::where('created_at', '>=', now()->subDay())
        ->latest()
        ->get();

        Notification::route('mail', config('crm.notification_email'))
        ->notify(new DailySummaryNotification($contacts));
    }
}
