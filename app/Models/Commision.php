<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commision extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Sortable,SoftDeletes;

    protected $table = 'commisions';

    protected $fillable = [
        'name','destination','mark_type', 'itinerary','amount','booking_date_from','booking_date_to','travel_date_from','travel_date_to','duration_days_from','duration_days_to','status','deleted_at','created_at', 'updated_at'
    ];
    public $sortable = [
        'name', 'status', 'created_at', 'updated_at'
    ];

    public function Country()
    {
        return $this->belongsTo('App\Models\Country','destination','id');
    }
 
}
