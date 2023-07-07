<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Enquiry extends Model
{
    use SoftDeletes,Sortable;
    protected $fillable = [
        'name','description', 'status','created_at','updated_at'
    ];
    public $sortable = [
        'name','description', 'status', 'created_at', 'updated_at'
    ];



 
  
 
}