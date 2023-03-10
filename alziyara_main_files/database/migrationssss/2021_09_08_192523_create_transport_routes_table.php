<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransportRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('RouteID')->nullable();
            $table->string('RouteName')->nullable();
            $table->string('RouteFrom')->nullable();
            $table->string('RouteTo')->nullable();
            $table->string('Distance')->nullable();
            $table->string('DrivingTime')->nullable();
            $table->string('PickupDateTime')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transport_routes');
    }
}
