<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;


class Booking extends Authenticatable
{

    use Sortable;
   
    protected $table = 'bookings';
    protected $fillable = [
        'user_id','booking_response','stripe_trans_id','created_at', 'updated_at'
    ];

 
}
