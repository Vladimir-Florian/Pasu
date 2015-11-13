<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'requests';
	
    protected $guarded = [];	

	protected $fillable = [];

	/**
	 * An application belongs to a profile.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}


}
