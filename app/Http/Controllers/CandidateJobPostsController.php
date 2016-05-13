<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Industry;
use App\Jobpost;
//use App\Employer;
use DB;

class CandidateJobPostsController extends Controller
{
	
	/**
	 * Display the Job Posts Page.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
    public function index($id)
    {
		//dd($id);
		$profile = Profile::findOrFail($id);
		return view('candidate_jobposts.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	/**
	 * Returns a json list of jobposts of an industry .
	 *
	 * @param  int $id 	profile id
	 * @return Response
	 */
	public function forindustry($id)
	{

		//dd($id);
		$profile = Profile::findOrFail($id);
		$iid =	$profile->industry_id;
		/*
		$jobposts = DB::table('jobposts')
            ->join('employers', 'jobposts.employer_id', '=', 'employers.id')
            ->join('jobtypes', 'jobposts.jobtype_id', '=', 'jobtypes.id')
            ->select('jobposts.id', 'jobposts.jobtitle', 'jobposts.request_date', 'employers.company_name')
			->where('jobtypes.industry_id', '=', $iid)
            ->get();
		*/
		
 		$jobposts = Jobpost::byindustry($iid)->get();
		//return response()->json(compact('jobposts'));						
		return view('candidate_jobposts.forindustry', compact('profile', 'jobposts'));
	}
	


	
}
