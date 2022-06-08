@extends('panel/master')

@section('title', 'Categories')

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
                <button onclick="addSubscriber()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-subscriber-in">
                  <span>Add New Subscriber</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>IP</th>
            <th>Country Code</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($subscribers as $subscriber)
            <tr id="subscriber{{$subscriber->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$subscriber->id}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$subscriber->first_name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$subscriber->last_name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$subscriber->email}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$subscriber->ip}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$subscriber->country_code}}
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
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-subscriber-in" href="#" onclick="editSubscriber({{$subscriber->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeSubscriber({{$subscriber->id}})">
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
      <div class="modal modal-slide-in new-user-modal fade" id="modals-subscriber-in">
        <div class="modal-dialog">
          <form id="subscriberCreateForm" class="modal-content pt-0" action="{{route('subscribe.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="subscriberFormLabel">Add Subscriber</h5>
            </div>
            <div id="subscriberFormMethod"></div>
            <div id="subscriberFormSubscriberId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">First Name</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="subscriberFormFirstName"
                        placeholder="First Name"
                        name="first_name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-email">Last Name</label>
                <input
                        type="text"
                        id="subscriberFormLastName"
                        class="form-control dt-email"
                        placeholder="Last Name"
                        name="last_name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-email">Email</label>
                <input
                        type="text"
                        id="subscriberFormEmail"
                        class="form-control dt-email"
                        placeholder="Email"
                        name="email"
                />
              </div>
              <div class="mb-1 subscriber-edit-only" style="display: none">
                <label class="form-label" for="basic-icon-default-email">IP</label>
                <input
                        type="text"
                        id="subscriberFormIp"
                        class="form-control dt-email"
                        placeholder="IP"
                        name="ip"
                />
              </div>
              <div class="mb-1 subscriber-edit-only" style="display: none">
                <label class="form-label" for="basic-icon-default-email">Country Code</label>
                <input
                        type="text"
                        id="subscriberFormCountryCode"
                        class="form-control dt-email"
                        placeholder="Country Code"
                        name="country_code"
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
      function addSubscriber()
      {
          $('#subscriberFormLabel').html('Add Subscriber');
          $('#subscriberFormMethod').html('');
          $('#subscriberFormBlogId').html('');
          $('#subscriberCreateForm').attr('action', '{{route('subscribe.create', ['language' => Config::get('language.current')])}}');
          $('#subscriberFormFirstName').val('');
          $('#subscriberFormLastName').val('');
          $('#subscriberFormEmail').val('');
          $('#subscriberFormIp').val('');
          $('#subscriberFormCountryCode').val('');
          $('.subscriber-edit-only').hide();
      }

      function removeSubscriber(subscriberId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('subscribe.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : subscriberId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#subscriber'+subscriberId).hide();
              }
          });
      }

      function editSubscriber(subscriberId)
      {
          $('#subscriberFormLabel').html('Edit Subscriber');
          $('#subscriberFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#subscriberFormSubscriberId').html('<input type="hidden" name="id" value="'+subscriberId+'" />');
          $('#subscriberCreateForm').attr('action', '{{route('subscribe.update', ['language' => Config::get('language.current')])}}');
          $('.subscriber-edit-only').show();

          $.ajax({
              type: "GET",
              url: "{{route('subscribe.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : subscriberId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              $('#subscriberFormFirstName').val(data.data.first_name);
              $('#subscriberFormLastName').val(data.data.last_name);
              $('#subscriberFormEmail').val(data.data.email);
              $('#subscriberFormIp').val(data.data.ip);
              $('#subscriberFormCountryCode').val(data.data.country_code);
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