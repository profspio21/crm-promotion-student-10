<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $table = 'staffs';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'nip',
        'name',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        self::observe(new \App\Observers\StaffActionObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}