<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User;
use Auth;
use Socialite;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	protected $redirectPath = '/';
	
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
		
	}

	/**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
		//dd('facebook');
        return Socialite::driver('facebook')->redirect();
    }
 
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
		//dd('fom FB');
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
			//dd($e);
			return redirect('auth/login')->withErrors(['error' => $e->getMessage()]); // http://localhost/pasu/public/auth/login
			//return redirect('auth/login')->with('errors', 'Socialite Error!'); // http://localhost/pasu/public/auth/login
			//return response()->json(["error" => $e->getMessage()], 500);
        }
		
		//dd($user);
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect()->route('home');
		
    }
 
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('email', $facebookUser->email)->first();
 
        if ($authUser){
            return $authUser;
        }
 
        return User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email
        ]);
    }
	
}
