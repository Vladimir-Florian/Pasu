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
Route::resource('specific_skills', 'SpecificSkillsController');

Route::get('profile_certificates/{id}', [
	'as' => 'profile_certificates.index',
	'uses' => 'Profile_certificates@index']);

Route::get('profile_certificates/{id}/create', [
	'as' => 'profile_certificates.create',
	'uses' => 'Profile_certificates@create']);
	
Route::get('profile_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.show',
	'uses' => 'Profile_certificates@show']);

Route::get('profile_certificates/{iid}/{id}/edit', [
	'as' => 'profile_certificates.edit',
	'uses' => 'Profile_certificates@edit']);

Route::put('profile_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.update',
	'uses' => 'Profile_certificates@update']);
	
Route::patch('profile_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.update',
	'uses' => 'Profile_certificates@update']);

Route::post('profile_certificates/{id}', [
	'as' => 'profile_certificates.store',
	'uses' => 'Profile_certificates@store']);

Route::delete('profile_certificates/{iid}/{id}', [
	'as' => 'profile_certificates.destroy',
	'uses' => 'Profile_certificates@destroy']);

Route::get('drivinglicences/{id}', [
	'as' => 'drivinglicences.index',
	'uses' => 'DrivinglicenceController@index']);

Route::get('drivinglicences/{id}/create', [
	'as' => 'drivinglicences.create',
	'uses' => 'DrivinglicenceController@create']);
	
Route::get('drivinglicences/{iid}/{id}/edit', [
	'as' => 'drivinglicences.edit',
	'uses' => 'DrivinglicenceController@edit']);

Route::put('drivinglicences/{iid}/{id}', [
	'as' => 'drivinglicences.update',
	'uses' => 'DrivinglicenceController@update']);
	
Route::patch('drivinglicences/{iid}/{id}', [
	'as' => 'drivinglicences.update',
	'uses' => 'DrivinglicenceController@update']);

Route::post('drivinglicences/{id}', [
	'as' => 'drivinglicences.store',
	'uses' => 'DrivinglicenceController@store']);

Route::delete('drivinglicences/{iid}/{id}', [
	'as' => 'drivinglicences.destroy',
	'uses' => 'DrivinglicenceController@destroy']);


Route::get('profile_languages/{id}', [
	'as' => 'profile_languages.index',
	'uses' => 'Profile_languagesController@index']);

Route::get('profile_languages/{id}/create', [
	'as' => 'profile_languages.create',
	'uses' => 'Profile_languagesController@create']);
	
Route::get('profile_languages/{iid}/{id}', [
	'as' => 'profile_languages.show',
	'uses' => 'Profile_languagesController@show']);

Route::get('profile_languages/{iid}/{id}/edit', [
	'as' => 'profile_languages.edit',
	'uses' => 'Profile_languagesController@edit']);

Route::put('profile_languages/{iid}/{id}', [
	'as' => 'profile_languages.update',
	'uses' => 'Profile_languagesController@update']);
	
Route::patch('profile_languages/{iid}/{id}', [
	'as' => 'profile_languages.update',
	'uses' => 'Profile_languagesController@update']);

Route::post('profile_languages/{id}', [
	'as' => 'profile_languages.store',
	'uses' => 'Profile_languagesController@store']);

Route::delete('profile_languages/{iid}/{id}', [
	'as' => 'profile_languages.destroy',
	'uses' => 'Profile_languagesController@destroy']);


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

