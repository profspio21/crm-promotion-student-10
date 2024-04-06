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
        $schedule->command('queue:work --stop-when-empty')
                ->everyMinute()
                ->withoutOverlapping();


        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $now = Carbon::now()->format('Y-m-d');
        
            $informations = Information::where('notified', 'belum')->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)->get();
                            
            foreach ($informations as $information) {
                $information->update(['notified' => 'proses']);
            }
        })->everyMinute();
        // })->dailyAt('8:00');
        
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
