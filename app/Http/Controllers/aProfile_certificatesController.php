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
	 * Display a listing of the resource.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		$profile = Profile::findOrFail($id);
		$certificates = $profile->certificates;
		//dd($certificates);
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
		$profile = Profile::findOrFail($id);

		
		$c_id = $request->input('certificate');
		try {
			$profile->certificates()->attach($c_id, ['details' => $request->input('details')]);
		} catch(\Exception $e) {
			return redirect()->route('profile_certificates.create', [$profile])->withErrors(['error' => $e->getMessage()]);
			//return \Response::view('errors.503', [], 404);
			//return redirect()->route('profile_certificates.create', [$profile]);
		}
		
		return view('profile_certificates.index', compact('profile'));
		return response()->json(['success  profile'. $profile->id], 200);
		
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
