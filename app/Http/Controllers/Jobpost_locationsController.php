<?php namespace App\Http\Controllers;

use App\Location;
use App\Jobpost;
use App\Employer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Jobpost_locationsController extends Controller {

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
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @return Response
	 */
	public function create($id)
	{
		$jobpost = Jobpost::findOrFail($id);
		return view('jobpost_locations.create', compact('jobpost'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @param Request $request
	 * @return Response
	 */
	public function store($id, Request $request)
	{
		$jobpost = Jobpost::findOrFail($id);
		$employer = $jobpost->employer;

		//Location::create($request->all());
		$location = new Location;
		$location->address = $request->input('address');
		$location->postal_code = $request->input('postal_code');
		$location->city = $request->input('city');
		$location->province = $request->input('province');
		$location->country_code = $request->input('country_code');
		$location->latitude = $request->input('latitude');
		$location->longitude = $request->input('longitude');

		$location->save();
		$jobpost->location_id = $location->id;
		$jobpost->save();
		
		return view('jobposts.index', compact('employer'));
		
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
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @return Response
	 */
	public function edit($id)
	{
		$jobpost = Jobpost::findOrFail($id);
		$location = $jobpost->location;
		return view('jobpost_locations.edit', compact('location', 'jobpost'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$jobpost = Jobpost::findOrFail($id);

		//$location = Location::findOrFail($jobpost->location_id);
		$location = $jobpost->location;
		$location->address = $request->input('address');
		$location->postal_code = $request->input('postal_code');
		$location->city = $request->input('city');
		$location->province = $request->input('province');
		$location->country_code = $request->input('country_code');
		$location->latitude = $request->input('latitude');
		$location->longitude = $request->input('longitude');

		$location->save();
		//$jobpost->location_id = $location->id;
		//$jobpost->save();
		
		return view('jobposts.index', compact('employer'));
		
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
