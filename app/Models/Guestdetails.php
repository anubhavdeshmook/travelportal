<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guestdetails extends Model
{
    use HasFactory;
    protected $table = 'guest_details';
    protected $fillable = ['user_id','guest_details'];
}
