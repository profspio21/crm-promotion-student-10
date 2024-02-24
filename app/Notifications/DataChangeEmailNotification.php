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
            ->line('Ada pengumuman buat kamu, ' . $this->data['target'])
            ->line($this->data['title'])
            ->line($this->data['detail'])
            ->action(config('app.name'), (config('app.url').'/admin/selection-informations?information_id='.$this->data['id']))
            ->line('Terimakasih')
            ->line('PMB Notification UKDW')
            ->salutation(' ');
        }
    }
}