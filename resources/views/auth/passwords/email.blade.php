@extends('layouts.adminlte.auth_form')

@section ('website_url', '../')

@section ('website_title', 'YCraft')
@section ('page_name', 'Password reset request')

@section ('website_name_first_part', 'Y')
@section ('website_name_second_part', 'Craft')

@section ('icon', 'fa fa-sign-in')

@section ('form_section')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ session('status') }}
        </div>
    @endif

    <div class="register-box-body">
        <p class="login-box-msg">Request a password reset</p>

        <form action="{{ route('password.email') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" name="email" class="form-control" placeholder="E-Mail Address" value="{{ old('email' )}}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
            </div>
            <!-- /.col -->
        </div>
        </form>
    </div>
    <!-- /.form-box -->

@endsection