<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class CreateServiceusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("user_id")->nullable()->constrained("users")->references("id");
            $table->foreignId("services_type_id")->nullable()->constrained("servicetypes")->references("id");
            $table->string('name');
            $table->string('image_ID');
            $table->string('shop_name')->nullable();
            $table->string('phone');
            $table->string('other_phone')->nullable();
            $table->longtext('disc')->nullable();
            $table->enum('available',['1','0']);
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
        Schema::dropIfExists('serviceus');
    }
}