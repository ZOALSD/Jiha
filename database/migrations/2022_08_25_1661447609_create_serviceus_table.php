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
            $table->foreignId("category_id")->nullable()->constrained("categories")->references("id");
            $table->enum('available',['1','0'])->nullable();
            $table->string('price')->nullable();
            $table->enum('delivery',['1','0'])->nullable();
            $table->text('disc')->nullable();
            $table->string('image')->nullable();
            $table->enum('active',['1','0'])->default(1);
            $table->string('title')->nullable();
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
        Schema::dropIfExists('serviceus');
    }
}