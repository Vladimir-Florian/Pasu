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

Route::get('jobpost_locations/{id}/create', [
	'as' => 'jobpost_locations.create',
	'uses' => 'Jobpost_locationsController@create'
]);
Route::get('jobpost_locations/{id}/edit', [
	'as' => 'jobpost_locations.edit',
	'uses' => 'Jobpost_locationsController@edit'
]);
Route::post('jobpost_locations/{id}', [
	'as' => 'jobpost_locations.store',
	'uses' => 'Jobpost_locationsController@store'
]);
Route::patch('jobpost_locations/{id}', [
	'as' => 'jobpost_locations.update',
	'uses' => 'Jobpost_locationsController@update'
]);

Route::get('jobpost_jobtags/{id}', [
	'as' => 'jobpost_jobtags.index',
	'uses' => 'Jobpost_jobtagsController@index'
]);
Route::get('jobpost_jobtags/{id}/create', [
	'as' => 'jobpost_jobtags.create',
	'uses' => 'Jobpost_jobtagsController@create'
]);
Route::post('jobpost_jobtags/{id}', [
	'as' => 'jobpost_jobtags.store',
	'uses' => 'Jobpost_jobtagsController@store'
]);
Route::get('jobpost_jobtags/{iid}/{id}', [
	'as' => 'jobpost_jobtags.show',
	'uses' => 'Jobpost_jobtagsController@show'
]);
Route::get('jobpost_jobtags/{iid}/{id}/edit', [
	'as' => 'jobpost_jobtags.edit',
	'uses' => 'Jobpost_jobtagsController@edit'
]);
Route::patch('jobpost_jobtags/{iid}/{id}', [
	'as' => 'jobpost_jobtags.update',
	'uses' => 'Jobpost_jobtagsController@update'
]);
Route::delete('jobpost_jobtags/{iid}/{id}', [
	'as' => 'jobpost_jobtags.destroy',
	'uses' => 'Jobpost_jobtagsController@destroy'
]);




Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api'], function() {
    Route::post('/register', 			          	array('uses' => 'UserController@register'));
    Route::post('/login', 			          		array('uses' => 'UserController@login'));
    Route::post('/reset', 			          		array('uses' => 'UserController@updatePassword'));
    Route::get('/test', 			          		array('uses' => 'UserController@AuthenticatedUser'));
    Route::get('/test2', 			          		array('uses' => 'UserController@TestedUser'));
	Route::get('/industries',						array('uses' => 'aIndustriesController@index'));
	Route::get('/jobtypes/{iid}',					array('uses' => 'aJobTypesController@index'));
	
});



