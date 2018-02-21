@extends ('layouts.adminlte.dashboard_area')
@extends ('layouts.adminlte.dashboard_area_navbar')
@extends ('layouts.adminlte.dashboard_area_side_navbar')

@section ('website_url', '/')

@section ('website_title', 'YCraft')
@section ('page_name', 'Dashboard Pages')

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
              <h3 class="box-title">Website Pages</h3>
              <div class="box-tools pull-right" data-toggle="tooltip" title="Create a new page">
                  <a type="button" href="/dashboard/pages/create" class="btn btn-default">New Page</i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="websitePagesTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Page ID</th>
                  <th>Page Title</th>
                  <th>Page URL</th>
                  <th>Page Content</th>
                  <th>Page Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $websitePagesItemsNumber = 0; ?>
                @while(true)
                  <tr>
                    @foreach ($websitePagesList[$websitePagesItemsNumber] as $websitePagesData)
                      <td>{{$websitePagesData}}</td>
                    @endforeach
                    <td>
                      <div class="btn-group">
                        <a href="/dashboard/pages/editpage/{{$websitePagesList[$websitePagesItemsNumber]->page_id}}" type="button" class="btn btn-primary btn-xs">Edit</a>
                        <a href="/dashboard/pages/confirmdeletepage/{{$websitePagesList[$websitePagesItemsNumber]->page_id}}" type="button" class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </td>
                    <?php $websitePagesItemsNumber ++; ?>
                    @if(!empty($websitePagesList[$websitePagesItemsNumber]))
                       @continue
                    @endif
                    @if(empty($websitePagesList[$websitePagesItemsNumber]))
                       @break
                    @endif
                  </tr>
                @endwhile
                </tbody>
                <tfoot>
                <tr>
                  <th>Page ID</th>
                  <th>Page Title</th>
                  <th>Page URL</th>
                  <th>Page Content</th>
                  <th>Page Actions</th>
                </tr>
                </tfoot>
              </table>

              <?php

              if ($confirmPageDelete) { ?>

                <div class="modal modal-danger fade" id="modal-danger">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Are you sure?</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete the <strong>{{ $targetPage->page_name }}</strong> page. Please confirm by typing in the name of the page in the field below!</p>
                        <form role="form" action="/dashboard/pages/deletepage/{{ $targetPage->page_id }}" method="post">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label>Name Of The Page</label>
                            <input oninput="pageDeleteConfirmButtonDisabledState()" id="confirm-page-delete-name-input-field" name="confirmPageDeleteName" class="form-control" type='text'>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                        <input id="page-delete-confirm-modal-form-submit-button" disabled type="submit" value="Delete" class="btn btn-outline">
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- Confirm Page Delete Modal End -->

              <?php } ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

@endsection

@section('scripts')

<!-- DataTables -->
<script src="{{URL::asset('/themes/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/themes/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{URL::asset('/themes/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

<script>
  $(function () {
    $('#websitePagesTable').DataTable()
  })
</script>

<?php

  if ($confirmPageDelete) { ?>

<script>
  var x = {{$confirmPageDelete}};
  if (x) {
    $('#modal-danger').modal('show');
  }
</script>

<script>
  function pageDeleteConfirmButtonDisabledState () {
    var x;
    x = document.getElementById("confirm-page-delete-name-input-field");
    if (x.value == "{{ $targetPage->page_name }}") {
      enableButton();
    }
    else {
      disableButton();
    }
  }
  function disableButton () {
    var x;
    x = document.getElementById("page-delete-confirm-modal-form-submit-button");
    if (x.disabled) {
        x.disabled = true;
    } else {
        x.disabled = true;
    }
  }
  function enableButton () {
    var x;
    x = document.getElementById("page-delete-confirm-modal-form-submit-button");
    if (x.disabled) {
        x.disabled = false;
    } else {
        x.disabled = false;
    }
  }
</script>

<?php } ?>

@endsection
