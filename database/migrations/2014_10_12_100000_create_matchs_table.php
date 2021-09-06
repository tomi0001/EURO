<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_one')->unsigned();
            $table->foreign("country_one")->references("id")->on("countries");
            $table->bigInteger('country_two')->unsigned();
            $table->foreign("country_two")->references("id")->on("countries");
            $table->smallInteger('result_one')->unsigned()->nullable();
            $table->smallInteger('result_two')->unsigned()->nullable();
            $table->date('date');
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
        Schema::dropIfExists('matchs');
    }
}
