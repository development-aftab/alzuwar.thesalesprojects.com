<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('receipt_num')->nullable();
            $table->string('package_deals_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('created_by')->nullable();
            $table->string('reservation_for_date')->nullable();
            $table->string('notes_by_customer')->nullable();
            $table->string('total_price')->nullable();
            $table->string('booking_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('sp_comments')->nullable();
            $table->string('sp_comments_date_time')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('searches');
    }
}
