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

    return view('dashboard.cms.pages', ['websitePagesList'=>$pagesList, 'confirmPageDelete'=>0]);

  }

  public function showCreateNewPageForm () {

    return view('dashboard.cms.pageCreate');

  }

  public function confirmPageDelete ($page_id) {

    $pagesList = $this->getListOfPages();
    $result = WebsitePages::where('page_id',$page_id)->get();
    foreach ($result as $targetPage) {
      $targetPageData = $targetPage;
    }
    if (empty($targetPageData)) {

      $redirectTo = config('app.url');
      return redirect($redirectTo);

    }
    else {

      return view('dashboard.cms.pages', ['websitePagesList'=>$pagesList, 'targetPage'=>$targetPageData, 'confirmPageDelete'=>1]);

    }
  }

  public function deletePage ($page_id, Request $request) {

    if (Auth::user()) {

      $this->validate($request, [
        'confirmPageDeleteName'=>'required|string|max:25'
      ]);

      $result = WebsitePages::where('page_id',$page_id)->get();
      foreach ($result as $targetPage) {
        $targetPage = $targetPage;
      }

      if ($request["confirmPageDeleteName"] == $targetPage->page_name) {

        $targetPage->delete();

        $pagesList = $this->getListOfPages();
        return view('dashboard.cms.pages', ['websitePagesList'=>$pagesList, 'confirmPageDelete'=>0]);
      }
      else {
        $pagesList = $this->getListOfPages();
        return view('dashboard.cms.pages', ['websitePagesList'=>$pagesList, 'confirmPageDelete'=>0]);
      }

    }
    else {
      return view("auth.login");
    }

  }

  public function createNewPage (Request $request) {

    if (Auth::user()) {

      $this->validate($request, [
        'page_name'=>'required|string|max:25|unique:website_pages',
        'page_slug'=>'required|string|max:25|unique:website_pages',
        'page_columns'=>'required|integer|digits_between:0,1'
      ]);

      $page_slug = strtolower($request["page_slug"]);

      $website_pages = new WebsitePages();
      $website_pages->page_name = $request["page_name"];
      $website_pages->page_slug = $page_slug;
      $website_pages->page_columns = $request["page_columns"];
      $website_pages->save();

    }
    else {
      return view("auth.login");
    }

    return view('dashboard.cms.pageCreate');

  }

}
