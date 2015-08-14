<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueToCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('certificates', function(Blueprint $table)
		{
			$table->unique('slug');
		});

		Schema::table('certificate_profile', function(Blueprint $table)
		{
			$table->string('details')->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('certificate_profile', function(Blueprint $table)
		{
			$table->dropColumn('details');
		});
		
		Schema::table('certificates', function(Blueprint $table)
		{
			$table->dropUnique('certificates_slug_unique');
		});
	}

}
