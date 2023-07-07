<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchResults extends Model
{
    use HasFactory;
    protected $table = 'api_search_results';
    protected $fillable = [
        'destination','destination_code', 'check_in_date','check_out_date','rooms','guests'
    ];
}
