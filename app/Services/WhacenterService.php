<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhacenterService
{

    protected string $to;
    protected array $lines;
    protected string $baseUrl = '';
    protected string $deviceId = '';
    protected string $file;


    /**
     * constructor.
     * @param array $lines
     */
    public function __construct($lines = [])
    {
        $this->lines = $lines;
        $this->baseUrl = 'https://app.whacenter.com/api';
        $this->deviceId = 'cdb7a89966047f396598eeed044676d6';
    }

    public function getDeviceStatus()
    {
        return Http::get($this->baseUrl . '/statusDevice?device_id=' . $this->deviceId);
    }

    public function line($line = ''): self
    {
        $this->lines[] = $line;

        return $this;
    }

    public function to($to): self
    {
        $this->to = $to;

        return $this;
    }

    public function file($file = ''): self
    {
        $this->file = $file;

        return $this;
    }

    public function send(): mixed
    {
        if ($this->to == '' || count($this->lines) <= 0) {
            throw new \Exception('Message not correct.');
        }
        $params = 'device_id=' . $this->deviceId . '&number=' . $this->to . '&message=' . urlencode(implode("\n", $this->lines)) . '&file=' . $this->file;
        $response = Http::get($this->baseUrl . '/send?' . $params);
        return $response->body();
    }
}