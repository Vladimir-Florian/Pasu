<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;

use Hash;

class UserController extends Controller {


	public function __construct()
	{

		$this->middleware('jwt.auth', ['only' => ['AuthenticatedUser', 'logout', 'refreshToken']]);
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
			'password' => bcrypt($request->input('password')),
			]);
			
			
		} catch (\Exception $e) {

            //return response()->json(['error' => 'could_not_create_token'], HttpResponse::HTTP_CONFLICT);		
			return response()->json(['error' => 'User already exists'], HttpResponse::HTTP_CONFLICT);
		}

		$token = JWTAuth::fromUser($user);

		return response()->json(compact('token'));
		//return response()->json($credentials);
		
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(Request $request) {
        
		$credentials = $request->only('email', 'password');
		//$credentials = $request->all();
		
		
		try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }			
		} catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
			
		}

		return response()->json(compact('token'));
		
    }


	/**
	* Log out
	* Invalidate the token, so user cannot use it anymore
	* They have to relogin to get a new token
	* 
	* @param Request $request
	*/
	public function logout(Request $request) {
		$this->validate($request, [
			'token' => 'required' 
		]);

		JWTAuth::invalidate($request->input('token'));
        return response()->json('logged out', 200);
		
	}

	/**
	* Refresh Token
	* Invalidate the token, so user cannot use it anymore
	* and return a new token
	* 
	* @param Request $request
	*/
	public function refreshToken() {

		try {

			if (!$token = JWTAuth::getToken()) {
            return response()->json(['error' => 'Token not provided'], 400);			
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

			return response()->json(['token_absent'], $e->getStatusCode());

		}
		
		/*
		$token = JWTAuth::getToken();
		if(!$token){
			//throw new BadRequestHtttpException('Token not provided');
            return response()->json(['error' => 'Token not provided'], 400);			
		}
		*/
		
		try{
			$token = JWTAuth::refresh($token);
		}catch(TokenInvalidException $e){
			//throw new AccessDeniedHttpException('The token is invalid');
            return response()->json(['error' => 'The token is invalid'], 400);						
		}
		return response()->json(compact('token'));
	}
	
    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePassword(Request $request) {
		/*
		$this->validate($request, [
			'id' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
		]);
		*/
		$id = $request->input('id');

        $user = User::findOrFail($id);
		
		//$user->password = bcrypt($request->input('password'));
		//$user->save();
		
        $user->fill([
            'password' => Hash::make($request->input('password'))
        ])->save();
		
		return response()->json(['success' => 'password changed'], 200);
	}	
	
    /**
     * verify token using the jwt.auth middleware
     * @return Response
     */	
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


    /**
     * Verify token using app\Exceptions\Handler
     * @return Response
     */	
	public function TestedUser() {

		//$user = JWTAuth::parseToken()->authenticate();
		//return response()->json(compact('user'));

		//return response()->json($user);
		//return response()->json($request->all(););

	
		try {

			if(! $user = JWTAuth::parseToken()->toUser()) {
				return response()->json(['token error'], 403);
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


}	
	

