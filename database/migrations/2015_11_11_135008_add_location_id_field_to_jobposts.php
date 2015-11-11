<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationIdFieldToJobposts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobposts', function(Blueprint $table)
		{
			$table->integer('location_id')->unsigned()->index()->nullable();
			$table->foreign('location_id')->references('id')->on('locations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobposts', function(Blueprint $table)
		{
			$table->dropForeign('jobposts_location_id_foreign');
			$table->dropColumn('location_id');
		});
	}

}
