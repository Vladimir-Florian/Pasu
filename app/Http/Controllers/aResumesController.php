<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Profile;
use App\Resume;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class aResumesController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}

	/**
	 * Display the resume of the Profile.
	 *
	 * @param  int $id 	profile_id
	 * @return Response
	 */
	public function index($id)
	{

		$profile = Profile::findOrFail($id);
		if(!$profile->resume)
			return response()->json(['resume_not_found'], 404);
		else
		{
			$resume = collect([]);
			$resume->push(['id' => $profile->resume, 'cv' => $profile->resume->cv]);
		}
		return response()->json(compact('resume'));		
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
	 * @param  int $id 	profile_id
	 * @param Request $request
	 * @return Response
	 */
	public function store($id, Request $request)
	{
		$profile = Profile::findOrFail($id);

		if(!$profile->resume){
			$resume = new Resume;
			$resume->cv = $request->input('cv');
			
			try {
				//$resume->save();
				$profile->resume()->save($resume);			
			} catch(\Exception $e) {
			    return response()->json(["error" => $e->getCode()], 500);
			}

			return response()->json(['success profile'. $profile->id], 200);
		}
		else
		{
			return response()->json(['resume exists, go to update'], 404);
		}



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
	 * @param  int $id 	profile_id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$profile = Profile::findOrFail($id);
		$resume = $profile->resume;

		if(!$profile->resume)
			return response()->json(['resume_not_created'], 404);
		else
		{
			$resume->cv = $request->input('cv');

			try {
				$profile->resume()->save($resume);			
			} catch(\Exception $e) {
		    	return response()->json(["error" => $e->getCode()], 500);
			}
		
			return response()->json(['success profile'. $profile->id], 200);
		}

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
		File::delete($profile->resume->file_path);
		$profile->resume()->delete();

		$profile = Profile::findOrFail($id);
		return response()->json(['success profile'. $profile->id], 200);
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function upload(Request $request)
	{
        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
          $resume = $profile->resume;
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        


		if(!$profile->resume) {
			$resume = new Resume;
		}
		$file_name = 'cv'. $profile->id . '.' . $request->file('file')->getClientOriginalExtension();
		$resume->file_path = public_path() . "\\resumes\\" . $file_name;
		$request->file('file')->move('resumes', $file_name);

		try {
		  //daca fisierul exista se suprascrie
		  $profile->resume()->save($resume);			
		} catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
		}
		
		return response()->json(['success profile'. $profile->id], 200);

	}

}
