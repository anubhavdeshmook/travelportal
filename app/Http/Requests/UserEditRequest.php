<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserEditRequest extends FormRequest
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
            
        $rule['name'] = 'required|max:100';
        $rule['email'] =  'required|email|unique:users,email,'.$this->id;
        $rule['phone']='required|numeric|digits:10';
         
        return $rule;
    }
}
