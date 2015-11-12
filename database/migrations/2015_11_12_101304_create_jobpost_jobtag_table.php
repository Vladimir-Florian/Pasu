<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobpostJobtagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobpost_jobtag', function(Blueprint $table)
		{
			$table->integer('jobpost_id')->unsigned()->nullable();
			$table->foreign('jobpost_id')->references('id')->on('jobposts')->onDelete('cascade');
			$table->integer('jobtag_id')->unsigned()->nullable();
			$table->foreign('jobtag_id')->references('id')->on('jobtags')->onDelete('cascade');
			$table->unique(['jobpost_id', 'jobtag_id']);

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
		Schema::drop('jobpost_jobtag');
	}

}
