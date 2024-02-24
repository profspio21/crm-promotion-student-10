<?php

namespace App\Observers;

use App\Models\Information;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class InformationActionObserver
{
    public function created(Information $information)
    {
        $target = Information::TARGET_SELECT[$information->target];

        $users = User::whereHas('roles', function($q) {
            return $q->where('title', 'Pendaftar');
        })->whereHas('registrant', function($q) use($information) {
            return $q->where('status', $information->target);
        })->get();
        
        $data  = ['id' => $information->id, 'target' => $target, 'model_name' => 'Information', 'title' => $information->title, 'detail' => $information->detail];
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}