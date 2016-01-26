<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Certificate;
use Tymon\JWTAuth\Facades\JWTAuth;

class aProfile_certificatesController extends Controller {
	
	public function __construct()
	{

		$this->middleware('jwt.auth');
	}


	/**
	 * Get a listing of the Certificates for Profile.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		$profile = Profile::findOrFail($id);
		$certificates = $profile->certificates;
		$certs = collect([]);
		foreach($certificates as $certificate){
			$certs->push(['id' => $certificate->id, 'slug' => $certificate->slug, 'description' => $certificate->description, 'details' => $certificate->pivot->details]);
		}
		//dd(compact('certs'));
		return response()->json(compact('certs'));		
	}

	/**
	 * Get a listing of the Certificates for Profile.
	 *
	 * @return Response
	 */
	public function cert_list()
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
		// the token is valid and we have found the user via the sub claim

		$certificates = Certificate::select('id', 'slug', 'description')->get();
		return response()->json(compact('certificates'));
	
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
	 * @param  int $id 	profile_id
	 * @param Request $request
	 * @return Response
	 */
	public function store($id, Request $request)
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
		
		$profile = Profile::findOrFail($id);

		$c_id = $request->input('cert_id');
		try {
			$profile->certificates()->attach($c_id, ['details' => $request->input('details')]);
		} catch(\Exception $e) {
			//return response()->json(['Cannot Add Certificate'], $e->getStatusCode());
		    //return response()->json(["error" => $e->getMessage()], 500);
		    return response()->json(["error" => $e->getCode()], 500);
			
		}
		
		return response()->json(['success profile'. $profile->id], 200);
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	 * @param  int  $iid		profile_id
	 * @param  int  $id		certificate_id
	 * @param Request $request
	 * @return Response
	 */
	public function update($iid, $id, Request $request)
	{
		$profile = Profile::findOrFail($iid);
		$certificate = $profile->certificates()->where('id', $id)->first();
		//dd($request->input('details'));
		//$certificate->pivot->certificate_id = $request->input('certificate');
		$certificate->pivot->details = $request->input('details');
		
		$certificate->pivot->save();
		return response()->json(['success profile'. $profile->id], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $iid		profile_id
	 * @param  int  $id		certificate_id
	 * @return Response
	 */
	public function destroy($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$certificate = $profile->certificates()->where('id', $id)->first();
		try {
			$profile->certificates()->detach($certificate);
		} catch(\Exception $e) {
			return response()->json(['Cannot Delete Certificate'], $e->getStatusCode());
			
		}
		
		return response()->json(['success profile'. $profile->id], 200);		
	}

}
