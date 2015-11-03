<?php namespace App\Http\Controllers;

use App\Jobpost;
use App\Employer;
use App\Jobtype;
use App\Employment_type;
use App\Location;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class JobpostsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int $id 	employer id
	 * @return Response
	 */
	public function index($id)
	{
		$employer = Employer::findOrFail($id);

		//$profiles = Profile::all();
		return view('jobposts.index', compact('employer'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int $id 	employer id
	 * @return Response
	 */
	public function create($id)
	{
		$employer = Employer::findOrFail($id);

		$jobtypes = Jobtype::lists("name", "id"); 
		$employment_types = Employment_type::lists("name", "id"); 
		$locations = Location::lists("postal_code", "id"); 

		return view('jobposts.create', compact('employer', ));


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
