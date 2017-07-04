<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Markedjobpost;
use App\Profile;
use App\Jobpost;
use Carbon\Carbon;
use App\Exceptions\MyQueryExceptReturn;
use App\Exceptions\MyExceptReturn;
use Illuminate\Database\QueryException as QueryException;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Support\Facades\DB;

class aMarkedjobpostsController extends Controller
{

    public function __construct()
    {

        $this->middleware('jwt.auth');
    }



    /**
     * Display a list of the marked jobposts for the current profile id
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
          $markedposts = collect();       
          foreach ($profile->jobposts as $markedjobpost) {
            $line = Jobpost::byjobpostid($markedjobpost->id)->get()->first();
            $markedposts->push($line);
          }
          return response()->json(compact('markedposts'));               
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
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
     * Store a newly created marked jobpost in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
          $jobpost = Jobpost::findOrFail($request->input('jobpost_id'));
          $profile->jobposts()->attach([$jobpost->id => ['mark_date' => Carbon::today()]]);
          return response()->json(['Profile id'=> $profile->id], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id jobpost id
     * @return \Illuminate\Http\Response
     */
    public function destroy($jid)
    {
        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
          $jobpost = Jobpost::findOrFail($jid);
          $profile->jobposts()->detach($jobpost);         
          return response()->json(['Profile id'=> $profile->id], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json(['error' => $error_code], 500);
        }        
    }
}
