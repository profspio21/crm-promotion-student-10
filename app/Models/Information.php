<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;

class Information extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'informations';

    protected $appends = [
        'poster', 'start_publish_date_label', 'end_publish_date_label', 'start_publish_date_dmy', 'end_publish_date_dmy'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'type',
        'target',
        'detail',
        'start_publish_date',
        'end_publish_date',
        'media_informasi',
        'created_at',
        'updated_at',
        'notified'
    ];

    public const TYPE_SELECT =
    [
        '0' => 'Seleksi',
        '1' => 'Kegiatan'
    ];

    public const TARGET_SELECT = [
        '0' => 'Pendaftar belum diterima',
        '1' => 'Pendaftar diterima, belum registrasi',
        '2' => 'Pendaftar diterima, sudah registrasi',
    ];

    public const MEDIA_SELECT = [
        '0' => 'Sistem',
        '1' => 'Whatsapp',
        '2' => 'Email',
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('sameheight')->height(200);
    }

    public function getPosterAttribute()
    {
        $file = $this->getMedia('poster')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
            $file->sameheight = $file->getUrl('sameheight');
        }

        return $file;
    }

    public function getStartPublishDateLabelAttribute()
    {
        return $this->attributes['start_publish_date'] ? Carbon::parse($this->attributes['start_publish_date'])->format('d F Y') : null;
    }

    public function getStartPublishDateDmyAttribute()
    {
        return $this->attributes['start_publish_date'] ? Carbon::parse($this->attributes['start_publish_date'])->format('d-m-Y') : null;
    }

    public function getEndPublishDateDmyAttribute()
    {
        return $this->attributes['end_publish_date'] ? Carbon::parse($this->attributes['end_publish_date'])->format('d-m-Y') : null;
    }

    public function setStartPublishDateAttribute($value)
    {
        $this->attributes['start_publish_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndPublishDateLabelAttribute($value)
    {
        return $this->attributes['end_publish_date'] ? Carbon::parse($this->attributes['end_publish_date'])->format('d F Y') : null;
    }

    public function setEndPublishDateAttribute($value)
    {
        $this->attributes['end_publish_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
