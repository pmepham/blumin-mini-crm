<?php

namespace App\Listeners;

use App\Events\ProspectPromoted;
use App\Notifications\ProspectPromotedNotification;
use Illuminate\Support\Facades\Notification;

class SendProspectPromotedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProspectPromoted $event): void
    {
        Notification::route('mail', config('crm.notification_email'))
        ->notify(new ProspectPromotedNotification($event->contact));
    }
}
