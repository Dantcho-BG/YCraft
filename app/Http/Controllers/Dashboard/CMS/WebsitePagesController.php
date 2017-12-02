<?php

namespace App\Http\Controllers\Dashboard\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebsitePagesController extends Controller {

  public static function getListOfPages () {

    $pagesList = DB::select("SELECT page_id, page_slug, page_title, page_content from website_pages");
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

}
