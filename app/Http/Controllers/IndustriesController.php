<?php namespace App\Http\Controllers;

use App\Industry;
use App\Http\Requests;
use App\Http\Requests\IndustryRequest;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//use Request;

class IndustriesController extends Controller {

	/**
	 * Show all industries with the new one on top
	 *
	 * @return Response
	 */
	public function index()
	{
		//$industries = Industry::latest()->get();
		$industries = Industry::all();
		
		return view('industries.index', compact('industries'));
		//return response()->json($industries);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('industries.create');
	}

	/**
	 * Store a new industry.
	 *
	 * @param IndustryRequest $request
	 * @return Response
	 */
	public function store(IndustryRequest $request)
	{
		//$input = Request::all();
		
		Industry::create($request->all());
		return redirect('industries');
		//return redirect('industries')->with('message', 'Specialization created');
		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$industry = Industry::findOrFail($id);
		
		return view('industries.show', compact('industry'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$industry = Industry::findoOrFail($id);
		return view('industries.edit', compact('industry'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, IndustryRequest $request)
	{
		$industry = Industry::findorfail($id);
		
		$industry->update($request->all());
		
		return redirect('industries');
		//return Redirect::route('industries.show', $industry->id)->with('message', 'Specialization updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$industry = Industry::findorfail($id);
		
		$industry->delete();
		
		return redirect('industries');
		//return Redirect::route('industries.index')->with('message', 'Specialization deleted.');

	}

}
