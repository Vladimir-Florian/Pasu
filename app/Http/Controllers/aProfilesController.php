<?php namespace App\Http\Controllers;

use App\Profile;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;

class aProfilesController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	/* replaced 06.04.2016
	 public function store(Request $request)
	{
		//dd($request);
		
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
		// the token is valid and we have found the user 
		//dd($request->all());
		try {
			$id = $user->profile->user_id;
			return response()->json(['Profile already exists'], 409);			
		} catch(\Exception $e) {
			$profile = new Profile;
			$profile->user_id = $user->id;
			$profile->name = $request->input('name');
			$profile->phone_no = $request->input('phone_no');
			$profile->birthdate = $request->input('birthdate');
			$profile->experience = $request->input('experience');
			$profile->industry_id = $request->input('spec_id');
			$profile->save();

			//return response()->json($profile->id);	
			return response()->json(['success  profile'. $profile->id], 200);
			
		}
		
	}*/

	/**
	 * Register: Create and Store a User and a profile.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
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
		// the token is valid and we have found the user 
		//dd($request->all());
		
		try {
			$id = $user->profile->user_id;
			return response()->json(['Profile already exists'], 409);			
		} catch(\Exception $e) {
			$profile = new Profile;
			$profile->user_id = $user->id;
			$profile->name = $request->input('name');
			$profile->phone_no = $request->input('phone_no');
			$profile->birthdate = $request->input('birthdate');
			//$profile->experience = $request->input('experience');
			//$profile->industry_id = $request->input('spec_id');
			$profile->save();

			//return response()->json(['success  profile'. $profile->id], 200);
			return response()->json([compact('token')]);
			
		}
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function show(Request $request)
	{
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
		// the token is valid and we have found the user 
		//dd($request->all());
		$profile = Profile::byuser_id($user->id)->get()->first();
		return response()->json(compact('profile'));		
 
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		//dd($request);
		
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
		// the token is valid and we have found the user 
		//dd($request->all());
			$profile = Profile::byuser_id($user->id)->get()->first();
			//$profile->user_id = $user->id;
			$profile->name = $request->input('name');
			$profile->phone_no = $request->input('phone_no');
			$profile->birthdate = $request->input('birthdate');
			$profile->experience = $request->input('experience');
			$profile->industry_id = $request->input('spec_id');
			$profile->save();

			//return response()->json($profile->id);	
			return response()->json(['success  profile'. $profile->id], 200);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
