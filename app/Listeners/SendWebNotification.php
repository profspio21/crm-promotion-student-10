<?php

namespace App\Listeners;

use App\Notifications\WebNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendWebNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function __construct()
    {

    }

    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
                $query->whereIn('title', ['Staff', 'Admin']);
            })->get();

        Notification::send($admins, new WebNotification($event->user));
    }
}