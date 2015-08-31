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
	 * A profile belongs to an industry.
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
		return $this->belongsToMany('App\Certificate')->withPivot('details')->withTimestamps();
	}

	/**
	 * A Profile has many LocationProfiles
	 *
	 * @return
	 */
	public function location_profiles() {
		return $this->hasMany('App\LocationProfile');
	}

    /**
     * Get all of the locations for the profile.
     */
    public function locations()
    {
        return $this->hasManyThrough('App\Location', 'App\LocationProfile');
    }

	
}
