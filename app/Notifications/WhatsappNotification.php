<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;

class WhatsappNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return [WhacenterChannel::class];
    }

    public function toWhacenter($notifiable)
    {
        return (new WhacenterService())
            ->to($this->data['no_hp'])
            ->line('Salam hangat dari PMB UKDW')
            ->line('')
            ->line($this->data['title'])
            ->line('Klik tombol dibawah ini untuk melihat detail informasi')
            ->line((config('app.url').'/admin/selection-informations/'.$this->data['id']));

    }
}