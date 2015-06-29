<?php namespace App\Services;

use App\Contracts\UserRepository;
use App\User;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class Registrar implements RegistrarContract {

    /**
     * The validation factory implementation.
     *
     * @var ValidationFactory
     */
    protected $validator;

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * The hasher implementation.
     *
     * @var HasherContract
     */
    protected $hasher;

    /**
     * Create a new registrar instance.
     *
     * @param  ValidationFactory  $validator
     * @param  UserRepository     $users
     * @param  HasherContract     $hasher
     */
    public function __construct(ValidationFactory $validator, UserRepository $users, HasherContract $hasher)
    {
        $this->validator = $validator;
        $this->users = $users;
        $this->hasher = $hasher;
    }

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return Validator
	 */
	public function validator(array $data)
	{
		return $this->validator->make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return $this->users->create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => $this->hasher->make($data['password']),
		]);
	}

}