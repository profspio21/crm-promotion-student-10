<?php

namespace App\Http\Requests;

use App\Models\Staff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStaffRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('staff_edit');
    }

    public function rules()
    {
        return [
            'nip' => [
                'string',
                'nullable',
                'unique:staffs,nip,' . request()->route('staff')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
            'username' => [
                'nullable',
                'unique:users,username,' . request()->route('staff')->user_id,
            ],
            'email' => [
                'nullable',
                'unique:users,email,' . request()->route('staff')->user_id,
            ],
        ];
    }
}