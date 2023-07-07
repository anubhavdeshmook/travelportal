<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Country extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Sortable;

    protected $table = 'countries';

   

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

 
}
