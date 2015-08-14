<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Certificate;
//use App\Http\Requests;
//use Illuminate\HttpResponse;

class CertificatesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$certificates = Certificate::all();
		
		return view('certificates.index', compact('certificates'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('certificates.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		Certificate::create($request->all());
		return redirect('certificates');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$certificate = Certificate::findOrFail($id);
		
		return view('certificates.show', compact('certificate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$certificate = Certificate::findOrFail($id);
		return view('certificates.edit', compact('certificate'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$certificate = Certificate::findOrFail($id);
		$certificate->update($request->all());
		return redirect('certificates');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$certificate = Certificate::findOrFail($id);
		$certificate->delete();
		return redirect('certificates');
	}

}
