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
Route::resource('certificates', 'CertificatesController');


Route::get('p_certificates/{id}', [
	'as' => 'profile_certificates.index',
	'uses' => 'Profile_certificates@index'
]);

Route::get('profiles_certificates/{id}/create', [
	'as' => 'profile_certificates.create',
	'uses' => 'Profile_certificates@create'
]);
Route::get('profiles_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.show',
	'uses' => 'Profile_certificates@show'
]);
Route::get('profiles_certificates/{iid}/{id}/edit', [
	'as' => 'profile_certificates.edit',
	'uses' => 'Profile_certificates@edit'
]);

Route::put('profiles_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.update',
	'uses' => 'Profile_certificates@update'
]);
Route::patch('profiles_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.update',
	'uses' => 'Profile_certificates@update'
]);

Route::post('profile_certificates/{id}', [
	'as' => 'profile_certificates.store',
	'uses' => 'Profile_certificates@store'
]);

Route::delete('profiles_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.destroy',
	'uses' => 'Profile_certificates@destroy'
]);
/*
Route::resource('profile_certificates', 'Profile_certificates',
                ['except' => ['index', 'create', 'show', 'edit', 'update', 'store']]);
//Route::resource('profile_certificates', 'Profile_certificates');
*/

Route::resource('locations', 'LocationsController');

Route::get('profile_locations/{id}', [
	'as' => 'profile_locations.index',
	'uses' => 'Profile_locations@index'
]);
Route::get('profiles_locations/{id}/create', [
	'as' => 'profile_locations.create',
	'uses' => 'Profile_locations@create'
]);
Route::post('profile_locations/{id}', [
	'as' => 'profile_locations.store',
	'uses' => 'Profile_locations@store'
]);
Route::get('profile_locations/{iid}/{id}', [
	'as' => 'profile_locations.show',
	'uses' => 'Profile_locations@show'
]);
Route::get('profile_locations/{iid}/{id}/edit', [
	'as' => 'profile_locations.edit',
	'uses' => 'Profile_locations@edit'
]);
Route::patch('profile_locations/{iid}/{id}', [
	'as' => 'profile_locations.update',
	'uses' => 'Profile_locations@update'
]);
Route::delete('profile_locations/{iid}/{id}', [
	'as' => 'profile_locations.destroy',
	'uses' => 'Profile_locations@destroy'
]);

Route::resource('employers', 'EmployersController');
Route::resource('industries.jobtypes', 'JobtypesController');
Route::resource('employers.jobposts', 'JobpostsController');
Route::resource('employment_types', 'Employment_typesController');

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



