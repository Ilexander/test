@extends('panel/master')

@section('title', 'User Prices')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
  <!-- users list start -->
  <section class="app-user-list">
    <!-- list and filter start -->
    <div class="card">
      <div class="card-body border-bottom">
        {{--        <h4 class="card-title">Search & Filter</h4>--}}
        {{--        <div class="row">--}}
        {{--          <div class="col-md-4 user_role"></div>--}}
        {{--          <div class="col-md-4 user_plan"></div>--}}
        {{--          <div class="col-md-4 user_status"></div>--}}
        {{--        </div>--}}
      </div>
      <div class="card-datatable table-responsive pt-0">
        <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
          <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
            <div class="dataTables_length" id="DataTables_Table_0_length">
              {{--              <label>Show--}}
              {{--                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">--}}
              {{--                  <option value="10">10</option>--}}
              {{--                  <option value="25">25</option>--}}
              {{--                  <option value="50">50</option>--}}
              {{--                  <option value="100">100</option>--}}
              {{--                </select>--}}
              {{--                entries--}}
              {{--              </label>--}}
            </div>
          </div>
          <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
            <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
              <div class="me-1">
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                  {{--                  <label>Search:--}}
                  {{--                    <input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">--}}
                  {{--                  </label>--}}
                </div>
              </div>
              <div class="dt-buttons d-inline-flex mt-50">
                <button onclick="addUserPrice()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-user-price-in">
                  <span>Add User Price</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>User</th>
            <th>Service</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($userPrices as $userPrice)
            <tr id="userPrice{{$userPrice->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$userPrice->user->first_name}} {{$userPrice->user->last_name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$userPrice->service->name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$userPrice->service_price}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-user-price-in" href="#" onclick="editUserPrice({{$userPrice->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeUserPrice({{$userPrice->id}})">
                      <i data-feather="trash" class="font-medium-2"></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- Modal to add new user starts-->
      <div class="modal modal-slide-in fade" id="modals-user-price-in">
        <div class="modal-dialog modal-lg" style="width: 40rem">
          <form id="userPriceCreateForm" class="modal-content pt-0" action="{{route('user-price.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="userPriceFormLabel">Add User Price</h5>
            </div>
            <div id="userPriceFormMethod"></div>
            <div id="userPriceFormUserPriceId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">User</label>
                <select class="select2 form-select" id="userPriceFormUserId" name="user_id">
                  @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Service</label>
                <select class="select2 form-select" id="userPriceFormServiceId" name="service_id">
                  @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Price</label>
                <input
                        type="number"
                        step="0.0001"
                        class="form-control dt-full-name"
                        id="userPriceFormPrice"
                        name="service_price"
                />
              </div>

              <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Modal to add new user Ends-->
    </div>
    <!-- list and filter end -->
  </section>
  <!-- users list ends -->
@endsection

@section('vendor-script')
  <script>

      function addUserPrice()
      {
          $('#userPriceFormLabel').html('Add User Price');
          $('#userPriceFormMethod').html('');
          $('#userPriceFormUserPriceId').html('');
          $('#userPriceCreateForm').attr('action', '{{route('user-price.create', ['language' => Config::get('language.current')])}}');
          $('#userPriceFormPrice').val('');

          $('#userPriceFormUserId option').each(function (){
              $("#userPriceFormUserId").val($(this).val()).trigger('change');
              return false;
          });

          $('#userPriceFormServiceId option').each(function (){
              $("#userPriceFormServiceId").val($(this).val()).trigger('change');
              return false;
          });
      }

      function removeUserPrice(userPriceId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('user-price.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : userPriceId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#userPrice'+userPriceId).hide();
              }
          });
      }

      function editUserPrice(userPriceId)
      {
          $('#userPriceFormLabel').html('Edit Service');
          $('#userPriceFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#userPriceFormUserPriceId').html('<input type="hidden" name="id" value="'+userPriceId+'" />');
          $('#userPriceCreateForm').attr('action', '{{route('user-price.update', ['language' => Config::get('language.current')])}}');

          $.ajax({
              type: "GET",
              url: "{{route('user-price.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : userPriceId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {

              $('#userPriceFormPrice').val(data.data.service_price);

              $('#userPriceFormUserId option').each(function (){
                  if ($(this).val() == data.data.user_id) {
                      $("#userPriceFormUserId").val($(this).val()).trigger('change');
                  }
              });

              $('#userPriceFormServiceId option').each(function (){
                  if ($(this).val() == data.data.service_id) {
                      $("#userPriceFormServiceId").val($(this).val()).trigger('change');
                  }
              });

          });
      }
  </script>
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
@endsection