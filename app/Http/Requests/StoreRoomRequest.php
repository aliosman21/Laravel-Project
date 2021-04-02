<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
        
        $rules =[
            'number' => 'unique:rooms|max:3|required',
            'price' => 'required',
            'capacity' => 'required',
            'floor_id' => 'required'
        ];

        return $rules;
    }
   
}
