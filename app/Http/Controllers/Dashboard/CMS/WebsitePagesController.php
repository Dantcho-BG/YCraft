<?php

namespace App\Http\Controllers\Dashboard\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\WebsitePages;

class WebsitePagesController extends Controller {

  public static function getListOfPages () {

    $pagesList = DB::select("SELECT page_id, page_name, page_slug, page_content from website_pages");
    return $pagesList;

  }

  public function showPagesList () {

    $pagesList = $this->getListOfPages();

    //var_dump($pagesList);

    return view('dashboard.cms.pages', ['websitePagesList'=>$pagesList]);

  }

  public function showCreateNewPageForm () {

    return view('dashboard.cms.pageCreate');

  }

  public function DeletePage (Request $request) {
    
  }

  public function CreateNewPage (Request $request) {

    if (Auth::user()) {

      $this->validate($request, [
        'page_name'=>'required|string|max:25|unique:website_pages',
        'page_slug'=>'required|string|max:25|unique:website_pages',
        'page_columns'=>'required|integer'
      ]);

      if (!$request["page_columns"] == 0 || $request["page_columns"] == 1) {
        $pagesList = $this->getListOfPages();
        return view('dashboard.cms.pages', ['websitePagesList'=>$pagesList]);
      }

      $website_pages = new WebsitePages();
      $website_pages->page_name = $request["page_name"];
      $website_pages->page_slug = $request["page_slug"];
      $website_pages->page_columns = $request["page_columns"];
      $website_pages->save();

    }
    else {
      return view("auth.login");
    }

    return view('dashboard.cms.pageCreate');

  }

}
