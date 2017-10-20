<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class HomeController extends Controller
{

    public function getListOfWebsitePages () {

      $pagesList = DB::select("SELECT page_title, page_url from website_pages");
      return $pagesList;

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagesList = $this->getListOfWebsitePages();
        $pagesAmount = count($pagesList);
        //return redirect('/');
        return view('home', ['websitePagesList'=>$pagesList, 'websitePagesAmount'=>$pagesAmount]);
    }

    public function redirect() {

      return Redirect::to('/');

    }
}
