<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('country_id');        
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');       
            $table->integer("parent_id")->length(10)->nullable();
            $table->string('name', 200);  
            $table->string('latitude', 200);  
            $table->string('longitude', 200);  
            $table->integer("is_popular")->length(10)->nullable();                        
            $table->string('code',200);
            $table->string('status'); 
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('destinations');
        
    }
}
