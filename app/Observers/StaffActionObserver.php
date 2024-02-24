<?php

namespace App\Observers;

use App\Models\Staff;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class StaffActionObserver
{
    // public function created(Staff $model)
    // {
    //     $data  = ['action' => 'created', 'model_name' => 'Staff'];
    //     $users = \App\Models\User::whereHas('roles', function ($q) {
    //         return $q->where('title', 'Admin');
    //     })->get();
    //     Notification::send($users, new DataChangeEmailNotification($data));
    // }

    // public function updated(Staff $model)
    // {
    //     $data  = ['action' => 'updated', 'model_name' => 'Staff'];
    //     $users = \App\Models\User::whereHas('roles', function ($q) {
    //         return $q->where('title', 'Admin');
    //     })->get();
    //     Notification::send($users, new DataChangeEmailNotification($data));
    // }
}