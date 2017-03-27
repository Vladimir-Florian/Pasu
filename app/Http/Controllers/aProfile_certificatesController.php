<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Certificate;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
		
    	try {

			$profile = Profile::findOrFail($id);
   			if(!$profile->certificates->count()) {
            	return response()->json(['error' => 'no certificates entered'], 404);
   			}

			$certificates = $profile->certificates;
			$certs = collect([]);
			foreach($certificates as $certificate){
				$certs->push(['id' => $certificate->id, 'slug' => $certificate->slug,
					'name' => $certificate->name,
				    'description' => $certificate->description, 
					'awarder' => $certificate->pivot->awarder,
					'date_awarded' => $certificate->pivot->date_awarded					
					]);
			}
			//dd(compact('certs'));
			return response()->json(compact('certs'));		

    	} catch(ModelNotFoundException $e) {

            return response()->json(['error' => 'profile does not exist'], 404);

    	}

	}

	/**
	 * Get a listing of all the Certificates for the Industry.
	 *
	 * @param  int $id 	Specialization id
	 * @return Response
	 */
	public function cert_list($id)
	{
		// the token is valid and we have found the user via the sub claim

    	try {

		  $profile = Profile::findOrFail($id);
			//$profile->industry_id;
		  $certificates = Certificate::where('industry_id', '=', $profile->industry_id)
		    ->select('id', 'slug', 'name', 'description')
		    ->get();

		  if(!certificates) {
             return response()->json(['error' => 'Empty List'], 404);
   		  }

		  return response()->json(compact('certificates'));

    	} catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
    	}
	
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
	// the token is valid and we have found the user 

    	try {
		
		  $profile = Profile::findOrFail($id);
		  $c_id = $request->input('cert_id');
		  try {
			  $profile->certificates()->attach($c_id, ['awarder' => $request->input('awarder'), 'date_awarded' => $request->input('date_awarded')]);
		  } catch(\Exception $e) {
			//return response()->json(['Cannot Add Certificate'], $e->getStatusCode());
		    return response()->json(["error" => $e->getMessage()], 404);
  		  }
		
          return response()->json(['success Certificate'. $certificate->id], 200);

	    } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
    	}
	
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
		$certificate->pivot->awarder = $request->input('awarder');
		$certificate->pivot->date_awarded = $request->input('date_awarded');					
		
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
