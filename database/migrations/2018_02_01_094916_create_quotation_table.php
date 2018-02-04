<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tour_name');
            $table->integer('category_id');
            $table->integer('currency_id');
            $table->integer('number_of_pax');
            $table->date('validity');
            $table->integer('user_id');
            $table->string('incentive_staff');
            $table->string('commission_sales');
            $table->string('cn');
            $table->string('profit');
            $table->string('net_per_pax');
            $table->string('ppn1');
            $table->string('selling_price');
            $table->softDeletes();
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
        Schema::dropIfExists('quotation');
    }
}
