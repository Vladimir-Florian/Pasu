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
	public function create()
	{
		$industry = Industry::findOrFail($iid);

		return view('jobtypes.create', compact('industry'));
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
