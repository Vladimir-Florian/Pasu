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
	
	
}
