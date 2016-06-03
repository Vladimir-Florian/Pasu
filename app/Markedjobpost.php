<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Markedjobpost extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'markedjobposts';
	
    protected $guarded = [];	

	protected $fillable = [	'mark_date' ];

	/**
	 * A Mark belongs to a profile.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}

	/**
	 * A Mark belongs to a jobpost.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function jobpost()
	{
		return $this->belongsTo('App\Jobpost');
	}

}
