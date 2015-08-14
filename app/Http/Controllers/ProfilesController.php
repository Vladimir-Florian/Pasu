<?php namespace App\Http\Controllers;

use App\Profile;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProfilesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int $iid 	industry_id
	 * @return Response
	 */
	public function index($iid)
	{
		$industry = Industry::findOrFail($iid);

		//$profiles = Profile::all();
		return view('profiles.index', compact('industry'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int  $iid		industry_id
	 * @return Response
	 */
	public function create($iid)
	{
		$industry = Industry::findOrFail($iid);

		return view('profiles.create', compact('industry'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $iid		industry_id
	 * @param Request $request
	 * @return Response
	 */
	public function store($iid, Request $request)
	{
		$industry = Industry::findOrFail($iid);
		
		$profile = new Profile;
		$profile->name = $request->input('name');
		$profile->phone_no = $request->input('phone_no');
		$profile->birthdate = $request->input('birthdate');
		$profile->experience = $request->input('experience');
		$profile->industry_id = $iid;

		$profile->save();
		//$input = $request->all();
		//$input['industry_id'] = $iid;
		//Profile::create($input);
		
		//return redirect('industries.profiles.show', compact('industry'));
		return view('profiles.index', compact('industry'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		profile_id
	 * @return Response
	 */
	public function show($iid, $id)
	{
		$industry = Industry::findOrFail($iid);
		$profile = Profile::findOrFail($id);
		//dd($iid, $id);
		return view('profiles.show', compact('industry','profile'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		profile_id
	 * @return Response
	 */
	public function edit($iid, $id)
	{
		$industry = Industry::findOrFail($iid);
		$profile = Profile::findOrFail($id);
		return view('profiles.edit', compact('industry', 'profile'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($iid, $id, Request $request)
	{
		$industry = Industry::findOrFail($iid);
		
		$profile = Profile::findOrFail($id);
		$profile->name = $request->input('name');
		$profile->phone_no = $request->input('phone_no');
		$profile->birthdate = $request->input('birthdate');
		$profile->experience = $request->input('experience');
		$profile->industry_id = $iid;

		$profile->save();
		
		//return redirect('industries.profiles.show', compact('industry'));
		return view('profiles.index', compact('industry'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		profile_id
	 * @return Response
	 */
	public function destroy($iid, $id)
	{
		$industry = Industry::findOrFail($iid);
		$profile = Profile::findOrFail($id);
		
		$profile->delete();
		//dd($iid, $id);
		//return redirect('industries.profiles.index', compact('industry'));
		return view('profiles.index', compact('industry'));
	}

}
