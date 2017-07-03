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
	 * @return Response
	 */
	public function index()
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

		if(!$profile->resume)
			return response()->json(['resume_not_found'], 404);
		else
		{
			$cv = $resume->cv;
			return response()->json(compact('cv'));	
		}
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
	 * Create a Resume of Profile and the CV record of Resume
	 * with text from input
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
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
			$resume->cv = $request->input('cv');
		}
		else
		{
			$resume->cv = $request->input('cv');
		}

		try {
		  	$profile->resume()->save($resume);			
		} catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
		}
		
		return response()->json(['success profile'. $profile->id], 200);
			
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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

		if(!$profile->resume)
			return response()->json(['resume_not_found'], 404);
		else
		{
			$cv = $resume->cv;
			return response()->json(compact('cv'));	
		}

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
	 * Update the CV record of Resume of current Profile.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
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

		if(!$profile->resume)
			return response()->json(['resume_not_created'], 404);
		else
		{
			$resume->cv = $request->input('cv');

			try {
				$profile->resume()->save($resume);			
			} catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
			}
		
			return response()->json(['success profile'. $profile->id], 200);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
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

		File::delete($profile->resume->file_path);
		$profile->resume()->delete();

		return response()->json(['success profile'. $profile->id], 200);
		
	}

	/**
	 * Update the file_path record of Resume of current Profile and upload new file
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
		  //daca fisierul exista se suprascrie

		try {
		  $profile->resume()->save($resume);			
		} catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
		}
		
		return response()->json(['success profile'. $profile->id], 200);
	}

}
