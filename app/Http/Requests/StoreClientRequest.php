<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            //

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'mobile' =>['required','string', 'min:11'],
            'country' =>['required','string'],
            'gender' =>['required','string'],
            'avatar_img' => 'required|mimes:jpeg,jpg,png'
            
        ];
    }


    public function messages(){   /// this to override the default validation message


    
        return [
                
            'avatar_img.mimes' => 'you must upload an image of type jpg,jpeg,png',
            'avatar_img.required' => 'you must upload an avatar'

        ];
    }
}
