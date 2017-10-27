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
            <div class="box-header">
              <h3 class="box-title">New Page</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

@endsection
