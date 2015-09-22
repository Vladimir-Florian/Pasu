<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Location;

class Profile_locations extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		$profile = Profile::findOrFail($id);
		//dd($profile->locations);
		return view('profile_locations.index', compact('profile'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function create($id)
	{
		$profile = Profile::findOrFail($id);
		return view('profile_locations.create', compact('profile'));
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
		$location->address = $request->input('address');
		$location->postal_code = $request->input('postal_code');
		$location->city = $request->input('city');
		$location->province = $request->input('province');
		$location->country_code = $request->input('country_code');
		$location->latitude = $request->input('latitude');
		$location->longitude = $request->input('longitude');

		
		try {
			//$profile->locations()->save($location);
			$location->save();
		} catch(\Exception $e) {
			return redirect()->route('profile_locations.create', [$profile])->withErrors(['error' => $e->getMessage()]);
		}

		
		try {
			$profile->locations()->attach($location, ['location_type' => $request->input('location_type'),
													  'start_date' => $request->input('start_date'),
													  'end_date' => $request->input('end_date')
													 ]);
		} catch(\Exception $e) {
			return redirect()->route('profile_locations.create', [$profile])->withErrors(['error' => $e->getMessage()]);
		}
		
		return view('profile_locations.index', compact('profile'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $iid	profile_id
	 * @param  int  $id		location_id
	 * @return Response
	 */
	public function show($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$location = $profile->locations()->where('id', $id)->first();
		return view('profile_locations.show', compact('profile', 'location'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $iid	profile_id
	 * @param  int  $id		location_id
	 * @return Response
	 */
	public function edit($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$location = $profile->locations()->where('id', $id)->first();
		return view('profile_locations.edit', compact('profile', 'location'));
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
		$location->address = $request->input('address');
		$location->postal_code = $request->input('postal_code');
		$location->city = $request->input('city');
		$location->province = $request->input('province');
		$location->country_code = $request->input('country_code');
		$location->latitude = $request->input('latitude');
		$location->longitude = $request->input('longitude');
		
		$location->pivot->location_type = $request->input('location_type');
		$location->pivot->start_date = $request->input('start_date');
		$location->pivot->end_date = $request->input('end_date');

		try {
			//$profile->locations()->save($location);
			$location->save();
		} catch(\Exception $e) {
			return redirect()->route('profile_locations.create', [$profile])->withErrors(['error' => $e->getMessage()]);
		}

		
		try {
			$location->pivot->save();
		} catch(\Exception $e) {
			return redirect()->route('profile_locations.create', [$profile])->withErrors(['error' => $e->getMessage()]);
		}
		
		return view('profile_locations.index', compact('profile'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $iid		profile_id
	 * @param  int  $id		location_id
	 * @return Response
	 */
	public function destroy($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$location = $profile->locations()->where('id', $id)->first();
		$profile->locations()->detach($location);
		$location->delete();

		return view('profile_locations.index', compact('profile'));
	}

}
