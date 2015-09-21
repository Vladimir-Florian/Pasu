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
	 *  Get the profiles associated with the location.
	 *  
	 *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('App\Profile')->withPivot('location_type', 'start_date', 'end_date')->withTimestamps();
	}

}
