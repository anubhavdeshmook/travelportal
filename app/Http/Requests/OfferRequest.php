<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        'destination_id' => 'required',
        'offer_code'=> 'required',
        'offer_type'=>'required',
        'amount'=> 'required',
        'itinerary'=> 'required',
        'booking_date_from' => 'required',
        'booking_date_to' => 'required',
        'travel_date_from'=> 'required',
        'travel_date_to'=>'required',
       
            
        ];
    }
}
