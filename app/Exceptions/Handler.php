<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		/*
		if($request->route()->getAction()["controller"] == "App\Http\Controllers\UserController@register"){
		
			//$statusCode = $e->getStatusCode();
            //return response($response, $statusCode);
			//return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
		   return response()->json(["error" => $e->getCode()], 500);
			
		}

		
		if($request->route()->getAction()["controller"] == "App\Http\Controllers\UserController@login"){
			//return response()->json(["error" => $e->getCode()], 401);
			return response()->json(["error" => 'invalid_credentials'], 401);
			//return response()->json(["error" => $e->getMessage()], $e->getStatusCode());

		}
		*/

		
		if($request->route()->getAction()["controller"] == "App\Http\Controllers\UserController@updatePassword"){
		
			//$statusCode = $e->getStatusCode();
			//return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
		   return response()->json(["error" => $e->getCode()], 500);
			
		}
		
		
		if($request->route()->getAction()["controller"] == "App\Http\Controllers\UserController@TestedUser"){		
			if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
				return response()->json(['error' => 'token_invalid'], $e->getStatusCode());
			}
			if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
				return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
			}
			if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
				//return response()->json(["error" => 'token_absent'], $e->getStatusCode());
				return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
			}
			
		}

		if($request->route()->getAction()["controller"] == "App\Http\Controllers\aJobTypesController@index"){
			if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
					return response()->json(['error' => "ModelNotFoundException"], 404);
			}			
			return response()->json(["error" => $e->getMessage()], 404);
		}

		if($request->route()->getAction()["controller"] == "App\Http\Controllers\aJobPostsController@forjobtype"){
			if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
					return response()->json(['error' => "ModelNotFoundException"], 404);
			}			
			return response()->json(["error" => $e->getMessage()], 404);
		}
		
		
		
		return parent::render($request, $e);
	}

}
