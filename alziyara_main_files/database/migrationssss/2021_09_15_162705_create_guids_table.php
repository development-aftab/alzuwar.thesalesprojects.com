<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guids', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('GuidesID')->nullable();
            $table->integer('Productcategory')->nullable();
            $table->string('GuidesName')->nullable();
            $table->text('GuidesDesc')->nullable();
            $table->text('GuidesItinerary')->nullable();
            $table->integer('Admin_status')->nullable();
            $table->integer('userstatus')->nullable();
            $table->integer('GuidesStatus')->nullable();
            $table->integer('PricePerDay')->nullable();
            $table->integer('MaxOccupancy')->nullable();
            $table->string('GuidesLocation')->nullable();
            $table->integer('DaysInTrip')->nullable();
            $table->text('HouseRules')->nullable();
            $table->integer('DisplayOnHomePage')->nullable();
            $table->integer('SortOrder')->nullable();
            $table->integer('GuidesCreatedBy')->nullable();
            $table->string('Languages')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guids');
    }
}
