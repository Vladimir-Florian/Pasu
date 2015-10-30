<?php namespace App\Http\Controllers;

use App\Jobtype;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class JobtypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int $iid 	industry_id
	 * @return Response
	 */
	public function index($iid)
	{
		$industry = Industry::findOrFail($iid);

		//$jobtypes = Jobtype::all();
		return view('jobtypes.index', compact('industry'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int $iid 	industry_id
	 * @return Response
	 */
	public function create($iid)
	{
		$industry = Industry::findOrFail($iid);

		return view('jobtypes.create', compact('industry'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $iid		industry_id
	 * @param Request $request
	 * @return Response
	 */
	public function store($iid, Request $request)
	{
		$industry = Industry::findOrFail($iid);
		
		$jobtype = new Jobtype;
		$jobtype->name = $request->input('name');
		$jobtype->description = $request->input('description');
		$jobtype->occupational_category = $request->input('occupational_category');
		$jobtype->industry_id = $iid;

		$jobtype->save();
		//$input = $request->all();
		//$input['industry_id'] = $iid;
		//jobtype::create($input);
		
		return view('jobtypes.index', compact('industry'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		jobtype id
	 * @return Response
	 */
	public function show($id)
	{
		$industry = Industry::findOrFail($iid);
		$jobtype = Jobtype::findOrFail($id);
		//dd($iid, $id);
		return view('jobtypes.show', compact('industry','jobtype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		jobtype_id
	 * @return Response
	 */
	public function edit($iid, $id)
	{
		$industry = Industry::findOrFail($iid);
		$jobtype = Jobtype::findOrFail($id);
		return view('jobtypes.edit', compact('industry', 'jobtype'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		jobtype_id
	 * @return Response
	 */
	public function update($iid, $id, Request $request)
	{
		$industry = Industry::findOrFail($iid);
		
		$jobtype = Jobtype::findOrFail($id);
		$jobtype->name = $request->input('name');
		$jobtype->description = $request->input('description');
		$jobtype->occupational_category = $request->input('occupational_category');
		$jobtype->industry_id = $iid;

		$jobtype->save();
		
		return view('jobtypes.index', compact('industry'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $iid 	industry_id
	 * @param  int  $id		jobtype_id
	 * @return Response
	 */
	public function destroy($iid, $id)
	{
		$industry = Industry::findOrFail($iid);
		$jobtype = Jobtype::findOrFail($id);
		
		$jobtype->delete();
		//dd($iid, $id);
		return view('jobtypes.index', compact('industry'));
	}

}
