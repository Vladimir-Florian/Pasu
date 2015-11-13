<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Jobpost;
use App\Jobtag;

class Jobpost_jobtagsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int $id 	jobpost id
	 * @return Response
	 */
	public function index($id)
	{
		$jobpost = Jobpost::findOrFail($id);
		//dd($profile->locations);
		return view('jobpost_jobtags.index', compact('jobpost'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int $id 	jobpost id
	 * @return Response
	 */
	public function create($id)
	{
		$jobpost = Jobpost::findOrFail($id);
		$fields = Jobtag::lists("name", "id"); 

		return view('jobpost_jobtags.create', compact('jobpost', 'fields'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int $id 	jobpost id
	 * @param Request $request
	 * @return Response
	 */
	public function store($id, Request $request)
	{
		$jobpost = Jobpost::findOrFail($id);

		$t_id = $request->input('tag');
		try {
			$jobpost->jobtags()->attach($t_id);
		} catch(\Exception $e) {
			return redirect()->route('jobpost_jobtags.create', [$jobpost])->withErrors(['error' => $e->getMessage()]);
		}
		
		return view('jobpost_jobtags.index', compact('jobpost'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $iid	jobpost id
	 * @param  int  $id		jobtag id
	 * @return Response
	 */
	public function show($iid, $id)
	{
		$jobpost = Jobpost::findOrFail($iid);
		$jobtag = $jobpost->jobtags()->where('id', $id)->first();
		return view('jobpost_jobtags.show', compact('jobpost', 'jobtag'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $iid	jobpost id
	 * @param  int  $id		jobtag id
	 * @return Response
	 */
	public function edit($iid, $id)
	{
		$jobpost = 	Jobpost::findOrFail($iid);
		$jobtag = 	$jobpost->jobtags()->where('id', $id)->first();
		$fields = 	Jobtag::lists("name", "id"); 

		return view('jobpost_jobtags.edit', compact('jobpost', 'jobtag', 'fields'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $iid	jobpost id
	 * @param  int  $id		jobtag id
	 * @param Request $request
	 * @return Response
	 */
	public function update($iid, $id, Request $request)
	{
		$jobpost = Jobpost::findOrFail($iid);
		$jobtag = $jobpost->jobtags()->where('id', $id)->first();
		$jobpost->jobtags()->detach($jobtag);

		$t_id = $request->input('tag');
		try {
			$jobpost->jobtags()->attach($t_id);
		} catch(\Exception $e) {
			return redirect()->route('jobpost_jobtags.create', [$jobpost])->withErrors(['error' => $e->getMessage()]);
		}
		
		return view('jobpost_jobtags.index', compact('jobpost'));
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $iid	jobpost id
	 * @param  int  $id		jobtag id
	 * @return Response
	 */
	public function destroy($iid, $id)
	{
		$jobpost = Jobpost::findOrFail($iid);
		$jobtag = $jobpost->jobtags()->where('id', $id)->first();
		$jobpost->jobtags()->detach($jobtag);

		return view('jobpost_jobtags.index', compact('jobpost'));
		
	}

}
