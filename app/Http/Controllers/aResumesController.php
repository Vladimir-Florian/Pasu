<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Resume;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Tymon\JWTAuth\Facades\JWTAuth;

class aResumesController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}

	/**
	 * Display the resume of the Profile.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		$profile = Profile::findOrFail($id);
		if(!$profile->resume)
			return response()->json(['resume_not_found'], 404);
		else
		{
			$resume = collect([]);
			$resume->push(['id' => $profile->resume, 'cv' => $profile->resume->cv]);
		}
		return response()->json(compact('resume'));		
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
	public function store()
	{
		//
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
