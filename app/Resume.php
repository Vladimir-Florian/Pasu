<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resumes';
	
    protected $guarded = [];	

	protected $fillable = [	'file_path', 'cv' ];
	

	/**
	 * A resume belongs to a profile.
	 *
	 * @return \IlluminateDatabase\Eloquent\Relations\BelongsTo
	 */

	public function profile()
	{
		return $this->belongsTo('App\Profile');
	}

}
