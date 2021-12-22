<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Manageloginid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manageloginid', function (Blueprint $table) {
            $table->id();
            $table->string('studentid');
            $table->string('studentname');
            $table->string('studentdept');
            $table->string('batch');

            $table->timestamps();
        });



// default data will insert in database
     
DB::table('manageloginid')->insert([
    ['studentid'=>'171442106','studentname'=>'shojib','studentdept' => 'CSE','batch' => '44th'],
    ['studentid'=>'171442152','studentname'=>'Jakir','studentdept' => 'CSE','batch' => '43th' ]

    
    

]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manageloginid');
    }
}
