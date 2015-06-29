<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

    public function home()
    {
		return view('pages.home');;
		//return view('pages.about', compact('people'));
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
