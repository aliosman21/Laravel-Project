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
            'avatar' => 'required|ends_with:jpeg,jpg,png,JPEG,JPG,PNG'
            //mimes:jpeg,jpg,png,JPEG,JPG,PNG
        ];
    }


    public function messages(){   /// this to override the default validation message


    
        return [
                
            'avatar.ends_with' => 'you must upload an image of type jpg,jpeg,png',
            'avatar.required' => 'you must upload an avatar'

        ];
    }
}
