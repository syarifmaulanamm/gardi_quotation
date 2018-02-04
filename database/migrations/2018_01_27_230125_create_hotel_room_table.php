<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_room', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hotel_id');
            $table->string('name');
            $table->integer('room_type');
            $table->integer('bed_type');
            $table->integer('currency');
            $table->string('price');
            $table->integer('capacity');
            $table->text('remarks');
            $table->text('images');
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
        Schema::dropIfExists('hotel_room');
    }
}
