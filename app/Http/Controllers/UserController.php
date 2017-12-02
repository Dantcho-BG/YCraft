<?php

namespace App\Http\Controllers;

use App\Rules\ConfirmUserPassword;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
use DB;
use App\Http\Controllers\Dashboard\CMS\WebsitePagesController;

class UserController extends Controller {

  /*public function getListOfWebsitePages () {

    $pagesList = DB::select("SELECT page_slug, page_title from website_pages");
    return $pagesList;

  }*/

    public function profile () {
        if (Auth::user()) {
          $pagesList = WebsitePagesController::getListOfPages();
          $pagesAmount = count($pagesList);
            return view("profile", array('user'=> Auth::user()), ['websitePagesList'=>$pagesList, 'websitePagesAmount'=>$pagesAmount]);
        }
        else {
            return view("auth.login");
        }
    }

    public function postAuth (Request $request) {

        if (Input::get('change_profile_pic', 'NA') == 'change_profile_pic') {
            return $this->updateAvatar($request);
        }
        elseif (Input::get('change_profile_details', 'NA') == 'change_profile_details') {
            return $this->updateProfileDetails($request);
        }
        else {
            return "Post Auth Failed";
        }

    }

    public function updateAvatar(Request $request) {

        if ($request['profileImageReload'] || !$request->hasFile('avatar')) {
            if (Auth::user()->avatar != 'default.jpg') {
                File::delete(public_path('/uploads/avatars/' . Auth::user()->avatar));
                Auth::user()->avatar = 'default.jpg';
                Auth::user()->save();
            }
        }

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = Auth::user()->name . time() . '.' . $avatar->getClientOriginalExtension();
            $height = Image::make($avatar)->height();
            Image::make($avatar)->crop($height,$height)->save (public_path('/uploads/avatars/' . $filename));

            if (Auth::user()->avatar != "default.jpg") {
                File::delete(public_path('/uploads/avatars/' . Auth::user()->avatar));
            }

            Auth::user()->avatar = $filename;
            Auth::user()->save();
        }

        return view('profile', array('user'=> Auth::user()));

    }

    public function passwordChangeValidation(array $data) {
        $messages = [
            'current_password.required' => 'Please enter current password',
            'password.required' => 'Please enter a new password',
        ];

        $validator = Validator::make($data, [
            'current_password' => [
                'required',
                new ConfirmUserPassword(),
            ],
            'new_password' => 'required',
            'new_password_confirm' => 'required|same:new_password',
        ], $messages);

        return $validator;
    }



    public function updateProfileDetails (Request $request) {
        if (Auth::user()) {

            if ($request["name"] != Auth::user()->name) {
                $this->validate($request,[
                    'name'=>'required|string|max:255|unique:users'
                ]);
                Auth::user()->name = $request["name"];
            }
            if (empty($request["first_name"])) {
                $request["first_name"] = Auth::user()->first_name;
                Auth::user()->first_name = NULL;
            }
            elseif($request["first_name"] != Auth::user()->first_name) {
                $this->validate($request,[
                    'first_name'=>'string|max:255'
                ]);
                Auth::user()->first_name = $request['first_name'];
            }
            if (empty($request["last_name"])) {
                $request["last_name"] = Auth::user()->last_name;
                Auth::user()->last_name = NULL;
            }
            elseif($request["last_name"] != Auth::user()->last_name) {
                $this->validate($request,[
                    'last_name'=>'string|max:255'
                ]);
                Auth::user()->last_name = $request['last_name'];
            }
            if ($request["email"] != Auth::user()->email) {
                $this->validate($request, [
                    'email'=>'required|string|email|max:255|unique:users'
                ]);
                Auth::user()->email = $request['email'];
            }

            $request_data = $request->All();

            if (!empty($request['current_password'])||!empty($request['new_password'])||!empty($request['new_password_confirm'])) {
                $validator = $this->passwordChangeValidation($request_data);
                if ($validator->fails()) {
                    return redirect('#')
                        ->withErrors($validator)
                        ->withInput();
                }
                Auth::user()->password = bcrypt($request['new_password']);
            }

            Auth::user()->save();

            return view('profile', array('user'=> Auth::user()));

        }
        else {
            return view("auth.login");
        }
    }
}
