<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'email' => Rule::unique('users'),
            'filepload' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'required|min:6|max:255',
            'password_confirmation' => 'required|same:password|min:6|max:255',
        ];
    }
}
