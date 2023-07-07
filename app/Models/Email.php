<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Email extends Model
{
    use SoftDeletes,Sortable;
    protected $fillable = [
        'name','subject','description', 'status','slug','created_at','updated_at'
    ];
    public $sortable = [
        'name','subject','description', 'status', 'created_at', 'updated_at'
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


    protected static function boot() {
        parent::boot();

        static::creating(function ($email) {
            $email->slug = Str::slug($email->name);
        });
    }
  
    /** 
     * Write code on Method
     *
     * @return response()
     */
 
}