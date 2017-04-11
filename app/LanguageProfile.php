<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageProfile extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'language_profile';

	/**
	 * An language_profile has a level
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function lang_level()
	{
		return $this->belongsTo('App\LangLevel');
	}

    //
}
