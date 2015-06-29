<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Industry;


class aIndustriesController extends Controller {

	public function __construct()
	{

		$this->middleware('jwt.auth');
	}


	/**
	 * List all industries
	 * @return Response
	 */
	public function index()
	{
		try {

			if (! $user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

			return response()->json(['token_absent'], $e->getStatusCode());

		}

		// the token is valid and we have found the user via the sub claim
		//return response()->json(compact('user'));

		//$industries = Industry::latest()->get();
		$industries = Industry::all();
		
		return response()->json($industries);
	}

}
