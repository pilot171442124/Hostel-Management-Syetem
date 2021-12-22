<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentpayment', function (Blueprint $table) {
            $table->id();
            $table->string('perstudent_id');
            $table->string('student_name');
            $table->string('program');
            $table->string('batchno');

            $table->string('hall_name');
            $table->string('room_no');
            $table->string('currency');
            $table->string('amount');
            $table->string('cellno');
            

            $table->string('invoic_no');
            $table->string('txrID')->nullable();
            $table->string('month')->nullable();

            $table->string('status');

            $table->string('application_status')->nullable();

            $table->string('first_Payment_time')->nullable();

            $table->string('number_of_seat')->nullable();


        
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
        Schema::dropIfExists('studentpayment');
    }
}
