<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Specific_skill;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class aProfile_sSkillsController extends Controller
{
    public function __construct()
    {

        $this->middleware('jwt.auth');
    }


    /**
     * Get a listing of the sSkills for Profile.
     *
     * @param  int $id  profile_id
     * @return Response
     */
    public function index($id)
    {
        // the token is valid and we have found the user via the sub claim

        try {

            $profile = Profile::findOrFail($id);
            if(!$profile->specific_skills->count()) {
                return response()->json(['error' => 'no competence entered'], 404);
            }

            $specific_skills = $profile->specific_skills;
            $sskills = collect([]);
            foreach($specific_skills as $sskill){
                $sskills->push(['id' => $sskill->id, 'slug' => $sskill->slug,
                    'name' => $sskill->name,
                    'description' => $sskill->description 
                    ]);
            }
            return response()->json(compact('sskills'));      

        } catch(ModelNotFoundException $e) {

            return response()->json(['error' => 'profile does not exist'], 404);

        }

    }

    /**
     * Get a listing of all the sSkills for the Industry of Profile.
     *
     * @param  int $id  Profile id
     * @return Response
     */
    public function all_sSkills($id)
    {
        // the token is valid and we have found the user via the sub claim

        try {

          $profile = Profile::findOrFail($id);
            //$profile->industry_id;
          $specific_skills = Specific_skill::where('industry_id', '=', $profile->industry_id)
            ->select('id', 'slug', 'name', 'description')
            ->get();

          if(!$specific_skills) {
             return response()->json(['error' => 'Empty List'], 404);
          }

          return response()->json(compact('specific_skills'));

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
    public function store(Request $request)
    {
        // the token is valid and we have found the user via the sub claim

        try {
        
          $profile = Profile::findOrFail($id);
          $ss_id = $request->input('spec_skill_id');
          try {
              $profile->specific_skills()->attach($ss_id);
          } catch(\Exception $e) {
            //return response()->json(['Cannot Add Skill'], $e->getStatusCode());
            return response()->json(["error" => $e->getMessage()], 404);
          }
        
          return response()->json(['success spec_Skill'. $certificate->id], 200);

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
     * @param  int  $iid        profile_id
     * @param  int  $id     sskill_id
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
          $specific_skill = $profile->specific_skills()->where('id', $id)->first();
        } catch(\Exception $e) {
          return response()->json(["error" => $e->getMessage()], 404);
        }

        try {
            $profile->specific_skills()->detach($specific_skill);
        } catch(\Exception $e) {
            return response()->json(['Cannot Delete sSkill'], $e->getStatusCode());        
        }
        
        return response()->json(['success profile'. $profile->id], 200);        }
}
