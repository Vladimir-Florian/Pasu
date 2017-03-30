<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'industries';
	
    protected $guarded = [];

	protected $fillable = [
		'slug',
		'name'
	];
	
	/**
	 * An industry has many profiles
	 *
	 * @return
	 */
	public function profiles() {
		return $this->hasMany('App\Profile');
	}

	/**
	 * An industry has many employers
	 *
	 * @return
	 */
	public function employers() {
		return $this->hasMany('App\Employer');
	}

	/**
	 * An industry has many jobtypes
	 *
	 * @return
	 */
	public function jobtypes() {
		return $this->hasMany('App\Jobtype');
	}
	
    /**
     * Get all of the jobposts for the industry.
     */
    public function jobposts()
    {
        return $this->hasManyThrough('App\Jobost', 'App\Jobtype');
    }

	/**
	 * An industry has many certificates
	 *
	 * @return
	 */
	public function certificates() {
		return $this->hasMany('App\Certificate');
	}

	/**
	 * An industry has many specific skills
	 *
	 * @return
	 */
	public function certificates() {
		return $this->hasMany('App\Specific_skill');
	}

	
}
