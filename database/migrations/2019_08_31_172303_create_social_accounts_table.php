<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_accounts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('platform');
			$table->string('icon');
			$table->timestamps();
		});
		Schema::create('member_social_account', function (Blueprint $table) {
			$table->unsignedBigInteger('social_account_id');
			$table->unsignedBigInteger('member_id');
			$table->string('url')->unique();
			$table->unique(['social_account_id', 'member_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('social_accounts');
		Schema::dropIfExists('member_social_account');
	}
}
