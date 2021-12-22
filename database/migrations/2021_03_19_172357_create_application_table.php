<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->id();
            $table->string('studentname');
            $table->bigInteger('studentid')->length(20)->unsigned();
            $table->string('hallname_id');
            $table->string('cellno');
            $table->string('email');
            $table->string('program');
            $table->string('batchno');

            $table->string('gender');
            $table->string('dob');
            $table->string('bloodgrp');
            $table->string('nationality');
            $table->string('pass_status');

            $table->string('passno')->nullable();
            $table->string('fname');
            $table->string('mname');
            $table->string('f_m_cellno');
    
            $table->string('p_address_v_t_r');
            $table->string('p_district');
            $table->string('p_postoffice');
            $table->string('p_postcode');
            $table->string('par_address_v_t_r');
            $table->string('par_district');
            $table->string('par_postoffice');
            $table->string('par_postcode');
            $table->string('room_no');
            $table->string('per_photo');
            $table->string('admit_date');
            $table->string('invoice_no');

            $table->string('status')->nullable();
            $table->string('roomcost');
            $table->string('app_month')->nullable();

            
            $table->string('seen_notification')->nullable();
            $table->string('seen_by_admin')->nullable();

            $table->string('is_active');

            $table->timestamps();


            $table->foreign('studentid')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application');
    }
}
