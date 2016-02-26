<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;



class aSocialController extends Controller {

    /**
     * Login with Facebook.
     */
    public function facebook(Request $request)
    {
		$name = 'facebook';
		if ($request->has('redirectUri')) {
			config()->set("services.{$name}.redirect", $request->get('redirectUri'));
		}

		$provider = Socialite::driver($name);
		$provider->stateless();
		//$fb_profile = $provider->user();

		// Step 1 + 2
        try {
            $fb_user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
			//return redirect('auth/login')->withErrors(['error' => $e->getMessage()]); // http://localhost/pasu/public/auth/login
			return response()->json(["error" => $e->getMessage()], 500);
        }

		// Handle the user etc.
        // Step 3. Create a new user account or return an existing one.
		$authUser = $this->findOrCreateUser($fb_user);
 		$token = JWTAuth::fromUser($auth_user);
		return response()->json(compact('token'));
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
