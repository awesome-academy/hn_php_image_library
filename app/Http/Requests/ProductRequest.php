<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('put')) {
            return [
                'name' => [
                    'required',
                    'max:20',
                    Rule::unique('products')->ignore($this->name, 'name'),
                ],
                'price' => 'required|max:20',
            ];
        } else {
            return [
                'name' => [
                    'required',
                    'max:20',
                    Rule::unique('products'),
                ],
                'price' => 'required|max:20',
            ];
        }
    }
}
