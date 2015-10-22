<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobpostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobposts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employer_id')->unsigned()->index();
			$table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
			$table->integer('jobtype_id')->unsigned()->index();
			$table->foreign('jobtype_id')->references('id')->on('jobtypes')->onDelete('cascade');
			$table->integer('employment_type_id')->unsigned()->index();
			$table->foreign('employment_type_id')->references('id')->on('employment_types')->onDelete('cascade');
			$table->integer('experience');
			$table->string('education');			
			$table->string('benefits')->nullable();			
			$table->string('incentives')->nullable();			
			$table->string('responsabilities')->nullable();			
			$table->integer('salary')->nullable();			
			$table->string('currency')->nullable();			
			$table->string('workhours')->nullable();			
			$table->integer('winner_id')->unsigned()->nullable();
			$table->date('request_date')->nullable();
			$table->date('award_date')->nullable();	
			
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
		Schema::drop('jobposts');
	}

}
