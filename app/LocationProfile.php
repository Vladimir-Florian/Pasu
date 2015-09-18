<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationProfile extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'location_profiles';
	
    protected $guarded = [];

	protected $fillable = [
		'location_id',
		'profile_id',
		'location_type',
		'start_date',
		'end_date'
	];
	
	/**
	 * A LocationProfile belongs to a Location.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function location()
	{
		return $this->belongsTo('App\Location');
	}

	/**
	 * A LocationProfile belongs to a Profile.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}
	
}
