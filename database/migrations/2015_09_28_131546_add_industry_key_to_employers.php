<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndustryKeyToEmployers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employers', function(Blueprint $table)
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
		Schema::table('employers', function(Blueprint $table)
		{
			$table->dropForeign('employers_industry_id_foreign');
		});
	}

}
