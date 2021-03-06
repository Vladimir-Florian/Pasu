<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';
	
    protected $guarded = [];	

	protected $fillable = [
		'name',
		'phone_no',
		'birthdate',
		'experience'
	];
	

	/**
	 * An profile belongs to an user.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	/**
	 * An profile belongs to an industry.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function industry()
	{
		return $this->belongsTo('App\Industry');
	}

	/**
	 *  Get the certificates of the given profile
	 *  
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
	 */
	public function certificates()
	{
		return $this->belongsToMany('App\Certificate')->withPivot('awarder', 'date_awarded')->withTimestamps();
	}

	/**
	 *  Get the languages of the given profile
	 *  
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
	 */
	public function languages()
	{
		return $this->belongsToMany('App\Language')->withPivot('level_id')->withTimestamps();
	}


    /**
     *  Get the locations for the profile.
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
     */
    public function locations()
    {
		return $this->belongsToMany('App\Location')->withPivot('location_type', 'start_date', 'end_date')->withTimestamps();
		
    }

	/**
	 * A Profile has one resume
	 *
	 * @return
	 */
	public function resume() {
		return $this->hasOne('App\Resume');
	}

	/**
	 * A Profile has many driving licences
	 *
	 * @return
	 */
	public function drivinglicences() {
		return $this->hasMany('App\Drivinglicence');
	}

	/**
	 * A Profile has many applications
	 *
	 * @return
	 */
	public function applications() {
		return $this->hasMany('App\Application');
	}
	
	/**
	 * A Profile has many requests
	 *
	 * @return
	 */
	public function requests() {
		return $this->hasMany('App\Request');
	}

	/**
	 * A Profile has many markedjobposts
	 *
	 * @return
	 */
	/*
	public function markedjobposts() {
		return $this->hasMany('App\Markedjobpost');
	}*/

	/**
	 * The marked jobposts that belong to the profile
	 *
	 */
	public function jobposts() {
		return $this->belongsToMany('App\Jobpost', 'markedjobposts', 'profile_id', 'jobpost_id')->withPivot('mark_date');
	}

	

	/**
	 * The applied jobposts that belong to the profile
	 *
	 */
	public function applied_jobposts() {
		return $this->belongsToMany('App\Jobpost', 'applications', 'profile_id', 'jobpost_id')->withPivot('app_date');
	}


	
	public function scopeByuser_id($query, $id) {
		return $query->where('user_id', '=', $id);
	}

    /**
     *  Get the specific skills for the profile.
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
     */
    public function specific_skills()
    {
		return $this->belongsToMany('App\Specific_skill')->withTimestamps();
		
    }

	/**
	 * A Profile has one scertificate
	 *
	 * @return
	 */
	public function scertificate() {
		return $this->hasOne('App\Scertificate');
	}

	
}
