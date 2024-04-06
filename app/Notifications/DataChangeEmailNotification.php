<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DataChangeEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        if($this->data['model_name'] === 'Information') {
            return (new MailMessage)
            ->subject('PMB Notification UKDW')
            ->greeting('Hello, ')
            ->line('Ada pengumuman buat kamu, ')
            ->line($this->data['title'])
            // ->line(html_entity_decode(strip_tags($this->data['detail'] ?? '')))
            ->line('Klik tombol dibawah ini untuk melihat detail informasi')
            ->action(config('app.name'), (config('app.url').'/admin/selection-informations/'.$this->data['id']))
            ->line('Terimakasih')
            ->line('PMB Notification UKDW')
            ->salutation(' ');
        }
    }
}