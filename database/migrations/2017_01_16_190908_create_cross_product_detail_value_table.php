<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrossProductDetailValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cross_product_detail_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('detail_value_id');
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
        Schema::table('cross_product_detail_value', function (Blueprint $table) {
            //
        });
    }
}
