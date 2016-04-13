<?php namespace App\Http\Controllers;

use App\Jobpost;
use App\Employer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Carbon\Carbon;

class aJobPostsController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}

	
	/**
	 * Returns a json list of jobposts of an industry .
	 *
	 * @param  int $id 	industry_id
	 * @return Response
	 */
	public function forindustry($id)
	{
		$jobposts = Jobpost::byindustry($id)->get();
		
		return response()->json(compact('jobposts'));				
	}
	
	
	/**
	 * Returns a json list of jobposts of jobtype.
	 *
	 * @param  int $id 	jobtype_id
	 * @return Response
	 */
	public function forjobtype($id)
	{
		/*
		$jobposts = Jobpost::join('employers', 'jobposts.employer_id', '=', 'employers.id')
					->where('jobtype_id', '=', $id)
					->select('jobposts.request_date', 'employers.company_name')
					->get();
		*/
		$jobposts = Jobpost::byjobtype($id)->get();
		
		return response()->json(compact('jobposts'));				
	}

	/**
	 * Returns a json list of jobposts newer than 10 days.
	 *
	 * @param  int $id 	jobtype_id
	 * @return Response
	 */
	public function time10($id)
	{

		//$q->whereDate('created_at', '=', date('Y-m-d'));
		//$q->whereDay('created_at', '=', date('d'));
		//$q->whereMonth('created_at', '=', date('m'));
		/*		
		$current = Carbon::today();																
		$tenth_day = $current->subDays(10);
		$jobposts = Jobpost::where('jobtype_id', '=', $id)
					->whereDay('request_date', '>=', $tenth_day)		
					->select('id',
							 'experience',
							 'education',
							 'benefits',
							 'incentives',
							 'responsabilities',
							 'salary',
							 'currency',
							 'workhours',
							 'request_date')
					->get();
		*/			
		$jobposts = Jobpost::within10days($id)->get();
		
		return response()->json(compact('jobposts'));				
	}

	
	/**
	 * Returns a json list of jobposts within radius.
	 *
	 * @param  int $id 	jobtype_id
	 * @param Request $request
	 * @return Response
	 */
	public function withinradius($id, Request $request)
	{
		$latitude = $request->input('latitude');
		$longitude = $request->input('longitude');
		$radius = 5;
		$selposts = Jobpost::with(['locations' => function($query) use ($latitude, $longitude, $radius) {
								$query->selectRaw('( 6371 * acos( cos( radians(?) ) *
													cos( radians( latitude ) )
													* cos( radians( longitude ) - radians(?)
													) + sin( radians(?) ) *
													sin( radians( latitude ) ) )
													) AS distance', [$latitude, $longitude, $latitude])
									  ->havingRaw("distance < ?", [$radius]);
					}])
					->where('jobtype_id', '=', $id)
					->select('id',
							 'experience',
							 'education',
							 'benefits',
							 'incentives',
							 'responsabilities',
							 'salary',
							 'currency',
							 'workhours',
							 'request_date')

					->get();					
		
		return response()->json(compact('selposts'));				
	}

		
	/**
	 * Display a listing of the resource.
	 *
	 * @param  int  $id
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
	 * @param  int  $id jobpost id
	 * @return Response
	 */
	public function show($id)
	{
		$jobpost = Jobpost::findOrFail($id);
		return response()->json(compact('jobpost'));		
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
