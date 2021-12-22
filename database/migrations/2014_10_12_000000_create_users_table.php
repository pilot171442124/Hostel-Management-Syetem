<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           


            $table->id();
            $table->string('usercode')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('userrole');
            $table->string('activestatus')->nullable();/*Active or Inactive*/
            $table->string('phone')->unique();
            $table->string('gender');
            $table->string('dob')->nullable();
            $table->string('bldgrp')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport')->nullable();
            $table->string('pass_no')->nullable();
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('p_cell')->nullable();
            $table->string('image')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();



        });
        $dateaandtime=date ( 'Y-m-d H:i:s' );
        //for make password
        $admindefaultPassword=Hash::make('administrator');
        $studentdefaultPassword=Hash::make('studenthms');
        $employeedefaultPassword=Hash::make('employeehms');


// default data will insert in database
     
        DB::table('users')->insert([
            ['usercode'=>'1234567','name'=>'Administrator','email' => 'pilotmazumdar@gmail.com','userrole' => 'Admin','activestatus' => 'Active','phone' => '01689763654',  'gender' => 'male',    'password' =>  $admindefaultPassword, 'created_at'=>$dateaandtime],
            ['usercode'=>'1234568','name'=>'Student','email' => 'studenthms@gmail.com','userrole' => 'Student','activestatus' => 'Active','phone' => '01852869231',  'gender' => 'female',   'password' => $studentdefaultPassword,'created_at'=>$dateaandtime],
            ['usercode'=>'1234569','name'=>'Employee','email' => 'employeehms@gmail.com','userrole' => 'Employee','activestatus' => 'Active','phone' => '01755897782',  'gender' => 'male',  'password' => $employeedefaultPassword,'created_at'=>$dateaandtime]
            

        ]);




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
