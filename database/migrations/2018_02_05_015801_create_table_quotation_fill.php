<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuotationFill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_fill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotation_id', 100);
            $table->boolean('fixed_cost_completed');
            $table->string('fixed_cost_errors');
            $table->boolean('variable_cost_completed');
            $table->string('variable_cost_errors');
            $table->boolean('other_expenses_completed');
            $table->string('other_expenses_errors');
            $table->boolean('land_arrangement_completed');
            $table->string('land_arrangement_errors');
            $table->boolean('summary_completed');
            $table->string('summary_errors');
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
        Schema::dropIfExists('quotation_fill');
    }
}
