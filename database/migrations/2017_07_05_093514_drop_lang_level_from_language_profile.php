<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLangLevelFromLanguageProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('language_profile', function (Blueprint $table) {
			$table->dropForeign('language_profile_level_id_foreign');
			$table->dropColumn('level_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_profile', function (Blueprint $table) {
            $table->integer('level_id')->unsigned()->index();
            $table->foreign('level_id')->references('id')->on('lang_levels')->onDelete('cascade');
        });
    }
}
