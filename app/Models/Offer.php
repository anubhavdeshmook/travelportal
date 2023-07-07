<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Offer extends Model
{
    use SoftDeletes,Sortable;
    protected $fillable = [
        'name','destination_id','offer_code', 'offer_type','amount','itinerary','booking_date_from','booking_date_to','travel_date_from','travel_date_to','status','created_at','updated_at'
    ];
    public $sortable = [
        'name','destination_id','offer_code', 'offer_type','amount','itinerary','booking_date_from','booking_date_to','travel_date_from','travel_date_to','status','created_at','updated_at'
    ];
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function destinations()
    {
        return $this->belongsTo('App\Models\Destination','destination_id','id');
    }
}