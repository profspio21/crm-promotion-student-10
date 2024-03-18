<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $table = 'comments';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'information_id',
        'sender_id',
        'content',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function information()
    {
        return $this->belongsTo(Information::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id')->with('roles');
    }

    public function sender()
    {
        // if($this->user()->hasRole('admin')) {
        //     return $this->user->username;
        // }

        // if($this->user()->hasRole('staff')) {
        //     return $this->user->staff->name;
        // }

        // if($this->user()->hasRole('pendaftar')) {
        //     return $this->user->pendaftar->name;
        // }

        return null;
    }
}
