<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationPageRequest extends FormRequest
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

        'name' => 'required|max:100',
        'destination' => 'required',
        'latitude'=> 'required',
        'longitude'=>'required',
        'short_descriptioin'=> 'required',
        'meta_descriptioin'=> 'required',

        'self_url'=> 'required',
        'popular'=>'required',
        'description'=> 'required',
        'meta_descriptioin'=> 'required',
            
        ];
    }
}
