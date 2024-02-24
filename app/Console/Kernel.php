<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Information;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $now = Carbon::now();
            $startPublishDate = $now->copy()->startOfDay()->addHours(8); // Set to 8 a.m. today
        
            $informations = Information::where('start_publish_date', $now)->get();
        
            foreach ($informations as $information) {
                $target = Information::TARGET_SELECT[$information->target] ?? '';
        
                $users = User::whereHas('roles', function($q) {
                    return $q->where('title', 'Pendaftar');
                })->whereHas('registrant', function($q) use ($information) {
                    return $q->where('status', $information->target);
                })->get();
        
                $data = [
                    'id' => $information->id,
                    'target' => $target,
                    'model_name' => 'Information',
                    'title' => $information->title,
                    'detail' => $information->detail
                ];
        
                Notification::send($users, new DataChangeEmailNotification($data));
            }
        })->hourly();
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
