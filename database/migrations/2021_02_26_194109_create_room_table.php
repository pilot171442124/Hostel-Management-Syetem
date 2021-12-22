<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->string('roomno');
            $table->string('noofseat');
            $table->bigInteger('hallid')->length(20)->unsigned();
            $table->string('emptyseat');
            $table->string('newemptydate')->nullable()->default('NUll');
            $table->string('newemptyno')->nullable()->default('NUll');

            
            
            $table->string('cost');

            $table->string('isactive');
            $table->foreign('hallid')->references('id')->on('hallname');
          

            
           


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
        Schema::dropIfExists('room');
    }
}
