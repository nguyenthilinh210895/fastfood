<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total_price', 16);
            $table->string('payment')->nullable();
            $table->string('note');
            $table->integer('status')->nullable();
            $table->integer('type_order')->comment('1: online; 2:offline ');
            $table->integer('id_table')->nullable();
            $table->integer('delete_flag')->default(0)->comment("0: Chưa Xóa; 1: đã xóa");

            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade');
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
        Schema::dropIfExists('order');
    }
}
