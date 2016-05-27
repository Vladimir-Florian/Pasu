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
	 * Display a listing of the resource.
	 *
	 * @param  int  $id		profile id
	 * @return Response
	 */
	public function index($id)
	{
		$markedjobposts = Markedjobpost::all();
		
		//return view('locations.index', compact('locations'));
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

		return back();
		
	}
	
	
}
