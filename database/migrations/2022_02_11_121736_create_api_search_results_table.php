<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiSearchResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_search_results', function (Blueprint $table) {
            $table->id();
            $table->string('destination', 255);   
            $table->string('destination_code', 150);   
            $table->date('check_in_date');    
            $table->date('check_out_date');    
            $table->integer('rooms');    
            $table->integer('guests');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_search_results');
    }
}
