<?php

namespace App\Http\Requests;

use App\Models\Expo;
use App\Models\DetailExpo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExpoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('expo_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal' => [
                'required',
            ],
            'tempat' => [
                'required',
            ],
            'pic' => [
                'required',
            ],
        ];
    }
}
