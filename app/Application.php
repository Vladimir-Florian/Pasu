<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'applications';
	
    protected $guarded = [];	

	protected $fillable = [	'app_date' ];

	/**
	 * An application belongs to a profile.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}

	/**
	 * An application belongs to a jobpost.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function jobpost()
	{
		return $this->belongsTo('App\Jobpost');
	}
	
}
