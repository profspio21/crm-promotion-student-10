<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRegistrantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registrant_create');
    }

    public function rules()
    {
        return [
            'nomor_daftar' => [
                'string',
                'nullable',
            ],
            'nim' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'nullable',
            ],
            'tgl_lahir' => [
                'string',
                'nullable',
            ],
            'prodi' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'nullable',
            ],
            'username' => [
                'nullable',
                'unique:users,username,',
            ],
            'email' => [
                'nullable',
                'unique:users,email,',
            ],
        ];
    }
}