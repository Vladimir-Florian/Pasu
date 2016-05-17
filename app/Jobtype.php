<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'jobtypes';
	
    protected $guarded = [];	

	protected $fillable = [
		'name',
		'description',
		'occupational_category'
	];
	
	
	
	/**
	 * A jobtype belongs to an industry.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function industry()
	{
		return $this->belongsTo('App\Industry');
	}

	/**
	 * A jobtype has many jobposts
	 *
	 * @return
	 */
	public function jobposts() {
		return $this->hasMany('App\Jobpost');
	}

	/**
	 *  query by industry
	 *  @param  int $id 	industry id	 
	 */	
	public function scopeByindustry($query, $id) {
		return $query->where('industry_id', '=', $id);
	}
	
	
}
