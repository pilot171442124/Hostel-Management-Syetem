<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodmenuperdayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodmenuperday', function (Blueprint $table) {
            $table->id();
            $table->string('foodid');
            $table->string('food_status')->nullable();
            $table->string('date');
            $table->string('foodselecttime');


            
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
        Schema::dropIfExists('foodmenuperday');
    }
}
