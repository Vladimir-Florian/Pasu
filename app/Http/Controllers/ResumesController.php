<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Profile;
use App\Resume;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ResumesController extends Controller {

	/**
	 * Display the resume of the Profile.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{
		//dd($id);
		$profile = Profile::findOrFail($id);
		return view('profile_resume.index', compact('profile'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function create($id)
	{
		$profile = Profile::findOrFail($id);
		return view('profile_resume.create', compact('profile'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int $id 	profile_id
	 * @param Request $request
	 * @return Response
	 */
	public function store($id, Request $request)
	{
		
		$profile = Profile::findOrFail($id);

		$resume = new Resume;
		$resume->cv = $request->input('cv');
		$file_name = 'cv'. $profile->id . '.' . 
			$request->file('file')->getClientOriginalExtension();
		$resume->file_path = public_path() . "/resumes" . $file_name;
		$request->file('file')->move(
			'resumes', $file_name
			);
		/*
		$request->file('file')->move(
			base_path() . '/public/resumes/', $file_name
			);*/
		//$resume->file_path = base_path() . '/public/resumes/' . $file_name;
		//$resume->profile_id = $id;
		
		try {
			//$resume->save();
			$profile->resume()->save($resume);			
		} catch(\Exception $e) {
			return redirect()->route('profile_resume.create', [$profile])->withErrors(['error' => $e->getMessage()]);
		}

		return view('profile_resume.index', compact('profile'));
		
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
	 * @param  int  $id	profile_id
	 * @return Response
	 */
	public function edit($id)
	{
		$profile = Profile::findOrFail($id);
		return view('profile_resume.edit', compact('profile'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id 	profile_id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$profile = Profile::findOrFail($id);
		$resume = $profile->resume;
		$resume->cv = $request->input('cv');
		try {
			$profile->resume()->save($resume);			
		} catch(\Exception $e) {
			return redirect()->route('profile_resume.create', [$profile])->withErrors(['error' => $e->getMessage()]);
		}

		
		return view('profile_resume.index', compact('profile'));		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function destroy($id)
	{
		$profile = Profile::findOrFail($id);
		$profile->resume()->delete();
		//$resume = $profile->resume;
		//$resume->delete();

		return view('profile_resume.index', compact('profile'));
	}

}
