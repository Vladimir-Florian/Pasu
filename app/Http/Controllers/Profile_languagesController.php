<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Language;
use App\LangLevel;

class Profile_languagesController extends Controller
{
    /**
     * Display all languages of the Profile.
     *
     * @param  int $id  profile_id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profile_languages.index', compact('profile'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id  profile_id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $profile = Profile::findOrFail($id);
        //->select('name', 'id')->get();
        $langs = Language::lists("name", "id"); 
        $levels = LangLevel::lists("name", "id"); 
        //$langs = Language::select('name', 'id')->get(); 
        //$levels = LangLevel::select('name', 'id')->get();
        return view('profile_languages.create', compact('profile', 'langs', 'levels'));
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
        $profile = Profile::findOrFail($id);
       
        $lang_id = $request->input('language');
        try {
            $profile->languages()->attach($lang_id, ['level_id' => $request->input('level')]);
        } catch(\Exception $e) {
            return redirect()->route('profile_languages.create', [$profile])->withErrors(['error' => $e->getMessage()]);
            //return \Response::view('errors.503', [], 404);
            //return redirect()->route('profile_languages.create', [$profile]);
        }
        
        return view('profile_languages.index', compact('profile'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pid    profile_id
     * @param  int  $lid     language_id
     * @return \Illuminate\Http\Response
     */
    public function show($pid, $lid)
    {
        $profile = Profile::findOrFail($pid);
        $language = $profile->languages()->where('id', $lid)->firstOrFail();
        $level = langLevel::where('id', $language->pivot->level_id)->firstOrFail();
        return view('profile_languages.show', compact('profile', 'language', 'level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pid    profile_id
     * @param  int  $lid    languagee_id
     * @return \Illuminate\Http\Response
     */
    public function edit($pid, $lid)
    {
        $profile = Profile::findOrFail($pid);
        $language = $profile->languages()->where('id', $lid)->firstOrFail();
        $levels = LangLevel::lists("name", "id"); 
        return view('profile_languages.edit', compact('profile', 'language', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pid     profile_id
     * @param  int  $lid     language_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pid, $lid)
    {
        $profile = Profile::findOrFail($pid);
        $language = $profile->languages()->where('id', $lid)->firstOrFail();
        //dd($request->input('details'));
        //$language->pivot->language_id = $request->input('language');
        $language->pivot->level_id = $request->input('level');       
        $language->pivot->save();
        //$profile->languages()->save($language);
        return view('profile_languages.index', compact('profile'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pid     profile_id
     * @param  int  $lid     language_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid, $lid)
    {
        $profile = Profile::findOrFail($pid);
        $language = $profile->languages()->where('id', $lid)->firstOrFail();
        $profile->languages()->detach($language);

        return view('profile_languages.index', compact('profile'));
    }
}
