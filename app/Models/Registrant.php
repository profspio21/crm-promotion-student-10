<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;

class Registrant extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $table = 'registrants';

    protected $appends = [
        'photo', 'status_label', 'creted_at_label', 'list_prodi'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public const STATUS_SELECT = [
        '0' => 'Pendaftar belum diterima',
        '1' => 'Pendaftar diterima, belum registrasi',
        '2' => 'Pendaftar diterima, sudah registrasi',
    ];

    public const STATUS_PERMISSION_SELECT = [
        '0' => 'pendaftar_belum_diterima',
        '1' => 'pendaftar_belum_registrasi',
        '2' => 'pendaftar_sudah_registrasi',
    ];

    public const LIST_PRODI = [
        'Manajemen','Akuntansi','Pendidikan bahasa inggris','Studi humanitas',
        'Biotek','Kedokteran','Sistem informasi','Informatika','Desain produk','Arsitektur','Teologi'
    ];

    protected $fillable = [
        'nomor_daftar',
        'nim',
        'name',
        'phone',
        'tgl_lahir',
        'prodi',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getTglLahirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglLahirAttribute($value)
    {
        $this->attributes['tgl_lahir'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_SELECT[$this->status] ?? 'Status not defined';
    }

    public function getCreatedAtLabelAttribute()
    {
        return $this->attributes['created_at'] ? Carbon::parse($this->attributes['created_at'])->format(config('panel.date_format')) : null;
    }
}