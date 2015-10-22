<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employment_type extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employment_types';
	
    protected $guarded = [];	

	protected $fillable = [ 'name' ];

	/**
	 * An employment_type has many jobposts
	 *
	 * @return
	 */
	public function jobposts() {
		return $this->hasMany('App\Jobpost');
	}
	
	
}
