<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
        *Author : kishan 
        *Date : 3/05/22
        *made nullable fields for complete profile  
    */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id');
            $table->foreign('u_id')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('degree')->nullable();
            $table->string('grade')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default('1')->comment('1 for active, 0 for in active')->nullable();
            $table->timestamps();
        });
    }
    /*
        *Author : kishan 
        *Date : 3/05/22
        *end
    */
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
};
