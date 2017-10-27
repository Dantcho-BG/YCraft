<?php

namespace App\Http\Controllers\Dashboard\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebsitePagesCreatorController extends Controller {

  public function getListOfPages () {

    $pagesList = DB::select("SELECT page_id, page_title, page_url from website_pages");
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
