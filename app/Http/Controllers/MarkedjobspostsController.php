<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Markedjobpost;
use App\Profile;
use App\Jobpost;
use Carbon\Carbon;
use App\Exceptions\MyQueryExceptReturn;
use App\Exceptions\MyExceptReturn;
use Illuminate\Database\QueryException as QueryException;

class MarkedjobspostsController extends Controller
{

	/**
	 * Display a list of the marked jobposts for the profile id
	 *
	 * @param  int  $id		profile id
	 * @return Response
	 */
	public function index($id)
	{
		//$markedjobposts = Markedjobpost::where('profile_id', $id)->get();
		$profile = Profile::findOrFail($id);
		$markedposts = collect();		
		foreach ($profile->markedjobposts as $markedjobpost) {
			//$jobpost_id = $markedjobpost->jobpost_id;
			$line = Jobpost::byjobpostid($markedjobpost->jobpost_id)->get()->first();
			$markedposts->push($line);
		}		
			
		return view('markedjobposts.index', compact('profile', 'markedposts'));
	}

	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $pid		profile id
	 * @param  int  $jid		jobpost id
	 */
	public function store($pid, $jid)
	{
		$markedjobpost = new Markedjobpost;
		$markedjobpost->profile_id = $pid;
		$markedjobpost->jobpost_id = $jid;
		$markedjobpost->mark_date = Carbon::today();															
			
		try {
			$markedjobpost->save();
		} catch (QueryException $e){
			$errorCode = $e->errorInfo[1];
			throw new MyQueryExceptReturn($errorCode);
		} catch(\Exception $e) {
			throw new MyExceptReturn($e->getMessage());			
		}

		return redirect()->back();
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $pid		profile id
	 * @param  int  $jid		jobpost id
	 * @return Response
	 */
	public function destroy($pid, $jid)
	{
		$markedjobpost = Markedjobpost::where('profile_id', $pid)->where('jobpost_id', $jid)->firstOrFail();
		$markedjobpost->delete();
		return back();
		//return redirect('markedjobposts');
		
	}
	
	
}
