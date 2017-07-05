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
     * Display Foreign languages of profile.
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
            if(!$profile->languages->count()) {
                return response()->json(['error' => 'no languages entered'], 404);
            }

            $langs = collect([]);
            foreach($profile->languages as $language){
            /*    try {
                    $level = LangLevel::findOrfail($language->pivot->level_id);
                } catch (ModelNotFoundException $e) {
                    return response()->json(["error" => $e->getMessage()], 404);                
                }
                $langs->push(['id' => $language->id, 'slug' => $language->slug,
                    'name' => $language->name,
                    'level' => $level                
                    ]);
                    */
                $langs->push(['id' => $language->id, 'slug' => $language->slug,
                             'name' => $language->name,]);               
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
          $lang_id = $request->input('language');
          try {
              //$profile->languages()->attach($lang_id, ['level_id' => $request->input('level')]);
              $profile->languages()->attach($lang_id);
          } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
          }       
        } catch(ModelNotFoundException $e) {
          return response()->json(['error' => 'profile does not exist'], 404);
        }
        return response()->json(['success Language'. $lang_id], 200);

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
     * @param  int  $lid        language_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lid)
    {
        // ????
        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {        
          $profile = Profile::byuser_id($user->id)->firstOrFail();
        } catch(ModelNotFoundException $e) {
          return response()->json(['error' => 'profile does not exist'], 404);
        }

        try {
          $language = $profile->languages()->where('id', $lid)->first();
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }
        //$language->pivot->level_id = $request->input('level');       
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
     * @param  int  $lid        language_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lid)
    {
        if (! $user = JWTAuth::parseToken()->toUser()) {
            return response()->json(['error' => 'user_not_found'], 400);
        }

        try {
          $profile = Profile::byuser_id($user->id)->firstOrFail();
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'profile does not exist'], 404);
        }

        try {
          $language = $profile->languages()->where('id', $lid)->first();
        } catch(\Exception $e) {
          return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

        try {
            $profile->languages()->detach($language);
        } catch(\Exception $e) {
            return response()->json(['Cannot Delete language'], $e->getStatusCode());        
        }        
        return response()->json(['success profile'. $profile->id], 200);            
    }
}
