<?php

namespace App\Http\Requests;

use App\Models\Staff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStaffRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('staff_create');
    }

    public function rules()
    {
        return [
            'nip' => [
                'string',
                'nullable',
                'unique:staffs,nip,',
            ],
            'name' => [
                'string',
                'required',
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