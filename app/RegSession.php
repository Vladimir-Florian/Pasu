<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegSession extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reg_sessions';
	
    protected $guarded = [];	

	protected $fillable = [
		'name',
		'phone_no',
		'birthdate',
		'experience'
	];

	/**
	 * An reg_session belongs to an user.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
