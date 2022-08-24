<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class CreateproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("admin_id");
            $table->string('name');
            $table->string('price')->nullable();
            $table->foreignId("category_id")->constrained("categories")->onUpdate("cascade")->onDelete("cascade");
            $table->string('image')->nullable();
            $table->string('colors')->nullable();
            $table->string('sizes')->nullable();
            $table->boolean('available')->default(1);
            $table->longtext('desc_en');
            $table->longtext('desc_ar')->nullable();
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
        Schema::dropIfExists('products');
    }
}
