<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('image');
            $table->float('unit_price', 16);
            $table->float('promotion_price', 16)->nullable();
            $table->integer('unit');
            $table->text('description');
            $table->integer('delete_flag')->default(0)->comment("0: Chưa Xóa; 1: đã xóa");

            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('product');
    }
}
