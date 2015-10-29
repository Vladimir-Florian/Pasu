<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToJobPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobposts', function(Blueprint $table)
		{
			$table->integer('validity_days')->default(10);
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
			$table->dropColumn('validity_days');
		});
	}

}
