<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Currency extends Model
{
    use SoftDeletes,Sortable;
    protected $fillable = [
        'name','code','sign', 'current_rate','exchange_rate','status','created_at','updated_at'
    ];
    public $sortable = [
        'name', 'status', 'created_at', 'updated_at'
    ];

    protected $table = 'currencies';
 
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
}