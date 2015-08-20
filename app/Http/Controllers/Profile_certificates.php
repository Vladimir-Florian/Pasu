<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Certificate;


class Profile_certificates extends Controller {

	/**
	 * Display all certificates of the profile
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		$profile = Profile::findOrFail($id);
		return view('profile_certificates.index', compact('profile'));
		
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
	 * @param  int  $id	profile_id
	 * @return Response
	 */
	public function show($id)
	{
		$profile = Profile::findOrFail($id);
		return view('profile_certificates.show', compact('profile'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id	profile_id
	 * @return Response
	 */
	public function edit($id)
	{
		//$industries = Industry::lists("slug", "id"); 
		$profile = Profile::findOrFail($id);
		$fields = [];
		foreach ($profile->certificates as $certificate)
		{
			$fields[$certificate->id] = $certificate->slug;
		}
		return view('profile_certificates.edit', compact('fields','profile'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id	profile_id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$profile = Profile::findOrFail($id);
		foreach ($profile->certificates as $certificate)
		{
			//dd($certificate->pivot->details);
			//$certificate->pivot->certificate->id = $request->input('certificate'.$certificate->id);
			$certificate->pivot->details = $request->input('details'.$certificate->id);
		}
		
		$certificate->pivot->save();
		
		return view('profile_certificates.index', compact('profile'));
		
		
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
