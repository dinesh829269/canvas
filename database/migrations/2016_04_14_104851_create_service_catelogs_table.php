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
            $table->string('color');
            $table->text('description');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('image');
            //$table->foreign('parent_id')->references('id')->on('service_catelogs')->onDelete('cascade');
            $table->string('status');
            $table->string('is_approved')->default('pending');
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
