<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Scertificate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class aScertificatesController extends Controller
{

    public function __construct()
    {

        $this->middleware('jwt.auth');
    }

    /**
     * Display the scertificate of the Profile.
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
          $scertificate = $profile->scertificate;
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        

        if(!$profile->scertificate)
            return response()->json(['scertificate_not_found'], 404);
        else
        {
            $description = $scertificate->description;
            return response()->json(compact('description')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a Scertificate of Profile and the description record of Scertificate
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
          $scertificate = $profile->scertificate;
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        


        if(!$profile->scertificate) {
            $scertificate = new Scertificate;
            $scertificate->description = $request->input('description');
        }
        else
        {
            $scertificate->description = $request->input('description');
        }

        try {
            $profile->scertificate()->save($scertificate);          
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
        
        return response()->json(['success profile'. $profile->id], 200);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the description record of Scertificate of current Profile.
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
          $scertificate = $profile->scertificate;
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }

        if(!$profile->scertificate)
            return response()->json(['scertificate_not_created'], 404);
        else
        {
            $scertificate->description = $request->input('description');

            try {
                $profile->scertificate()->save($scertificate);          
            } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
            }
        
            return response()->json(['success profile'. $profile->id], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
          $scertificate = $profile->scertificate;
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }

        File::delete($profile->scertificate->file_path);
        $profile->scertificate()->delete();

        return response()->json(['success profile'. $profile->id], 200);
    }

    /**
     * Update the file_path record of Scertificate of current Profile and upload new file
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
          $scertificate = $profile->scertificate;
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        


        if(!$profile->scertificate) {
            $scertificate = new Scertificate;
        }
        $file_name = 'certificate'. $profile->id . '.' . $request->file('file')->getClientOriginalExtension();
        $scertificate->file_path = public_path() . "\\scertificates\\" . $file_name;
        $request->file('file')->move('scertificates', $file_name);
          //daca fisierul exista se suprascrie

        try {
          $profile->scertificate()->save($scertificate);            
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
        
        return response()->json(['success profile'. $profile->id], 200);
    }

}
