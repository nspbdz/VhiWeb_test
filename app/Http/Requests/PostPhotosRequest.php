<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Helpers\ResponseHelpers;

class PostPhotosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'caption' => 'required',
            'tags' => 'required',
        ];
    }

        public function failedValidation(Validator $validator)
        {
            ResponseHelpers::sendError('Validation Error.', $validator->errors());
        }

}

