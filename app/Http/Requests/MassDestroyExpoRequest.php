<?php

namespace App\Http\Requests;

use App\Models\Expo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExpoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('expo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:expoes,id',
        ];
    }
}