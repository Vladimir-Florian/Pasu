<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'jobtypes';
	
    protected $guarded = [];	

	protected $fillable = [
		'name',
		'description',
		'occupational_category'
	];
	
	
	
	/**
	 * A jobtype belongs to an industry.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function industry()
	{
		return $this->belongsTo('App\Industry');
	}


}
