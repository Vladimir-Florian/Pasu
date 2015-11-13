<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'jobposts';
	
    protected $guarded = [];	

	protected $fillable = [
		'experience',
		'education',
		'benefits',
		'incentives',
		'responsabilities',
		'salary',
		'currency',
		'workhours',
		'request_date'
	];

	/**
	 * A jobpost belongs to an employer.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function employer()
	{
		return $this->belongsTo('App\Employer');
	}
	
	/**
	 * A jobpost belongs to an jobtype.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function jobtype()
	{
		return $this->belongsTo('App\Jobtype');
	}

	/**
	 * A jobpost belongs to an employment_type.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function employment_type()
	{
		return $this->belongsTo('App\Employment_type');
	}
	
	/**
	 * A jobpost belongs to a location.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function location()
	{
		return $this->belongsTo('App\Location');
	}

	/**
	 *  Get the jobtags of the given jobpost
	 *  
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
	 */
	public function jobtags()
	{
		return $this->belongsToMany('App\Jobtag')->withTimestamps();
	}

	/**
	 * A jobpost has many applications
	 *
	 * @return
	 */
	public function applications() {
		return $this->hasMany('App\Application');
	}

	/**
	 * A jobpost has many markedjobposts
	 *
	 * @return
	 */
	public function markedjobposts() {
		return $this->hasMany('App\Markedjobposts');
	}
	
	
}
