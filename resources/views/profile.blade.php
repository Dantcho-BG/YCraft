@extends ('layouts.adminlte.dashboard_area')
@extends ('layouts.adminlte.dashboard_area_navbar')
@extends ('layouts.adminlte.dashboard_area_side_navbar')

@section ('website_url', '/')

@section ('website_title', 'YCraft')
@section ('page_name', $user->name.'\'s Profile')

@section ('mini_website_name_first_part', 'Y')
@section ('mini_website_name_second_part', 'C')

@section ('website_name_first_part', 'Y')
@section ('website_name_second_part', 'Craft')

@section ('content')

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{URL::asset('/uploads/avatars/'.Auth::user()->avatar)}}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                    <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                </div>
                <div class="box-body box-profile">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>First name</b> <a class="pull-right">{{ Auth::user()->first_name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Last name</b> <a class="pull-right">{{ Auth::user()->last_name }}</a>
                        </li>
                    </ul>

                    <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile_settings_section" data-toggle="tab">Profile Settings</a></li>
                    <li><a href="#profile_image" data-toggle="tab">Profile Image</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="profile_settings_section">
                        <form method="POST" action="/profile" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" id="inputUsername" placeholder="Username">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" id="inputFirstName" placeholder="First Name">
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" id="inputLastName" placeholder="LastName">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" id="inputEmail" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                    <label for="inputCurrentPassword" class="col-sm-2 control-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="current_password" id="inputCurrentPassword" placeholder="Current Password">
                                        @if ($errors->has('current_password'))
                                            <span class="help-block">{{ $errors->first('current_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                    <label for="inputNewPassword" class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="new_password" id="inputNewPassword" placeholder="New Password">
                                        @if ($errors->has('new_password'))
                                            <span class="help-block">{{ $errors->first('new_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('new_password_confirm') ? ' has-error' : '' }}">
                                    <label for="inputNewPasswordConfirm" class="col-sm-2 control-label">Retype New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="new_password_confirm" id="inputNewPasswordConfirm" placeholder="Retype New Password">
                                        @if ($errors->has('new_password_confirm'))
                                            <span class="help-block">{{ $errors->first('new_password_confirm') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" name="change_profile_details" value="change_profile_details" class="btn btn-info pull-right">Save Changes</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <div class="tab-pane" id="profile_image">
                        <form enctype="multipart/form-data" action="/profile" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                    <label for="profileImageUpload" class="col-sm-2 control-label">Update Profile Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="avatar" class="form-control" id="profileImageUpload">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <label data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Does't work if an image is submited">
                                        <input type="checkbox" name="profileImageReload" {{ old('profileImageReload') ? 'checked' : ''}}> Set Default Image
                                    </label>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" name="change_profile_pic" value="change_profile_pic" class="btn btn-info pull-right">Upload</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

@endsection
