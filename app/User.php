<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * A User has one profile
	 *
	 * @return
	 */
	public function profile() {
		return $this->hasOne('App\Profile');
	}

	/**
	 * A User has one employer
	 *
	 * @return
	 */
	public function employer() {
		return $this->hasOne('App\Employer');
	}

	/**
	 * A User has one reg_session
	 *
	 * @return
	 */
	public function reg_session() {
		return $this->hasOne('App\RegSession');
	}


    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
    * Check if user has role $role
    */
    public function hasRole($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == $roleName)
            {
                return true;
            }
        }

        return false;

    }

	 
}
