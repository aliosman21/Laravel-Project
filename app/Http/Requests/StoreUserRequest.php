<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'email' => 'unique:users|required',
            'name' => 'required',
            'password' => 'required|min:6',
            'national_id' => 'required',
            'role' => 'required',

        ];
        return $rules;
    }
}
