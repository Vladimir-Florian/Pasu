<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('industries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('slug')->default('')->unique();
			$table->timestamps();
		});

		Schema::table('profiles', function(Blueprint $table) 
		{
			$table->foreign('industry_id')->references('id')->on('industries');
		});
		

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profiles', function(Blueprint $table) 
		{
			$table->dropForeign('profiles_industry_id_foreign');
		});

		Schema::drop('industries');
	}

}
