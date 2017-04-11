<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LangLevel extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lang_levels';
	
    protected $guarded = [];	

	protected $fillable = [
		'slug',
		'name'
	];
	
	/**
	 * A  Level can appear in many language_profiles
	 *
	 * @return
	 */
	public function language_profiles() {
		return $this->hasMany('App\LanguageProfile');
	}

}
