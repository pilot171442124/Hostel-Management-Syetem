<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('userid')->length(20)->unsigned();
            $table->string('emptype');
            $table->string('gender');
            $table->string('dob');
            $table->bigInteger('hallnameid')->length(20)->unsigned();
            $table->string('phone');
            $table->string('address');
            $table->string('doj');
            $table->string('designation');
            $table->string('salary');
            $table->string('isactive');
            $table->string('perphoto');

            $table->timestamps();

            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('hallnameid')->references('id')->on('hallname');
           // $table->foreign('empid')->references('usercode')->on('users');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