Route::get('profile_resume/{id}', [
	'as' => 'profile_resume.index',
	'uses' => 'ResumesController@index'
]);
Route::get('profile_resume/{id}/create', [
	'as' => 'profile_resume.create',
	'uses' => 'ResumesController@create'
]);
Route::post('profile_resume/{id}', [
	'as' => 'profile_resume.store',
	'uses' => 'ResumesController@store'
]);
Route::get('profile_resume/{id}/edit', [
	'as' => 'profile_resume.edit',
	'uses' => 'ResumesController@edit'
]);
Route::patch('profile_resume/{id}', [
	'as' => 'profile_resume.update',
	'uses' => 'ResumesController@update'
]);
Route::delete('profile_resume/{id}', [
	'as' => 'profile_resume.destroy',
	'uses' => 'ResumesController@destroy'
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

//Route::resource('candidate_jobposts', 'CandidateJobPostsController');
Route::get('candidate_jobposts/{id}', [
	'as' => 'candidate_jobposts.index',
	'uses' => 'CandidateJobPostsController@index'
]);
Route::get('candidate_jobposts/forindustry/{id}', [
	'as' => 'candidate_jobposts.forindustry',
	'uses' => 'CandidateJobPostsController@forindustry'
]);
Route::get('candidate_jobposts/jobtypes/{id}', [
	'as' => 'candidate_jobposts.jobtypes',
	'uses' => 'CandidateJobPostsController@jobtypes'
]);
Route::get('candidate_jobposts/forjobtype/{id}/{tid}', [
	'as' => 'candidate_jobposts.forjobtype',
	'uses' => 'CandidateJobPostsController@forjobtype'
]);
Route::get('candidate_jobposts/{pid}/{id}', [
	'as' => 'candidate_jobposts.show',
	'uses' => 'CandidateJobPostsController@show'
]);


Route::get('markedjobposts/{id}', [
	'as' => 'markedjobposts.index',
	'uses' => 'MarkedjobspostsController@index'
]);
Route::get('markedjobposts/{pid}/{jid}', [
	'as' => 'markedjobposts.store',
	'uses' => 'MarkedjobspostsController@store'
]);
Route::delete('markedjobposts/{pid}/{jid}', [
	'as' => 'markedjobposts.destroy',
	'uses' => 'MarkedjobspostsController@destroy']);

	
Route::get('applications/{id}', [
	'as' => 'applications.index',
	'uses' => 'ApplicationsController@index'
]);
Route::get('applications/{pid}/{jid}', [
	'as' => 'applications.store',
	'uses' => 'ApplicationsController@store'
]);	
Route::delete('applications/{pid}/{jid}', [
	'as' => 'applications.destroy',
	'uses' => 'ApplicationsController@destroy']);



Route::get('auth/facebook', ['as' =>'auth/facebook', 'uses'=>'Auth\SocialController@redirectToProvider']);
Route::get('auth/facebook/callback', 'Auth\SocialController@handleProviderCallback');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['middleware' => 'admin'], function () {
	Route::get('admin', [
    	'as' => 'admin',
    	'uses' => 'AdminController@dashboard'
	]);
});


Route::group(['prefix' => 'api'], function() {
    Route::post('/facebook', 			          	['uses' => 'aSocialController@facebook']);
    Route::post('/register', 			          	['uses' => 'UserController@register']);
    //Route::post('/register', 			          	array('uses' => 'aProfilesController@store')); 	//replaced 18.10.2016

    Route::post('/login', 			          		array('uses' => 'UserController@login'));
    Route::post('/login_profile', 			        array('uses' => 'aProfilesController@login_profile')); //added 07.04.2016
    Route::post('/logout', 			          		array('uses' => 'UserController@logout'));	//added 19.04.2016
    Route::post('/refresh_token', 			        array('uses' => 'UserController@refreshToken'));	//added 19.04.2016
    Route::post('/reset', 			          		array('uses' => 'UserController@updatePassword'));
    Route::get('/test', 			          		array('uses' => 'UserController@AuthenticatedUser'));
    Route::get('/test2', 			          		array('uses' => 'UserController@TestedUser'));
	Route::get('/industries',						array('uses' => 'aIndustriesController@index'));
	Route::get('/jobtypes/{id}',					array('uses' => 'aJobTypesController@index'));
	Route::get('/jobposts/forindustry/{id}',		['uses' => 'aJobPostsController@forindustry']);
	Route::get('/jobposts/forjobtype/{id}',			['uses' => 'aJobPostsController@forjobtype']);
	Route::get('/jobposts/time10/{id}',				['uses' => 'aJobPostsController@time10']);
	Route::post('/jobposts/withinradius/{id}',		['uses' => 'aJobPostsController@withinradius']);
	Route::get('/jobposts/{id}',					['uses' => 'aJobPostsController@show']);
	Route::get('/jobposts_foruser',					['as' => '/jobposts.foruser', 'uses' => 'aJobPostsController@foruser']);
	Route::get('/joblist',							['as' => '/jobposts.joblist', 'uses' => 'aJobPostsController@joblist']);

	//Route::resource('/profiles', 'aProfilesController');
	Route::get('/profile', 			['as' => '/profiles.show', 'uses' => 'aProfilesController@show']);
    Route::post('/create_profile', 	['as' => '/profiles.store', 'uses' => 'aProfilesController@store']); //added 29.11.2016
	Route::patch('/profile', 		['as' => '/profiles.update', 'uses' => 'aProfilesController@update']);
	Route::delete('/profile', 		['as' => '/profiles.destroy',	'uses' => 'aProfilesController@destroy']); //added 18.01.2017
	
	/*Route::post('/certificates', 					['as' => '/certificates.store', 'uses' => 'aCertificatesController@store']);
	Route::get('/profile_certificates/{id}', 		['uses' => 'aProfile_certificatesController@index']);	
	Route::get('/cert_list/{iid}', 					['uses' => 'aProfile_certificatesController@cert_list']);	
	Route::post('/profile_certificates/{id}', 		['as' => '/profile_certificates.store', 'uses' => 'aProfile_certificatesController@store']);
	Route::patch('/profile_certificates/{iid}/{id}',['as' => '/profile_certificates.update', 'uses' => 'aProfile_certificatesController@update']);
	Route::delete('/profile_certificates/{iid}/{id}', ['as' => '/profile_certificates.destroy', 'uses' => 'aProfile_certificatesController@destroy']);*/
	// modified 03.07.2017
	Route::get('/profile_certificates', 			['uses' => 'aScertificatesController@index']);	
	Route::post('/profile_certificates', 			['as' => '/profile_certificates.store', 'uses' => 'aScertificatesController@store']);
	Route::patch('/profile_certificates',			['as' => '/profile_certificates.update', 'uses' => 'aScertificatesController@update']);
	Route::post('/profile_certificates/upload', 	['as' => '/profile_certificates.upload', 'uses' => 'aScertificatesController@upload']);
	Route::delete('/profile_certificates', 			['as' => '/profile_certificates.destroy', 'uses' => 'aScertificatesController@upload@destroy']);


	Route::get('/profile_locations/{id}', 			['uses' => 'aProfile_locationsController@index']);	
	Route::post('/profile_locations/{id}', 			['as' => '/profile_locations.store', 'uses' => 'aProfile_locationsController@store']);
	Route::put('/profile_locations/{iid}/{id}', 	['as' => '/profile_locations.update', 'uses' => 'aProfile_locationsController@update']);
	Route::delete('/profile_locations/{iid}/{id}', 	['as' => '/profile_locations.destroy', 'uses' => 'aProfile_locationsController@destroy']);
	Route::get('/profile_resume', 					['uses' => 'aResumesController@index']);	
	Route::post('/profile_resume', 					['as' => '/profile_resume.store', 'uses' => 'aResumesController@store']);
	Route::patch('/profile_resume', 				['as' => '/profile_resume.update', 'uses' => 'aResumesController@update']);
	Route::post('/profile_resume/upload', 			['as' => '/profile_resume.upload', 'uses' => 'aResumesController@upload']);
	Route::delete('/profile_resume', 				['as' => '/profile_resume.destroy', 'uses' => 'aResumesController@destroy']);

	Route::get('/profile_sskills/{id}', 			['uses' => 'aProfile_sSkillsController@index']);	
	Route::get('/sskills_list/{iid}', 				['uses' => 'aProfile_sSkillsController@all_sSkills']);	
	Route::post('/profile_sskills/{id}', 			['as' => '/profile_sskills.store', 'uses' => 'aProfile_sSkillsController@store']);
	Route::delete('/profile_sskills/{iid}/{id}', 	['as' => '/profile_sskills.destroy', 'uses' => 'aProfile_sSkillsController@destroy']);

	Route::get('/drivinglicences', 					['uses' => 'aDrivinglicenceController@index']);	
	Route::post('/drivinglicences', 				['as' => '/drivinglicences.store', 'uses' => 'aDrivinglicenceController@store']);
	Route::patch('/drivinglicences/{id}', 			['as' => '/drivinglicences.update', 'uses' => 'aDrivinglicenceController@update']);
	Route::delete('/drivinglicences/{id}', 			['as' => '/drivinglicences.destroy', 'uses' => 'aDrivinglicenceController@destroy']);

	Route::get('/profile_languages', 				['uses' => 'aProfile_languagesController@index']);	
	Route::post('/profile_languages', 				['as' => '/profile_languages.store', 'uses' => 'aProfile_languagesController@store']);
	Route::patch('/profile_languages/{id}', 		['as' => '/profile_languages.update', 'uses' => 'aProfile_languagesController@update']);
	Route::delete('/profile_languages/{id}', 		['as' => '/profile_languages.destroy', 'uses' => 'aProfile_languagesController@destroy']);
	Route::get('/levels', 							['uses' => 'aLangLevelsController@index']);	
	Route::get('/languages', 						['uses' => 'aLanguagesController@index']);
	Route::post('/languages', 						['as' => '/languages.store', 'uses' => 'aLanguagesController@store']);

	Route::get('/markedjobposts',					['as' => '/markedjobposts.index','uses' => 'aMarkedjobpostsController@index']);
	Route::post('/markedjobposts', 					['uses' => 'aMarkedjobpostsController@store']);
	Route::delete('/markedjobposts/{id}', 			['as' => '/markedjobposts.destroy', 'uses' => 'aMarkedjobpostsController@destroy']);

	Route::get('/applications',						['as' => '/applications.index','uses' => 'aApplicationsController@index']);
	Route::post('/applications', 					['uses' => 'aApplicationsController@store']);
	Route::delete('/applications/{id}', 			['as' => '/applications.destroy', 'uses' => 'aApplicationsController@destroy']);

	
});



