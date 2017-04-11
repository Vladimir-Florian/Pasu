<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'languages';
	
    protected $guarded = [];	

	protected $fillable = [
		'slug',
		'name'
	];
	
	/**
	 *  Get the profiles associated with the language.
	 *  
	 *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('App\Profile');
	}
   //
}
