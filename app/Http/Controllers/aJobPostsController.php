<?php namespace App\Http\Controllers;

use App\Jobpost;
use App\Employer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class aJobPostsController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}

	/**
	 * Returns a json list of jobposts.
	 *
	 * @param  int $id 	job_id
	 * @return Response
	 */
	public function forjobtype($id)
	{
		$jobposts = Jobpost::join('employers', 'jobposts.employer_id', '=', 'employers.id')
					->where('jobtype_id', '=', $id)
					->select('jobposts.request_date', 'employers.company_name')
					->get();
		
		
		return response()->json(compact('jobposts'));				
	}
		

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
