<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Language;
use App\LangLevel;
use App\LanguageProfile;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class aProfile_languagesController extends Controller
{
    
    public function __construct()
    {

        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int $pid  profile_id
     * @return \Illuminate\Http\Response
     */
    public function index($pid)
    {
        // the token is valid and we have found the user 
        try {

            $profile = Profile::findOrFail($pid);
            if(!$profile->languages->count()) {
                return response()->json(['error' => 'no languages entered'], 404);
            }

            //$languages = $profile->languages;
            $langs = collect([]);
            foreach($profile->languages as $language){
                try {
                    $level = LangLevel::findOrfail($language->pivot->level_id);
                } catch (ModelNotFoundException $e) {
                    return response()->json(["error" => $e->getMessage()], 404);                
                }
                $langs->push(['id' => $language->id, 'slug' => $language->slug,
                    'name' => $language->name,
                    'level' => $level                
                    ]);
            }
            //dd(compact('langs'));
            return response()->json(compact('langs'));      

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
     * @param  int $pid  profile_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($pid, Request $request)
    {
    // the token is valid and we have found the user 

        try {        
          $profile = Profile::findOrFail($pid);
          $lang_id = $request->input('language');
          try {
              $profile->languages()->attach($lang_id, ['level_id' => $request->input('level')]);
          } catch(\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
          }       
          return response()->json(['success Language'. $lang_id], 200);
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
     * @param  int  $pid        profile_id
     * @param  int  $lid        language_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pid, $lid)
    {
        // the token is valid and we have found the user 

        try {
          $profile = Profile::findOrFail($pid);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
        }

        try {
          $language = $profile->languages()->where('id', $lid)->first();
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }
        $language->pivot->level_id = $request->input('level');       
        try {
          $language->pivot->save();
        } catch(\Exception $e) {
            return response()->json(['Cannot save language'], $e->getStatusCode());          
        }
        return response()->json(['success profile'. $profile->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pid        profile_id
     * @param  int  $lid        language_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid, $lid)
    {
        try {
          $profile = Profile::findOrFail($pid);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
        }

        try {
          $language = $profile->languages()->where('id', $lid)->first();
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }

        try {
            $profile->languages()->detach($language);
        } catch(\Exception $e) {
            return response()->json(['Cannot Delete language'], $e->getStatusCode());        
        }        
        return response()->json(['success profile'. $profile->id], 200);            
    }
}
