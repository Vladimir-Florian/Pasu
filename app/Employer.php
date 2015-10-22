<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employers';
	
    protected $guarded = [];	

	protected $fillable = [
		'company_name',
		'phone_no',
		'company_j',
		'company_cui',
		'company_account'
	];
	
	/**
	 * An employer belongs to an user.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	
	/**
	 * An employer belongs to an industry.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function industry()
	{
		return $this->belongsTo('App\Industry');
	}

	/**
	 * An employer has many jobposts
	 *
	 * @return
	 */
	public function jobposts() {
		return $this->hasMany('App\Jobpost');
	}
	
	
	/**
	 *  Get the certificates of the given profile
	 *  
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
	 */
/*	 
	public function certificates()
	{
		return $this->belongsToMany('App\Certificate')->withPivot('details')->withTimestamps();
	}
*/

    /**
     *  Get the locations for the profile.
	 *  @return \IlluminateDatabase\Eloquent\Relations\BelongsToMany
	 *  
     */
/*	 
    public function locations()
    {
		return $this->belongsToMany('App\Location')->withPivot('location_type', 'start_date', 'end_date')->withTimestamps();
		
    }
*/
	
}
