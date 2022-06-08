@extends('panel/master')

@section('title', 'Payments')

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
        <h4 class="card-title">Search & Filter</h4>
        <form action="#" method="GET">
            <div class="row">
              <div class="col-md-4">
                  <input type="search" name="email" class="form-control" placeholder="Email" aria-controls="DataTables_Table_0">
              </div>
              <div class="col-md-4">
                  <input type="search" name="first_last_name" class="form-control" placeholder="First Name + Last Name" aria-controls="DataTables_Table_0">
              </div>

              <div class="col-md-4">
                  <button
                      class="dt-button add-new btn btn-primary"
                      tabindex="0"
                      aria-controls="DataTables_Table_0"
                      type="submit"
                  >
                      <span>Filter</span>
                  </button>
              </div>

            </div>
        </form>
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
                <button onclick="addUser()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-user-in">
                  <span>Add New User</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Balance</th>
            <th>Timezone</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
            <tr id="user{{$user->id}}">
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->balance}}</td>
              <td>{{$user->timezone}}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-user-in" href="#" onclick="editUser({{$user->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeUser({{$user->id}})">
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
      <div class="card-datatable table-responsive pt-0">
          {{ $users->appends(['email' => $filters['email'], 'first_last_name' => $filters['first_last_name']])->links() }}
      </div>
      <!-- Modal to add new user starts-->
      <div class="modal modal-slide-in new-user-modal fade" id="modals-user-in">
        <div class="modal-dialog">
          <form id="userCreateForm" class="modal-content pt-0" action="{{route('user.add', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="userFormLabel">Add User</h5>
            </div>
            <div id="userFormMethod"></div>
            <div id="userFormUserId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">First Name</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="userFormFirstName"
                        placeholder="First Name"
                        name="first_name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-email">Last Name</label>
                <input
                        type="text"
                        id="userFormLastName"
                        class="form-control dt-email"
                        placeholder="Last Name"
                        name="last_name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-contact">Email</label>
                <input
                        type="text"
                        id="userFormEmail"
                        class="form-control"
                        placeholder="User Email"
                        name="email"
                />
              </div>

              <div class="mb-1" id="userBalance">
                  <label class="form-label" for="basic-icon-default-contact">Balance</label>
                  <input
                      type="number"
                      id="userFormBalance"
                      class="form-control"
                      placeholder="User Balance"
                      name="balance"
                  />
              </div>

              <div class="mb-1" id="userChangePassword">
                <label class="form-label" for="basic-icon-default-contact">New Password</label>
                <input
                        type="text"
                        id="userFormChangePassword"
                        class="form-control"
                        placeholder="Password"
                        name="change_password"
                />
              </div>
              <div class="mb-1" id="userPassword">
                <label class="form-label" for="basic-icon-default-contact">Password</label>
                <input
                        type="password"
                        id="userFormPassword"
                        class="form-control"
                        placeholder="Password"
                        name="password"
                />
              </div>
              <div class="mb-1" id="userConfirmPassword">
                <label class="form-label" for="register-password">Confirm Password</label>
                <div class="input-group input-group-merge form-password-toggle">
                  <input class="form-control form-control-merge" id="userFormPasswordConfirm" type="password" name="password_confirmation" placeholder="············" aria-describedby="register-password" tabindex="3" />
                  <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
              </div>
              <div class="mb-1">
                <label class="form-label" for="select-timezone">Timezone</label>
                <select class="select2 form-select" id="select-timezone" name="timezone">
                  @foreach($timezoneList as $name => $timezone)
                    <option value="{{$name}}">({{$timezone['diff_from_gtm']}}) {{$name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-1">
                <label class="form-label" for="select-timezone">Role</label>
                <select class="select2 form-select" id="select-role" name="role_id">
                  @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-1">
                Closed payment systems
                <div id="canceledPayment"></div>
                <button type="button" class="btn btn-primary me-1" onclick="addCanceledPayment()">+</button>
              </div>
              <div class="mb-1">
                Personal service price
                <div id="personalPrice"></div>
                <button type="button" class="btn btn-primary me-1" onclick="addPersonalPrice()">+</button>
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

      function addPersonalPrice()
      {
          $.ajax({
              type: "GET",
              url: "{{route('service.list', ['language' => Config::get('language.current')])}}",
              data: {}
          }).done(function(data) {
              var id = Math.floor((Math.random() * 10000) + 1);
              var services =
                  '<div id="service'+id+'" class="col-sm-12 row">' +
                    '<div class="col-sm-8">' +
                  // '<div class="row">' +
                    '<select name="services['+id+'][service]" class="select2 form-select">';
              $.each(data.data, function( index, value ) {
                  services += '<option value="'+value.id+'">'+value.name+'</option>';
              });
              services += '</select>' +
                  '<input class="form-control dt-full-name" type="number" name="services['+id+'][priceValue]">' +
                  '</div>' +
                  '<div class="col-sm-3" style="float: left;">' +
                  '<button type="button" onclick="removePersonalPrice('+id+')" class="btn btn-danger">x</button>' +
                  '</div>' +
                  '</div>';

              $('#personalPrice').append(services);
          });
      }

      function removePersonalPrice(id)
      {
          $('#service'+id).remove();
      }

      function addCanceledPayment()
      {
          $.ajax({
              type: "GET",
              url: "{{route('payment.all', ['language' => Config::get('language.current')])}}",
              data: {
                {{--_token : "{{csrf_token()}}"--}}
              }
          }).done(function(data) {
              var id = Math.floor((Math.random() * 10000) + 1);
              var payments = '<div id="selector'+id+'" class="col-sm-12"><div class="col-sm-9" style="float: left;"><select name="payments[]" class="select2 form-select">';
              $.each(data.data, function( index, value ) {
                  payments += '<option value="'+value.id+'">'+value.name+'</option>';
              });
              payments += '</select></div>' +
                  '<div class="col-sm-3" style="float: left;"><button type="button" onclick="removeCanceledPayment('+id+')" class="btn btn-danger">x</button></div>' +
                  '</div>';

              $('#canceledPayment').append(payments);
          });
      }

      function removeCanceledPayment(id)
      {
          $('#selector'+id).remove();
      }

      // function removeCurrency(Id)
      // {
      //     $('#selector'+Id).remove();
      // }

      function addUser()
      {
          $('#userChangePassword').hide();
          $('#userBalance').hide();
          $('#userPassword').show();
          $('#userConfirmPassword').show();
          $('#userFormLabel').html('Add User');
          $('#userFormMethod').html('');
          $('#userFormUserId').html('');
          $('#userCreateForm').attr('action', '{{route('user.add', ['language' => Config::get('language.current')])}}');
          $('#userFormFirstName').val('');
          $('#userFormLastName').val('');
          $('#userFormEmail').val('');
          $('#userFormPassword').val('');
          $('#userFormPasswordConfirm').val('');
          $('#userFormBalance').val('');
          $('#userFormChangePassword').val('');
          $('#canceledPayment').html('');
          $('#personalPrice').html('');
          // $('#paymentFormSecretKey').val('');
          // $('#paymentFormLimit').val('');
          // $('#paymentCurrency').html('');
      }

      function removeUser(userId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('user.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : userId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#user'+userId).hide();
              }
          });
      }

      function editUser(userId)
      {
          $('#userChangePassword').show();
          $('#userBalance').show();
          $('#userPassword').hide();
          $('#userConfirmPassword').hide();
          $('#userFormLabel').html('Edit User');
          $('#userFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#userFormUserId').html('<input type="hidden" name="id" value="'+userId+'" />');
          $('#userCreateForm').attr('action', '{{route('user.update', ['language' => Config::get('language.current')])}}');
          $('#personalPrice').html('');

          var paymentsList = null;

          $.ajax({
              type: "GET",
              url: "{{route('payment.all', ['language' => Config::get('language.current')])}}",
              data: {
                  {{--_token : "{{csrf_token()}}",--}}
              }
          }).done(function(data) {
              paymentsList = data.data;
          });

          var servicesList = null;

          $.ajax({
              type: "GET",
              url: "{{route('service.list', ['language' => Config::get('language.current')])}}",
              data: {
                {{--_token : "{{csrf_token()}}",--}}
              }
          }).done(function(data) {
              servicesList = data.data;
          });

          $.ajax({
              type: "GET",
              url: "{{route('user.info', ['language' => Config::get('language.current')])}}",
              data: {
                  {{--_token : "{{csrf_token()}}",--}}
                  id : userId
              }
          }).done(function(data) {
              $('#userFormFirstName').val(data.data.first_name);
              $('#userFormLastName').val(data.data.last_name);
              $('#userFormEmail').val(data.data.email);
              $('#userFormBalance').val(data.data.balance);
              $('#userFormPassword').val();
              $('#userFormPasswordConfirm').val('');

              $('#select-timezone option').each(function (){
                  if (data.data.timezone === $(this).val()) {
                      $("#select-timezone").val($(this).val()).trigger('change');
                  }
              });

              $('#select-role option').each(function (){
                  if (data.data.role_id == $(this).val()) {
                      $("#select-role").val($(this).val()).trigger('change');
                  }
              });

              $.each(data.data.user_price, function( key, item ) {
                  var services =
                      '<div id="service'+item.id+'" class="col-sm-12 row">' +
                      '<div class="col-sm-8">' +
                      // '<div class="row">' +
                      '<select name="services['+item.id+'][service]" class="select2 form-select">';

                  $.each(servicesList, function( index, value ) {
                      if (item.service_id === value.id) {
                          services += '<option value="'+value.id+'" selected>'+value.name+'</option>';
                      } else {
                          services += '<option value="'+value.id+'">'+value.name+'</option>';
                      }
                  });
                  services += '</select>' +
                      '<input class="form-control dt-full-name" value="'+item.service_price+'" type="number" name="services['+item.id+'][priceValue]">' +
                      '</div>' +
                      '<div class="col-sm-3" style="float: left;">' +
                      '<button type="button" onclick="removePersonalPrice('+item.id+')" class="btn btn-danger">x</button>' +
                      '</div>' +
                      '</div>';

                  $('#personalPrice').append(services);
              });

              $.each(data.data.canceled_payments, function( key, item ) {
                  var payments = '<div id="selector'+item.id+'" class="col-sm-12"><div class="col-sm-9" style="float: left;"><select name="payments[]" class="select2 form-select">';

                  $.each(paymentsList, function( index, value ) {
                      if (value.id == item.payment_id) {
                          payments += '<option value="'+value.id+'" selected>'+value.name+'</option>';
                      } else {
                          payments += '<option value="'+value.id+'">'+value.name+'</option>';
                      }

                  });
                  payments += '</select></div>' +
                      '<div class="col-sm-3" style="float: left;"><button type="button" onclick="removeCanceledPayment('+item.id+')" class="btn btn-danger">x</button></div>' +
                      '</div><br/>';

                  $('#canceledPayment').append(payments);
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
