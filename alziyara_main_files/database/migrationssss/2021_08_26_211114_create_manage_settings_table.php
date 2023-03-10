<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('product_category')->nullable();
            $table->integer('package_deals_type_id')->nullable();
            $table->string('package_deals_name')->nullable();
            $table->string('package_deals_desc')->nullable();
            $table->string('package_deals_itinerary')->nullable();
            $table->string('package_deals_status')->nullable();
            $table->string('price')->nullable();
            $table->string('max_occupancy')->nullable();
            $table->string('package_deals_time')->nullable();
            $table->string('package_deals_location')->nullable();
            $table->string('house_rules')->nullable();
            $table->string('display_on_home_page')->nullable();
            $table->string('sort_order')->nullable();
            $table->string('package_deals_create_by')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manage_settings');
    }
}
