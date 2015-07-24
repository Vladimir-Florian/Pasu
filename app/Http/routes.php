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

//Route::get('/', 'WelcomeController@index');

Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);
/*
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
*/
//Route::get('home', 'HomeController@index');

Route::get('about', [
    'as' => 'about',
    'uses' => 'PagesController@about'
]);
Route::get('contact', [
    'as' => 'contact',
    'uses' => 'PagesController@contact'
]);
Route::get('pricing', [
    'as' => 'pricing',
    'uses' => 'PagesController@pricing'
]);


/*
Route::get('industries', 'IndustriesController@index');
Route::get('industries/create', 'IndustriesController@create');
Route::get('industries/{id}', 'IndustriesController@show');
Route::post('industries', 'IndustriesController@store');
*/

// Provide controller methods with object instead of ID
//Route::model('profiles', 'Profile');
//Route::model('industries', 'Industry');
 
Route::resource('industries', 'IndustriesController');
Route::resource('industries.profiles', 'ProfilesController');

Route::resource('employees', 'EmployeeController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api'], function() {
    Route::post('/register', 			          	array('uses' => 'UserController@register'));
    Route::post('/login', 			          		array('uses' => 'UserController@login'));
    Route::get('/test', 			          		array('uses' => 'UserController@AuthenticatedUser'));
    Route::get('/test2', 			          		array('uses' => 'UserController@TestedUser'));
	Route::get('/industries',						array('uses' => 'aIndustriesController@index'));
});



