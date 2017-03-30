<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Industry;
use App\Certificate;
use App\Profile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;

class aCertificatesController extends Controller
{

    public function __construct()
    {

        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // the token is valid and we have found the user via the sub claim

        if(! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['token error'], 403);
        }

        try {
            //dd($user->id);
            $profile = Profile::byuser_id($user->id)->firstOrFail();
            $certificate = new Certificate;
            $certificate->slug = $request->input('slug');
            $certificate->name = $request->input('name');
            $certificate->description = $request->input('description');
            $certificate->industry_id = $profile->industry_id;

          try {
            $certificate->save();
          } catch(\Exception $e) {
            //return response()->json(['Cannot Add Certificate'], $e->getStatusCode());
            return response()->json(["error" => $e->getMessage()], 404);
          }

        } catch(ModelNotFoundException $e) {

            return response()->json(['Profile does not exists'], 404);           

        }

        return response()->json(['success Certificate '. $certificate->id], 200);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
