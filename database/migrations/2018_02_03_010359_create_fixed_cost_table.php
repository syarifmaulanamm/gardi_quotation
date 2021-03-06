<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotation_id');
            $table->string('item');
            $table->integer('currency');
            $table->string('price');
            $table->string('quantity');
            $table->string('duration');
            $table->string('amount');
            $table->string('remarks');
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
        Schema::dropIfExists('fixed_cost');
    }
}
