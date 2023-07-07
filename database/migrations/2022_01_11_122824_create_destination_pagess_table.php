<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationPagessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_pagess', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('destination', 100);
            $table->string('latitude', 100);  
            $table->string('longitude', 100);
            $table->text('short_descriptioin', 2000);  
            $table->text('meta_descriptioin', 2000); 
            $table->boolean('popular', 11);
            $table->string('self_url', 100);
            $table->longtext('description', 2000);
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
        Schema::dropIfExists('destination_pagess');
    }
}
