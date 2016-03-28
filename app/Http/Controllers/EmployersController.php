<?php namespace App\Http\Controllers;

use App\Employer;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class EmployersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		try {
			$id = $user->employer->user_id;
		} catch(\Exception $e) {
			return redirect('employers/create');
		}
		$employer = $user->employer;
		return view('employers.index', compact('employer'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$industries = Industry::lists("slug", "id");
		dd($industries);
		return view('employers.create', compact('industries'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 *	Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$employer = new Employer;
		$employer->user_id = Auth::user()->id;
		$employer->company_name = $request->input('company_name');
		$employer->phone_no = $request->input('phone_no');
		$employer->company_j = $request->input('company_j');
		$employer->company_cui = $request->input('company_cui');
		$employer->company_account = $request->input('company_account');		
		$employer->industry_id = $request->input('industry');

		$employer->save();
		return view('employers.index', compact('employer'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$employer = Employer::findOrFail($id);
		return view('employers.show', compact('employer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employer = Employer::findOrFail($id);
		return view('employers.edit', compact('employer'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$employer = Employer::findOrFail($id);
		//$employer->user_id = Auth::user()->id;
		$employer->company_name = $request->input('company_name');
		$employer->phone_no = $request->input('phone_no');
		$employer->company_j = $request->input('company_j');
		$employer->company_cui = $request->input('company_cui');
		$employer->company_account = $request->input('company_account');		
		//$employer->industry_id = $request->input('industry'); pentru update industry_id se sterge si se creaza nou 

		$employer->save();
		return view('employers.index', compact('employer'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$employer = Employer::findOrFail($id);
		$employer->delete();
		//return view('employers.index', compact('employer'));
		return redirect('/');
	}

}
