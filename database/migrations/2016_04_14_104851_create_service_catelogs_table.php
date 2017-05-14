<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceCatelogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('service_catelogs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('sequence')->nullable();
            $table->text('description');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('image');
            //$table->foreign('parent_id')->references('id')->on('service_catelogs')->onDelete('cascade');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('service_catelogs');
    }

}
