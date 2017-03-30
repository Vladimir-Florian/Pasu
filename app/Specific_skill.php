<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specific_skill extends Model
{
    	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'specific_skills';
	
    protected $guarded = [];

	protected $fillable = [
		'slug',
		'name',
		'description'
	];


	/**
	 * A skill belongs to an industry.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function industry()
	{
		return $this->belongsTo('App\Industry');
	}

	/**
	 *  Get the profiles associated with this skill.
	 *  
	 *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('App\Profile')->withTimestamps();
	}
//
}
