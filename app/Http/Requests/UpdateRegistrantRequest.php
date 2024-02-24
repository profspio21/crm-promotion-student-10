<?php

namespace App\Http\Requests;

use App\Models\Registrant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegistrantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registrant_edit');
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
            'tgl_lahir' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'nullable',
            ],
            'prodi' => [
                'string',
                'nullable',
            ],
            'username' => [
                'nullable',
                'unique:users,username,' . request()->route('registrant')->user_id,
            ],
            'email' => [
                'nullable',
                'unique:users,email,' . request()->route('registrant')->user_id,
            ],
        ];
    }
}