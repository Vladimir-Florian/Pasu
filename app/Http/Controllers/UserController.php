<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
//use DB;

class UserController extends Controller {


	public function __construct()
	{

		$this->middleware('jwt.auth', ['only' => 'AuthenticatedUser']);
	}


    /**
     * Register a user
     * @return Response
     */
    public function register(Request $request) {
        //$credentials = $request->all();
		//$credentials = $request->only('name', 'email', 'password');

		try {
			//$user = User::create($credentials);
			
			$user = User::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('name')),
			]);
			
			
		} catch (Exception $e) {
			return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
		}

		$token = JWTAuth::fromUser($user);

		return response()->json(compact('token'));
		//return response()->json($credentials);
		
    }

	    /**
     * Login a user
     * @return Response
     */
    public function login(Request $request, User $user) {
        
		$credentials = $request->only('email', 'password');
		//$credentials = $request->all();
	
		$query = $user->newQuery();

		foreach ($credentials as $key => $value)
		{
			 $query->where($key, $value);
		}

				//return $query->first();
		try {
			//$token = JWTAuth::attempt($credentials);
			$user = $query->first();
		} catch (Exception $e) {
			return response()->json(['error' => 'invalid_credentials'], 401);
		}

		$token = JWTAuth::fromUser($user);
	
/*		
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
*/
		
		return response()->json(compact('token'));
		
    }


	public function AuthenticatedUser() {

		//$user = JWTAuth::parseToken()->authenticate();
		//return response()->json(compact('user'));

		//return response()->json($user);
		//return response()->json($request->all(););

	
		try {

			if (! $user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

			return response()->json(['token_absent'], $e->getStatusCode());

		}

    // the token is valid and we have found the user via the sub claim
		return response()->json(compact('user'));
		
	}	

	public function TestedUser() {

		//$user = JWTAuth::parseToken()->authenticate();
		//return response()->json(compact('user'));

		//return response()->json($user);
		//return response()->json($request->all(););

	
		try {

			$user = JWTAuth::parseToken()->toUser();
			/*if (! $user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}*/

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

			return response()->json(['token_absent'], $e->getStatusCode());

		}

    // the token is valid and we have found the user via the sub claim
		return response()->json(compact('user'));
		
	}	

	
}
