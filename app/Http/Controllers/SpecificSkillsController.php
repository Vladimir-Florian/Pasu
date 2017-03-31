<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Industry;
use App\Specific_skill;


class SpecificSkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specific_skills = Specific_skill::all();
        
        return view('specific_skills.index', compact('specific_skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::lists("slug", "id"); 
        return view('specific_skills.create', compact('industries'));      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specific_skill = new Specific_skill;
        $specific_skill->slug = $request->input('slug');
        $specific_skill->name = $request->input('name');
        $specific_skill->description = $request->input('description');
        $specific_skill->industry_id = $request->input('specialization');
        $specific_skill->save();

        $specific_skills = specific_skill::all();     
        return view('specific_skills.index', compact('specific_skills'));     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specific_skill = Specific_skill::findOrFail($id);
        
        return view('specific_skills.show', compact('specific_skill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $industries = Industry::lists("slug", "id"); 
        $specific_skill = Specific_skill::findOrFail($id);
        return view('specific_skills.edit', compact('specific_skill', 'industries'));
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
        $specific_skill = Specific_skill::findOrFail($id);
        $specific_skill->update($request->all());
        return redirect('specific_skills');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specific_skill = Specific_skill::findOrFail($id);
        $specific_skill->delete();
        return redirect('specific_skills');
    }
}
