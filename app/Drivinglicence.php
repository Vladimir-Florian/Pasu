<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivinglicence extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'drivinglicences';
	
    protected $guarded = [];	

	protected $fillable = [
		'category'
	];
	
	/**
	 * An licence belongs to a profile
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}

}
