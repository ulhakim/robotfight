<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robots', function (Blueprint $table) {
            $table->id();
            $table->string('robot_name');
            $table->string('robot_colour');
            $table->string('robot_owner');
            $table->integer('robot_speed');
            $table->integer('robot_weight');
            $table->integer('robot_power');
            $table->integer('countfights')->unsigned()->nullabe()->default(0);;
            $table->integer('countwins')->unsigned()->nullabe()->default(0);;
            $table->integer('countlosses')->unsigned()->nullabe()->default(0);;
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
        Schema::dropIfExists('robots');
    }
}
