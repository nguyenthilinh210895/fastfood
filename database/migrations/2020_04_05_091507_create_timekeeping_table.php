<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimekeepingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timekeeping', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('delete_flag')->default(0)->comment("0: Chưa Xóa; 1: đã xóa");
            
            $table->integer('id_staff_absent')->unsigned();
            $table->foreign('id_staff_absent')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_staff_replace')->unsigned();
            $table->foreign('id_staff_replace')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timekeeping');
    }
}
