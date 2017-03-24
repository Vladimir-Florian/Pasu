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
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function create($id)
	{
		$profile = Profile::findOrFail($id);
		//$fields = Certificate::lists("name", "id"); 
		$fields = Certificate::select('name', 'id')
                           ->where('industry_id', '=', $profile->industry_id)
                           ->get(); 
        $fields = $fields->pluck('name', 'id');
		return view('profile_certificates.create', compact('profile', 'fields'));
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

		/*
		$certificate = $profile->certificates()->where('id', $id)->first();
		//dd($request->input('details'));
		$certificate->pivot->certificate_id = $request->input('certificate');
		$certificate->pivot->details = $request->input('details');
		*/
		
		$c_id = $request->input('certificate');
		try {
			$profile->certificates()->attach($c_id, ['awarder' => $request->input('awarder'), 'date_awarded' => $request->input('date_awarded')]);
		} catch(\Exception $e) {
			return redirect()->route('profile_certificates.create', [$profile])->withErrors(['error' => $e->getMessage()]);
			//return \Response::view('errors.503', [], 404);
			//return redirect()->route('profile_certificates.create', [$profile]);
		}
		
		return view('profile_certificates.index', compact('profile'));
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $iid	profile_id
	 * @param  int  $id		certificate_id
	 * @return Response
	 */
	public function show($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$certificate = $profile->certificates()->where('id', $id)->first();
		return view('profile_certificates.show', compact('profile', 'certificate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id	profile_id
	 * @param  int  $id		certificate_id
	 * @return Response
	 */
	public function edit($iid, $id)
	{
		$profile = Profile::findOrFail($iid);
		$certificate = $profile->certificates()->where('id', $id)->first();
		//$fields = [];
		//foreach ($profile->certificates as $certificate)
		//{
			//$fields[$certificate->id] = $certificate->slug;
		//}
		//$fields = Certificate::lists("slug", "id"); 

		//return view('profile_certificates.edit', compact('fields','profile', 'certificate'));
		return view('profile_certificates.edit', compact('profile', 'certificate'));

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
		//$profile->certificates()->save($certificate);
		return view('profile_certificates.index', compact('profile'));
		
		
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
		$profile->certificates()->detach($certificate);

		return view('profile_certificates.index', compact('profile'));
		
	}

}
