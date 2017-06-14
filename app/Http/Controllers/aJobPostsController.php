<?php namespace App\Http\Controllers;

use App\Jobpost;
use App\Employer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Carbon\Carbon;
use Auth;
use DB;
use App\Profile;


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
	 * Returns a json list of jobposts of the industry of current user.
	 * added 17.05.2017
	 *
	 * @return Response
	 */
	public function foruser()
	{
		$user = Auth::User();
		$id = $user->profile->industry_id;		
		$jobposts = Jobpost::byindustry($id)->get();		
		return response()->json(compact('jobposts'));				
	}


	/**
	 * Returns Job History (marked and applied jobposts) of current profile.
	 * added 12.06.2017
	 *
	 * @return Response
	 */
	public function joblist()
	{
        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
          $markedposts = collect();       
          foreach ($profile->jobposts as $markedjobpost) {
            $line = Jobpost::byjobpostid($markedjobpost->id)->get()->first();
            $markedposts->push($line);
          }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        

        try {
          $appliedposts = collect();       
          foreach ($profile->applied_jobposts as $applied_jobpost) {
            $line = Jobpost::byjobpostid($applied_jobpost->id)->get()->first();
            $appliedposts->push($line);
          }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        


// union $markedposts + $appliedposts


		
		return response()->json(compact('jobposts'));				
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
		$coordinates = [$jobpost->location->latitude, $jobpost->location->longitude];

		$tags = collect();
		foreach ($jobpost->jobtags as $jobtag) {
			$tags->push($jobtag->name);
		}
		
		$jobpost = Jobpost::byjobpostid($id)->first();
		//dd($jobpost->locat);

		return response()->json(compact('jobpost', 'coordinates', 'tags'));		
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
