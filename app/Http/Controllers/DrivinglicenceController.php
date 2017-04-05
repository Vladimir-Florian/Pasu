<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Drivinglicence;
use App\Profile;



class DrivinglicenceController extends Controller
{
    /**
     * Display the licences of the profile
     *
     * @param  int $pid     profile_id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = Profile::findOrFail($id);
        return view('drivinglicences.index', compact('profile'));
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
        return view('drivinglicences.create', compact('profile'));

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

        $drivinglicence = new Drivinglicence;
        $drivinglicence->category = $request->input('category');

        //dd($drivinglicence->category);
        try {
            $profile->drivinglicences()->save($drivinglicence);            
        } catch(\Exception $e) {
            return redirect()->route('drivinglicences.create', [$profile])->withErrors(['error' => $e->getMessage()]);
        }
        
        return view('drivinglicences.index', compact('profile'));
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
     * @param  int  $pid    profile_id
     * @param  int  $id     drivinglicence_id
     * @return \Illuminate\Http\Response
     */
    public function edit($pid, $id)
    {
        $profile = Profile::findOrFail($pid);
        $drivinglicence = $profile->drivinglicences()->where('id', $id)->first();
        return view('drivinglicences.edit', compact('profile', 'drivinglicence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pid        profile_id
     * @param  int  $id     drivinglicence_id
     * @return \Illuminate\Http\Response
     */
    public function update($pid, $id, Request $request)
    {
        //dd($id);
        $profile = Profile::findOrFail($pid);
        $drivinglicence = $profile->drivinglicences()->where('id', $id)->first();
        $drivinglicence->category = $request->input('category');
        try {
            //$profile->drivinglicences()->save($drivinglicence);
            $profile->drivinglicences()->save($drivinglicence);            
        } catch(\Exception $e) {
            return redirect()->route('drivinglicences.edit', [$profile])->withErrors(['error' => $e->getMessage()]);
        }
       
        return view('drivinglicences.index', compact('profile'));    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $iid        profile_id
     * @param  int  $id     licence id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid, $id)
    {
        $profile = Profile::findOrFail($pid);
        $drivinglicence = $profile->drivinglicences()->where('id', $id)->first();
        $drivinglicence->delete();

        return view('drivinglicences.index', compact('profile'));
    }
}
