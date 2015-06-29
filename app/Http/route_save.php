<?php

use Illuminate\Http\Request;
//use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Validation\Validator;
use Illuminate\Http\Exception\HttpResponseException;

use App\User;



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('pricing', 'PagesController@pricing');

Route::get('industries', 'IndustriesController@index');
Route::get('industries/create', 'IndustriesController@create');
Route::get('industries/{id}', 'IndustriesController@show');
Route::post('industries', 'IndustriesController@store');


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api'], function() {
    Route::post('/register', 			          	array('uses' => 'UserController@register'));
    Route::post('/login', 			          		array('uses' => 'UserController@login'));
    Route::get('/test', 			          		array('uses' => 'UserController@AuthenticatedUser'));
    Route::get('/test2', 			          		array('uses' => 'UserController@TestedUser'));
	/*
	Route::post('/register', function (Request $request) {
		//$credentials = Request::only('email', 'password');
		$credentials = $request->only('email', 'password');
		dd($credentials);
		
		try {
			$user = User::create($credentials);
		} catch (Exception $e) {
			return Response::json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
	}

		$token = JWTAuth::fromUser($user);

		return Response::json(compact('token'));
	});

	Route::post('/login', function () {
		$credentials = Request::only('email', 'password');

		if ( ! $token = JWTAuth::attempt($credentials)) {
			return Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
		}

		return Response::json(compact('token'));
	});
*/	
});



