<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
  protected $table = 'roles';
	
  protected $guarded = [];	

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
  protected $fillable = [];

    /**
     * The users that belong to the role.
     */
  public function roles()
    {
      return $this->belongsToMany('App\User');
    }
 
}
