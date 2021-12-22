<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empid')->length(20)->unsigned();
            $table->string('hallnameid');
            $table->string('empname');
            $table->string('emptype');
            $table->string('empphone');
            $table->string('amount');         
            $table->string('monthyear');
            $table->string('bonus')->nullable();

            
           $table->timestamps();
          
           $table->foreign('empid')->references('userid')->on('employee');
 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
