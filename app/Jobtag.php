<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobtag extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'jobtags';
	
    protected $guarded = [];	

	protected $fillable = [	'name'	];

	/**
	 *  Get the jobposts of the given jobtag
	 *  
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
	 */
	public function jobposts()
	{
		return $this->belongsToMany('App\Jobpost')->withTimestamps();
	}

	
}
