<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('address')->nullable();
			$table->string('phone');
			$table->string('otp')->nullable();
			$table->boolean('status')->default(false);
			$table->enum('type',['1','0'])->default(0);
			$table->string('pic')->nullable();
			$table->string('id_image')->nullable();/////===
			$table->string('other_phone')->nullable();/////===
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
