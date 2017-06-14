<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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
		'request_date',
		'award_date',
		'validity_days',
		'jobtitle'
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
	/*
	public function applications() {
		return $this->hasMany('App\Application');
	}
	*/

	/**
	 * The profiles that belong to the applied jobpost
	 *
	 */
	public function aprofiles() {
		//return $this->belongsToMany('App\Profile');
		return $this->belongsToMany('App\Profile', 'applications', 'jobpost_id', 'profile_id')->withPivot('app_date');		
	}



	/**
	 * A jobpost has many markedjobposts
	 *
	 * @return
	 */
	/*
	public function markedjobposts() {
		return $this->hasMany('App\Markedjobpost');
	}*/

	/**
	 * The profiles that belong to the marked jobpost
	 *
	 */
	public function profiles() {
		//return $this->belongsToMany('App\Profile');
		return $this->belongsToMany('App\Profile', 'markedjobposts', 'jobpost_id', 'profile_id')->withPivot('mark_date');		
	}


	//Accessors for relationship attributes
    /**
     * Get the job's location.
     */
	/*
    public function getLocatAttribute()
    {
        return $this->location->latitude;
        //return $this->employer->company_name;
    }
	*/
	
	//Queries with Scopes
	/**
	 *  query by jobtype 
	 */	
	public function scopeByjobtype($query, $id) {
		return $query->join('employers', 'jobposts.employer_id', '=', 'employers.id')
					->where('jobtype_id', '=', $id)
					->select('jobposts.id', 'jobposts.jobtitle', 'jobposts.request_date', 'employers.company_name');
	}

	/**
	 *  query by jobtype and within 10 days
	 */
	public function scopeWithin10days($query, $id) {
		$current = Carbon::today();															
		$tenth_day = $current->subDays(10);		
		return $query->join('employers', 'jobposts.employer_id', '=', 'employers.id')
				     ->where('jobtype_id', '=', $id)
				     ->whereDay('request_date', '>=', $tenth_day)		
					 ->select('jobposts.id', 'jobposts.jobtitle', 'jobposts.request_date', 'employers.company_name');

/*				->select('id',
					'jobtitle',
					'experience',
					'education',
					'benefits',
					'incentives',
					'responsabilities',
					'salary',
					'currency',
					'workhours',
					'request_date');*/
					
	}	

	/**
	 *  query by industry 
	 * @param  int $id 	industry id
	 */	
	public function scopeByindustry($query, $id) {
		return $query->join('employers', 'jobposts.employer_id', '=', 'employers.id')
					->join('jobtypes', 'jobposts.jobtype_id', '=', 'jobtypes.id')		
					->where('jobtypes.industry_id', '=', $id)
					->select('jobposts.id', 'jobposts.jobtitle', 'jobposts.request_date', 'employers.company_name');
	}

	/**
	 *  query by jobpost id 
	 * @param  int $id 	jobpost id
	 */	
	public function scopeByjobpostid($query, $id) {
		return $query->join('employers', 'jobposts.employer_id', '=', 'employers.id')
					->join('jobtypes', 'jobposts.jobtype_id', '=', 'jobtypes.id')		
					->join('employment_types', 'jobposts.employment_type_id', '=', 'employment_types.id')		
					->where('jobposts.id', '=', $id)
					->select('jobposts.id', 'jobposts.jobtitle', 'experience', 'education',
					'benefits', 'incentives', 'responsabilities',
					'salary', 'currency', 'workhours',
					'request_date', 'validity_days', 'award_date',
					'employers.company_name', 'employment_types.name as employment_type','jobtypes.name as job_type');
	}
	
		
}
