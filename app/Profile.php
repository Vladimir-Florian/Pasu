<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employers';
	
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
		return $this->belongsToMany('App\Certificate')->withPivot('details')->withTimestamps();
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

	
}
