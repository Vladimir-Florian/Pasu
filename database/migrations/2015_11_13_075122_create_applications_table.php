<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profile_id')->unsigned()->index();
			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
			$table->integer('jobpost_id')->unsigned()->index();
			$table->foreign('jobpost_id')->references('id')->on('jobposts')->onDelete('cascade');
			$table->date('app_date');	

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
		Schema::drop('applications');
	}

}
