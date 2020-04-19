<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBooktableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booktable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note');
            $table->integer('status')->nullable();

            $table->integer('id_table')->unsigned();
            $table->foreign('id_table')->references('id')->on('tables')->onDelete('cascade');;

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
        Schema::dropIfExists('booktable');
    }
}
