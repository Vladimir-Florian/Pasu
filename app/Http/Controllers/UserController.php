<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;

use Hash;
use App\Industry;
use App\RegSession;
use Illuminate\Support\Facades\DB;

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

		DB::beginTransaction();
		try {
			//$user = User::create($credentials);
			
			$user = User::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password')),
			]);
			
			
		} catch (\Exception $e) {
		    DB::rollback();
        	$error_code = $e->errorInfo[1];
        	if($error_code == 1062){
				return response()->json(['error' => 'Duplicate email'], 409);
			}
			else {
				return response()->json(['error' => 'DB error'], $error_code);										
			}				
		}

		if (!$user->reg_session) {
		  try {
			$reg_session = new RegSession;
			$reg_session->user_id = $user->id;
			$reg_session->name = $request->input('name');
			$reg_session->phone_no = $request->input('phone_no');
			$reg_session->birthdate = $request->input('birthdate');
			//$reg_session->experience = $request->input('experience');
			$user->reg_session()->save($reg_session);
			//$reg_session->save();
		  } catch(\Exception $e) {
		    DB::rollback();
			return response()->json(['error' => 'Cannot open session'], 500);			
		  }
		}
		else {
		    DB::rollback();
			return response()->json(['Register session already started'], 409);						
		}
		DB::commit();

		$token = JWTAuth::fromUser($user);

		//$industries = Industry::all();
		$industries = Industry::select('id', 'slug', 'name')->get();
		return response()->json(compact('token', 'industries'));
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
		/*$this->validate($request, [
			'token' => 'required' 
		]);*/

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
	

