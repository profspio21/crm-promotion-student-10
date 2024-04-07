<?php

namespace App\Observers;

use App\Models\Information;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\WhatsappNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class InformationActionObserver
{
    // public function created(Information $information)
    // {
    //     $target = Information::TARGET_SELECT[$information->target];

    //     $users = User::whereNotNull('email')->whereNot('email', '')->whereHas('roles', function($q) {
    //         return $q->where('title', 'Pendaftar');
    //     })->whereHas('registrant', function($q) use($information) {
    //         return $q->where('status', $information->target);
    //     })->get();
        
    //     $data  = ['id' => $information->id, 'target' => $target, 'model_name' => 'Information', 'title' => $information->title, 'detail' => $information->detail, 'start_publish_date' => $information->start_publish_date ?? ''];
    //     Notification::send($users, new DataChangeEmailNotification($data));
    // }

    public function updated(Information $information)
    {
        if($information->notified === 'proses') {
            $target = Information::TARGET_SELECT[$information->target];

            $users = User::whereHas('roles', function($q) {
                return $q->where('title', 'Pendaftar');
            })->with(['registrant' => function($q) use($information) {
                $q->where('status', $information->target);
            }])->whereHas('registrant', function($q) use($information) {
                return $q->where('status', $information->target);
            })->get();

            $file_url = '';
            if(isset($information->poster)) {
                $file_url = $information->poster->getUrl();
            }
            
            foreach($users as $index => $user) {
                $no_hp[$index] = $user->registrant->phone ?? '';
                Log::info([$user->registrant->name, $no_hp[$index]]);

                $data  = ['id' => $information->id, 'target' => $target, 'model_name' => 'Information',
                            'title' => $information->title, 'detail' => $information->detail,
                            'start_publish_date' => $information->start_publish_date ?? '',
                            'no_hp' => $no_hp[$index], 'file_url' => $file_url];
                
                if(isset($user->email) && $user->email != '' && $information->media_informasi == '1') // MEDIA INFORMASI = EMAIL
                {
                    Notification::send($user, new DataChangeEmailNotification($data));
                }
                if($no_hp[$index] !== '' && $information->media_informasi == '2') // MEDIA INFORMASI = WHATSAPP
                {
                    Notification::send($user, new WhatsappNotification($data));
                }
                
            }

            $information->update(['notified' => 'Sudah Dipublish']);
        }
    }
}