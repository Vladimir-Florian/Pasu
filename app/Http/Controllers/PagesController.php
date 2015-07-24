<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	/*
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

    public function home()
    {
		return view('pages.home');;
    }


    public function about()
    {
		$people = [
			'Andrei', 'Laurentiu', 'Eyhan'
		];
        return view('pages.about', compact('people'));
    }

	public function contact()
    {
        return view('pages.contact');
    }
    
    public function pricing()
    {
        return view('pages.pricing');
    }

}
