@extends('layouts.adminlte.auth_form')

@section ('website_url', '../')

@section ('website_title', 'YCraft')
@section ('page_name', 'Register')

@section ('website_name_first_part', 'Y')
@section ('website_name_second_part', 'Craft')

@section ('icon', 'fa fa-user-plus')

@section ('form_section')

    <div class="register-box-body">
        <p class="login-box-msg">Create a new account</p>

        <form action="/register" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" name="name" class="form-control" placeholder="Username" value="{{ old('name' )}}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email' )}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                <input type="password" name="password_confirm" class="form-control" placeholder="Retype password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password_confirm'))
                    <span class="help-block">{{ $errors->first('password_confirm') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <!--<div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a data-toggle="modal" data-target="#modal-terms">terms</a>
                        </label>
                    </div>-->
                    <a href="/login" class="btn btn-default btn-flat">I already have an account</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!--<a href="/login" class="text-center">I already have an account</a>-->
    </div>
    <!-- /.form-box -->
    <!-- modal-terms -->
    <div class="modal fade" id="modal-terms">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Terms</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal-terms -->

@endsection