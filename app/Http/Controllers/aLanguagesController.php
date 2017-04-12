<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Language;
use App\LanguageProfile;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;


class aLanguagesController extends Controller
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
        // the token is valid and we have found the user via the sub claim

        try {
          $languages = Language::select('id', 'slug', 'name')->get();
          if(!$languages) {
             return response()->json(['error' => 'Empty List'], 404);
          }
          return response()->json(compact('languages'));
        } catch(\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
        }
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

        try {
            //dd($user->id);
            $language = new language;
            $language->slug = $request->input('slug');
            $language->name = $request->input('name');
            try {
              $language->save();
              return response()->json(['success language '. $language->id], 200);                  
            } catch(\Exception $e) {
            //return response()->json(['Cannot Add language'], $e->getStatusCode());
              return response()->json(["error" => $e->getMessage()], 404);
            }
        } catch(\Exception $e) {
            return response()->json(['Profile does not exists'], 404);           
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
