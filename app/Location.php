<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';
	
    protected $guarded = [];

	protected $fillable = [

		'address',
		'postal_code',
		'city',
		'province',
		'country_code',
		'latitude',
		'longitude'
	];
	
	/**
	 * A Location has many LocationProfiles
	 *
	 * @return
	 */
	public function location_profiles() {
		return $this->hasMany('App\LocationProfile');
	}

}
