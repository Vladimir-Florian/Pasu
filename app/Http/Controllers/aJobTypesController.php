<?php namespace App\Http\Controllers;

use App\Jobtype;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class aJobTypesController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}


	/**
	 * Returns a json list of jobtypes.
	 *
	 * @param  int $iid 	industry_id
	 * @return Response
	 */
	public function index($iid)
	{
		$industry = Industry::findOrFail($iid);
		$jobtypes = $industry->jobtypes;
		return response()->json(compact('jobtypes'));		
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
