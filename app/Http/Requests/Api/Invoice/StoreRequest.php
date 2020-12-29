<?php

namespace App\Http\Requests\Api\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \auth()->user()->hasPermissionTo('create invoice');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'school_name' => 'required|string|max:100',
            'description' => 'required|string|max:5000',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
