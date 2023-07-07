<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('destination_id');        
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');               
            $table->string('offer_code', 100);  
            $table->string('offer_type', 100);
            $table->string('amount', 100);  
            $table->string('itinerary', 100);  
            $table->string('booking_date_from', 100);
            $table->string('booking_date_to', 100);  
            $table->string('travel_date_from', 100);
            $table->string('travel_date_to', 100); 
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
        Schema::dropIfExists('offers');
    }
}
