<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slug');
			$table->string('description');
			$table->timestamps();
		});
		
		Schema::create('certificate_profile', function(Blueprint $table)
		{
			$table->integer('certificate_id')->unsigned()->index();
			$table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
			
			$table->integer('profile_id')->unsigned()->index();
			$table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
			
			$table->timestamps();
			$table->unique(['certificate_id', 'profile_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certificate_profile');
		Schema::drop('certificates');
	}

}
