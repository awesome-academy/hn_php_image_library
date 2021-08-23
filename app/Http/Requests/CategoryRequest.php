<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
                    Rule::unique('categories')->ignore($this->name, 'name'),
                ],
            ];
        } else {
            return [
                'name' => [
                    'required',
                    'max:20',
                    Rule::unique('categories'),
                ],
            ];
        }
    }
}
