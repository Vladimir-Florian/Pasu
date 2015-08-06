<?php namespace App\Http\Controllers;

use App\Profile;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class EmployeeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		//$profile = new Profile;
		//dd($profile->user_id);
		//dd($user->profile->user_id);
		try {
			$id = $user->profile->user_id;
		} catch(\Exception $e) {
			return redirect('employees/create');
		}
		$profile = $user->profile;
		//dd($profile->name);
		//return view('employees.show', compact('profile'));
		return view('employees.index', compact('profile'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$industries = Industry::lists("slug", "id"); 
		return view('employees.create', compact('industries'));
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$profile = new Profile;
		$profile->user_id = Auth::user()->id;
		$profile->name = $request->input('name');
		$profile->phone_no = $request->input('phone_no');
		$profile->birthdate = $request->input('birthdate');
		$profile->experience = $request->input('experience');
		$profile->industry_id = $request->input('specialization');

		$profile->save();
		return view('employees.index', compact('profile'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$profile = Profile::findOrFail($id);
		return view('employees.show', compact('profile'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$profile = Profile::findOrFail($id);
		return view('employees.edit', compact('profile'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$profile = Profile::findOrFail($id);
		$profile->name = $request->input('name');
		$profile->phone_no = $request->input('phone_no');
		$profile->birthdate = $request->input('birthdate');
		$profile->experience = $request->input('experience');
		//$profile->industry_id = $iid; pentru update industry_id se sterge si se creaza nou profil

		$profile->save();
		
		return view('employees.index', compact('profile'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$profile = Profile::findOrFail($id);
		$profile->delete();
		//return view('employees.index', compact('profile'));
		return redirect('/');
	}

}
