<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailExpo extends Model
{
    use HasFactory;

    public $table = 'detail_expoes';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'expo_id',
        'name',
        'email',
        'phone',
        'jurusan',
        'prodi',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function expo()
    {
        return $this->belongsTo(Expo::class);
    }
}
