<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
//use App\Contracts\UserRepository;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Hashing\Hasher;

use App\User;
use Illuminate\Http\Request;


class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	| This controller handles the registration of new Ajax users, as well as the
	| authentication of existing users. 
	*/

	
	/**
	 * The Guard implementation.
	 * @var Guard
	 */
	protected $auth;
	protected $validator;
	//protected $users;
	protected $hasher;	
	
//	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, ValidationFactory $validator, Hasher $hasher)
	{
		$this->auth = $auth;
		$this->validator = $validator;
		//$this->users = $users;
		$this->hasher = $hasher;
		//$this->registrar = $registrar;

		//$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function validator(array $data)
	{
		return Validator::make($data, [
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
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => $this->hasher->make($data['password']),
			//'password' => bcrypt($data['password']),
		]);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function Register(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		try {
			$user = create($request->all());
		} catch (Exception $e) {
			return Response::json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
		}

		$token = JWTAuth::fromUser($user);

		return Response::json(compact('token'));		
	}	
	
	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function Login(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ( ! $token = JWTAuth::attempt($credentials)) {
			return Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
		}

		return Response::json(compact('token'));
	}

	
}
	
	
}
