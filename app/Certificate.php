<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'certificates';
	
    protected $guarded = [];

	protected $fillable = [
		'slug',
		'name',
		'description'
	];


	/**
	 *  Get the profiles associated with the certificate.
	 *  
	 *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('App\Profile');
	}


	/**
	 * A certificate belongs to an industry.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function industry()
	{
		return $this->belongsTo('App\Industry');
	}


}
