<?php namespace App\Http\Controllers;

use App\Employment_type;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Employment_typesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$employment_types = Employment_type::all();
		
		return view('employment_types.index', compact('employment_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('employment_types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$input = Request::all();
		
		Employment_type::create($request->all());
		//return redirect('employment_types');
		return redirect('employment_types')->with('message', 'Employment Type created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$employment_type = Employment_type::findOrFail($id);
		return view('employment_types.show', compact('employment_type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employment_type = Employment_type::findOrFail($id);
		return view('employment_types.edit', compact('employment_type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$employment_type = Employment_type::findOrFail($id);
		$employment_type->update($request->all());
		//return redirect('employment_types');
		return redirect('employment_types')->with('message', 'Employment Type updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$employment_type = Employment_type::findOrFail($id);
		$employment_type->delete();
		//return redirect('employment_types');
		return redirect('employment_types')->with('message', 'Employment Type deleted');
	}

}
