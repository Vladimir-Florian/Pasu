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
        try {

            $profile = Profile::findOrFail($pid);
            if(!$profile->languages->count()) {
                return response()->json(['error' => 'no languages entered'], 404);
            }

            $languages = $profile->languages;
            $langs = collect([]);
            foreach($languages as $language){
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
