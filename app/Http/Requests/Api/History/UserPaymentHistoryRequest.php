<?php

namespace App\Http\Requests\Api\History;

use Illuminate\Foundation\Http\FormRequest;

class UserPaymentHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \auth()->user()->hasPermissionTo('view payed history');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'nullable|string'
        ];
    }
}
