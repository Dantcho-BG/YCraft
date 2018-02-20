@extends ('layouts.adminlte.dashboard_area')
@extends ('layouts.adminlte.dashboard_area_navbar')
@extends ('layouts.adminlte.dashboard_area_side_navbar')

@section ('website_url', '/')

@section ('website_title', 'YCraft')
@section ('page_name', 'Dashboard New Page')

@section ('mini_website_name_first_part', 'Y')
@section ('mini_website_name_second_part', 'C')

@section ('website_name_first_part', 'Y')
@section ('website_name_second_part', 'Craft')

@section ('header_links')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('/themes/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection

@section ('content')

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">New Page</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="/dashboard/pages/create" method="post">
                {{ csrf_field() }}
                <!-- text input -->
                <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}">
                  <label>Page Name</label>
                  <input type="text" class="form-control" name="page_name" value="{{ old('page_name' )}}" placeholder="Example: MyPage">
                  @if ($errors->has('page_name'))
                      <span class="help-block">{{ $errors->first('page_name') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('page_slug') ? ' has-error' : '' }}">
                  <label>Page URL</label>
                  <input type="text" class="form-control" name="page_slug" value="{{ old('page_slug' )}}" placeholder="Example: mypage">
                  @if ($errors->has('page_slug'))
                      <span class="help-block">{{ $errors->first('page_slug') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('page_columns') ? ' has-error' : '' }}">
                  <label>Page Columns</label>
                  <select class="form-control" name="page_columns">
                    <option value="0">One column</option>
                    <option value="1">Two columns (75% in the left and 25% in the right)</option>
                  </select>
                  @if ($errors->has('page_columns'))
                      <span class="help-block">{{ $errors->first('page_columns') }}</span>
                  @endif
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Create Page</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

@endsection
