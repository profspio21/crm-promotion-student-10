<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class UpdateInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('information_crud');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => 'required',
            'target' => 'required',
            'media_informasi' => 'required',
            'detail' => 'nullable',
            'type' => 'required',
            'poster' => 'nullable',
            'start_publish_date' => 'nullable',
            'end_publish_date' => 'nullable',
        ];
    }
}
