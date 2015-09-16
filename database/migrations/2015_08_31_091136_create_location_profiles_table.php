<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location_profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('location_id')->unsigned()->index();
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
			$table->integer('profile_id')->unsigned()->index();
			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
			$table->unique(['location_id', 'profile_id']);
			$table->string('location_type');			
			//$table->integer('location_type_id')->unsigned()->nullable();
			
			$table->date('start_date');
			$table->date('end_date');
			
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
		Schema::drop('location_profiles');
	}

}
