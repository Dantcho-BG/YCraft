<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Http\Controllers\Dashboard\CMS\WebsitePagesController;

class HomeController extends Controller {



    /**
     * Create a new controller instance.
     *
     * @return void
     */

     /*public function getListOfWebsitePages () {

       $pagesList = DB::select("SELECT page_slug, page_name from website_pages");
       return $pagesList;

     }*/

    public function index() {
        $pagesList = WebsitePagesController::getListOfPages();
        $pagesAmount = count($pagesList);
        //return redirect('/');
        return view('home', ['websitePagesList'=>$pagesList, 'websitePagesAmount'=>$pagesAmount]);
    }

    public function redirect() {

      return Redirect::to('/');

    }
}
