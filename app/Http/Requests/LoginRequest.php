<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required|min:3"
        ];
    }

    public function messages()
    {
        $message =  [
            'email.required|email' => 'Email required',
            'password.required|min:3' => 'Password required'
        ];


        return $message;
    }
}
