<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Drivinglicence;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class aDrivinglicenceController extends Controller
{

    public function __construct()
    {

        $this->middleware('jwt.auth');
    }


    /**
     * Display the licences of the profile
     *
     * @param  int $id  profile_id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {

            $profile = Profile::findOrFail($id);
            if(!$profile->drivinglicences->count()) {
                return response()->json(['error' => 'no licences entered'], 404);
            }

            $drivinglicences = $profile->drivinglicences;
            $licences = collect([]);
            foreach($drivinglicences as $drivinglicence){
                $licences->push(['id' => $drivinglicence->id, 'category' => $drivinglicence->category]);
            }
            //dd(compact('licences'));
            return response()->json(compact('licences'));      

        } catch(ModelNotFoundException $e) {

            return response()->json(['error' => 'profile does not exist'], 404);

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
     * Store a newly created resource in storage.
     *
     * @param  int $id  profile_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
    // the token is valid and we have found the user 

        try {        
          $profile = Profile::findOrFail($id);
          $drivinglicence = new Drivinglicence;
          $drivinglicence->category = $request->input('category');

          try {
            $profile->drivinglicences()->save($drivinglicence);            
          } catch(\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
          }      
          return response()->json(['success Licence'. $drivinglicence->id], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
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
     * @return \Illuminate\Http\Response
     * @param  int  $iid        profile_id
     * @param  int  $id     licence id
     */
    public function update($iid, $id, Request $request)
    {
    // the token is valid and we have found the user 

        try {
          $profile = Profile::findOrFail($iid);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
        }

        try {
          $drivinglicence = $profile->drivinglicences()->where('id', $id)->first();
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }
        $drivinglicence->category = $request->input('category');
        try {
            $profile->drivinglicences()->save($drivinglicence);            
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }
        return response()->json(['success Licence'. $drivinglicence->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $iid        profile_id
     * @param  int  $id     licence id
     * @return \Illuminate\Http\Response
     */
    public function destroy($iid, $id)
    {
        try {
          $profile = Profile::findOrFail($iid);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
        }

        try {
          $drivinglicence = $profile->drivinglicences()->where('id', $id)->first();
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }

        try {
            $drivinglicence->delete();
        } catch(\Exception $e) {
            return response()->json(['Cannot Delete Licence'], $e->getStatusCode());        
        }
      
        return response()->json(['success profile'. $profile->id], 200);    
    }
}
