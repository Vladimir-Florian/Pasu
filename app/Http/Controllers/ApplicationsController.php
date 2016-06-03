<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Application;
use App\Profile;
use App\Jobpost;
use Carbon\Carbon;
use App\Exceptions\MyQueryExceptReturn;
use App\Exceptions\MyExceptReturn;
use Illuminate\Database\QueryException as QueryException;


class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
	 * @param  int  $id		profile id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
		$profile = Profile::findOrFail($id);
		$applications = collect();		
		foreach ($profile->applications as $application) {
			//$jobpost_id = $markedjobpost->jobpost_id;
			$line = Jobpost::byjobpostid($application->jobpost_id)->get()->first();
			$applications->push($line);
		}		
			
		return view('applications.index', compact('profile', 'applications'));
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
	 * @param  int  $pid		profile id
	 * @param  int  $jid		jobpost id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($pid, $jid)
    {
		$application = new Application;
		$application->profile_id = $pid;
		$application->jobpost_id = $jid;
		$application->app_date = Carbon::today();															
			
		try {
			$application->save();
		} catch (QueryException $e){
			$errorCode = $e->errorInfo[1];
			throw new MyQueryExceptReturn($errorCode);
		} catch(\Exception $e) {
			throw new MyExceptReturn($e->getMessage());			
		}

		return redirect()->back();    }

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
	 * @param  int  $pid		profile id
	 * @param  int  $jid		jobpost id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$application = Application::where('profile_id', $pid)->where('jobpost_id', $jid)->firstOrFail();
		$application->delete();
		return back();
    }
}
