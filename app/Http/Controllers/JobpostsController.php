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
		//$locations = Location::lists("postal_code", "id"); 

		return view('jobposts.create', compact('employer', 'jobtypes', 'employment_types'));


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $id		employer id
	 * @param Request $request
	 * @return Response
	 */
	public function store($id, Request $request)
	{
		$employer = Employer::findOrFail($id);
		
		$jobpost = new Jobpost;
		$jobpost->jobtype_id = $request->input('jobtype');
		$jobpost->employment_type_id = $request->input('employment_type');
		$jobpost->experience = $request->input('experience');
		$jobpost->education = $request->input('education');
		$jobpost->benefits = $request->input('benefits');
		$jobpost->incentives = $request->input('incentives');
		$jobpost->responsabilities = $request->input('responsabilities');
		$jobpost->salary = $request->input('salary');
		$jobpost->currency = $request->input('currency');
		$jobpost->workhours = $request->input('workhours');
		$jobpost->request_date = $request->input('request_date');

		$jobpost->employer_id = $id;
		$jobpost->save();
		return view('jobposts.index', compact('employer'));		

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @return Response
	 */
	public function show($eid, $id)
	{
		$employer = Employer::findOrFail($eid);
		$jobpost = Jobpost::findOrFail($id);
		return view('jobposts.show', compact('employer','jobpost'));

		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @return Response
	 */
	public function edit($eid, $id)
	{
		$employer = Employer::findOrFail($eid);
		$jobpost = Jobpost::findOrFail($id);
		$jobtypes = Jobtype::lists("name", "id"); 
		$employment_types = Employment_type::lists("name", "id"); 
		return view('jobposts.edit', compact('employer', 'jobpost', 'jobtypes', 'employment_types'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @return Response
	 */
	public function update($eid, $id, Request $request)
	{
		$employer = Employer::findOrFail($eid);
		$jobpost = Jobpost::findOrFail($id);

		$jobpost->jobtype_id = $request->input('jobtype');
		$jobpost->employment_type_id = $request->input('employment_type');
		$jobpost->experience = $request->input('experience');
		$jobpost->education = $request->input('education');
		$jobpost->benefits = $request->input('benefits');
		$jobpost->incentives = $request->input('incentives');
		$jobpost->responsabilities = $request->input('responsabilities');
		$jobpost->salary = $request->input('salary');
		$jobpost->currency = $request->input('currency');
		$jobpost->workhours = $request->input('workhours');
		$jobpost->request_date = $request->input('request_date');

		//$jobpost->employer_id = $eid;
		$jobpost->save();
		return view('jobposts.index', compact('employer'));		
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $eid 	employer_id
	 * @param  int  $id		jobpost_id
	 * @return Response
	 */
	public function destroy($eid, $id)
	{
		$employer = Employer::findOrFail($eid);
		$jobpost = Jobpost::findOrFail($id);

		$jobpost->delete();
		return view('jobposts.index', compact('employer'));		
	 
	}

}
