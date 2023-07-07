<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinationImage extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Sortable,SoftDeletes;

    protected $table = 'destination_images';

    protected $fillable = [
        'image','destination','deleted_at','created_at', 'updated_at'
    ];
    public $sortable = [
        'name','subject','description', 'status', 'created_at', 'updated_at'
    ];
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
  */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function Country()
    {
        return $this->belongsTo('App\Models\Country','destination','id');
    }
 
}
