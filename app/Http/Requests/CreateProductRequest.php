<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required',
            'type' => 'in:item,service',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
