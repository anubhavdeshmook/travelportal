<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commisions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);    
            $table->unsignedBigInteger('destination');        
            $table->foreign('destination')->references('id')->on('destinations')->onDelete('cascade');               
            $table->string('mark_type', 100);  
            $table->string('itinerary', 100);
            $table->string('amount', 200);  
            $table->string('booking_date_from', 100);
            $table->string('booking_date_to', 100);  
            $table->string('travel_date_from', 100);
            $table->string('travel_date_to', 100); 
            $table->string('duration_days_from', 100);
            $table->string('duration_days_to', 100); 
            $table->string('status');
            $table->softDeletes();          
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
        Schema::dropIfExists('commisions');
    }
}
