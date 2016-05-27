<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueToMarkedjobposts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('markedjobposts', function (Blueprint $table) {
			$table->unique(['profile_id', 'jobpost_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('markedjobposts', function (Blueprint $table) {
			$table->dropUnique('markedjobposts_profile_id_jobpost_id_unique');
        });
    }
}
