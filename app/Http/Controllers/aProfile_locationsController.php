<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Location;

class aProfile_locationsController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}


	/**
	 * Get a listing of the Locations for Profile.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		$profile = Profile::findOrFail($id);
		//dd($profile->locations);
		$locations = $profile->locations;
		$locs = collect([]);
		foreach($locations as $location){
			$locs->push(['id' => $location->id, 
						'latitude' => $location->latitude, 
						'longitude' => $location->longitude, 
						'location_type' => $location->pivot->location_type, 
						'start_date' => $location->pivot->start_date, 
						'end_date' => $location->pivot->end_date]);
		}
		
		//dd(compact('locs'));
		return response()->json(compact('locs'));		
		
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

		$location = new Location;
		//$location->address = $request->input('address');
		//$location->postal_code = $request->input('postal_code');
		//$location->city = $request->input('city');
		//$location->province = $request->input('province');
		//$location->country_code = $request->input('country_code');
		$location->latitude = $request->input('latitude');
		$location->longitude = $request->input('longitude');

		try {
			$location->save();
		} catch(\Exception $e) {
		    return response()->json(["error" => $e->getCode()], 500);
		}
		
		try {
			$profile->locations()->attach($location, ['location_type' => $request->input('location_type'),
													  'start_date' => $request->input('start_date'),
													  'end_date' => $request->input('end_date')
													 ]);
		} catch(\Exception $e) {
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
	 * @param  int  $id		location_id
	 * @param Request $request
	 * @return Response
	 */
	public function update($iid, $id, Request $request)
	{
		$profile = Profile::findOrFail($iid);
		$location = $profile->locations()->where('id', $id)->first();
		//$location->address = $request->input('address');
		//$location->postal_code = $request->input('postal_code');
		//$location->city = $request->input('city');
		//$location->province = $request->input('province');
		//$location->country_code = $request->input('country_code');
		$location->latitude = $request->input('latitude');
		$location->longitude = $request->input('longitude');
		
		$location->pivot->location_type = $request->input('location_type');
		$location->pivot->start_date = $request->input('start_date');
		$location->pivot->end_date = $request->input('end_date');

		try {
			$location->save();
		} catch(\Exception $e) {
		    return response()->json(["error" => $e->getCode()], 500);
		}

		
		try {
			$location->pivot->save();
		} catch(\Exception $e) {
		    return response()->json(["error" => $e->getCode()], 500);
		}
		
		return response()->json(['success profile'. $profile->id], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $iid		profile_id
	 * @param  int  $id			location_id
	 * @return Response
	 */
	public function destroy($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$location = $profile->locations()->where('id', $id)->first();
		$profile->locations()->detach($location);
		$location->delete();

		return response()->json(['success profile'. $profile->id], 200);
	}

}
