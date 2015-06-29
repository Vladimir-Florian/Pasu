<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';
	
    protected $guarded = [];	

	protected $fillable = [
		'name',
		'phone_no',
		'birthdate',
		'experience'
	];
	
	
	/**
	 * A profile belongs to an industry.
	 *
	 * @return 
	 */

	public function industry(){
		return $this->belongsTo('App\Industry');
	}
	
}
