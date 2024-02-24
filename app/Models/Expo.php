<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expo extends Model
{
    use HasFactory;

    public $table = 'expoes';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'tanggal',
        'tempat',
        'pic',
        'created_at',
        'updated_at',
        'type'
    ];

    public const TYPE_SELECT = [
        '0' => 'Pulau Jawa',
        '1' => 'Luar Jawa',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function detailExpo()
    {
        return $this->hasMany(DetailExpo::class);
    }
}
