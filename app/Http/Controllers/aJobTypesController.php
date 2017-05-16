<?php namespace App\Http\Controllers;

use App\Jobtype;
use App\Industry;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class aJobTypesController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}


	/**
	 * Returns a json list of jobtypes.
	 *
	 * @param  int $iid 	industry_id
	 * @return Response
	 */
	public function index($iid)
	{
        // the token is valid and we have found the user 

        try {
			$industry = Industry::findOrFail($iid);

			/*$jobtypes = DB::table('jobtypes')
           		->join('industries', 'jobtypes.industry_id', '=', 'industries.id')
           		->select('jobtypes.id', 'jobtypes.name', 'jobtypes.description')
           		->get(); */
			$jtypes = $industry->jobtypes;

            if(!$jtypes->count()) {
                return response()->json(['error' => 'no jobtypes for Specialization'], 404);
            }

            //$languages = $profile->languages;
            $jobtypes = collect([]);
            foreach($jtypes as $jtype){
               $jobtypes->push(['id' => $jtype->id,
                    'name' => $jtype->name,
                    'description' => $jtype->description                
                    ]);
            }
            //dd(compact('jobtypes'));
			return response()->json(compact('jobtypes'));		

        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'Specialization does not exist'], 404);
        }

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
