<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scertificate extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'scertificates';
	
    protected $guarded = [];	

	protected $fillable = [	'file_path', 'description' ];
	

	/**
	 * A scertificate belongs to a profile.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}

}
