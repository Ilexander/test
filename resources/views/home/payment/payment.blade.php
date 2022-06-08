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
                <button onclick="addPayment()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
                  <span>Add New Payment</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Type</th>
            <th>Min</th>
            <th>Max</th>
            <th>Status</th>
            <th>Take Fee</th>
            <th>Client Id</th>
            <th>Secret Key</th>
            <th>Limit</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($payments as $payment)
          <tr id="payment{{$payment->id}}">
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->name}}
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                     @if($payment->image_url)
                        <img class="footer_r" height="50" width="50" src="{{asset('storage/'.$payment->image_url)}}" alt="">
                    @endif
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->type}}
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->min}}
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->max}}
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  <button type="button" class="btn {{$payment->status ? 'btn-success' : 'btn-danger'}}"></button>
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  <button type="button" class="btn {{$payment->take_fee_from_user ? 'btn-success' : 'btn-danger'}}"></button>
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->client_id}}
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->secret_key}}
                </span>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-left align-items-center">
                <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$payment->limit}}
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
                  <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-slide-in" href="#" onclick="editPayment({{$payment->id}})">
                    <i data-feather="edit-2" class="me-50"></i>
                    <span>Edit</span>
                  </a>
                  <a class="dropdown-item" href="#" onclick="removePayment({{$payment->id}})">
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
      <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
          <form id="paymentCreateForm" class="modal-content pt-0" action="{{route('payment.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="paymentFormLabel">Add Payment</h5>
            </div>
            <div id="paymentFormMethod"></div>
            <div id="paymentFormPaymentId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="paymentFormName"
                        placeholder="Payment"
                        name="name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-uname">Image</label>
                <input
                        type="file"
                        id="basic-icon-default-uname"
                        class="form-control dt-uname"
                        name="image"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-email">Type</label>
                <input
                        type="text"
                        id="paymentFormType"
                        class="form-control dt-email"
                        placeholder="paymentService"
                        name="type"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-contact">Min</label>
                <input
                        type="number"
                        id="paymentFormMin"
                        class="form-control"
                        placeholder="10"
                        name="min"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-company">Max</label>
                <input
                        type="number"
                        id="paymentFormMax"
                        class="form-control"
                        placeholder="100"
                        name="max"
                />
              </div>
              <div class="mb-1">
                <div class="form-check form-check-inline">
                  <input type="hidden" value="0" name="status" />
                  <input class="form-check-input" name="status" type="checkbox" value="1" id="paymentFormActive" checked />
                  <label class="form-check-label" for="inlineCheckbox1">Is active</label>
                </div>
              </div>
              <div class="mb-1">
                <div class="form-check form-check-inline">
                  <input type="hidden" value="0" name="take_fee_from_user" />
                  <input class="form-check-input" name="take_fee_from_user" value="1" type="checkbox" id="paymentFormTakeFee" checked />
                  <label class="form-check-label" for="inlineCheckbox1">Take Fee</label>
                </div>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-company">Client Id</label>
                <input
                        type="text"
                        id="paymentFormClientId"
                        class="form-control"
                        placeholder="Some Id"
                        name="client_id"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-company">Secret key</label>
                <input
                        type="text"
                        id="paymentFormSecretKey"
                        class="form-control"
                        placeholder="Some Key"
                        name="secret_key"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-company">Limit</label>
                <input
                        type="number"
                        id="paymentFormLimit"
                        class="form-control"
                        placeholder="100"
                        name="limit"
                />
              </div>
              <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-company">Currency</label>
                  <div id="paymentCurrency"></div>
                  <button type="button" class="btn btn-primary me-1" onclick="addCurrency()">+</button>
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
      function addCurrency()
      {
          $.ajax({
              type: "GET",
              url: "{{route('currency.list', ['language' => Config::get('language.current')])}}",
              data: {
                  {{--_token : "{{csrf_token()}}"--}}
              }
          }).done(function(data) {
              var id = Math.floor((Math.random() * 10000) + 1);
              var currencies = '<div id="selector'+id+'" class="col-sm-12"><div class="col-sm-9" style="float: left;"><select name="currency[]" class="select2 form-select">';
              $.each(data.data, function( index, value ) {
                  currencies += '<option value="'+value.id+'">'+value.name+' ('+value.description+')</option>';
              });
              currencies += '</select></div>' +
                  '<div class="col-sm-3" style="float: left;"><button type="button" onclick="removeCurrency('+id+')" class="btn btn-danger">x</button></div>' +
                  '</div>';

              $('#paymentCurrency').append(currencies);
          });
      }

      function removeCurrency(Id)
      {
          $('#selector'+Id).remove();
      }

      function addPayment()
      {
          $('#paymentFormLabel').html('Add Payment');
          $('#paymentFormMethod').html('');
          $('#paymentFormPaymentId').html('');
          $('#paymentCreateForm').attr('action', '{{route('payment.create', ['language' => Config::get('language.current')])}}');
          $('#paymentFormName').val('');
          $('#paymentFormType').val('');
          $('#paymentFormMin').val('');
          $('#paymentFormMax').val('');
          $('#paymentFormActive').prop("checked", true);
          $('#paymentFormTakeFee').prop("checked", true);
          $('#paymentFormClientId').val('');
          $('#paymentFormSecretKey').val('');
          $('#paymentFormLimit').val('');
          $('#paymentCurrency').html('');
      }
      function removePayment(paymentId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('payment.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : paymentId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#payment'+paymentId).hide();
              }
          });
      }

      function editPayment(paymentId)
      {
          var currencies = '';
          $.ajax({
              type: "GET",
              url: "{{route('currency.list', ['language' => Config::get('language.current')])}}",
              data: {
                  {{--_token : "{{csrf_token()}}"--}}
              }
          }).done(function(data) {
              currencies = data.data;
          });

          $('#paymentFormLabel').html('Edit Payment');
          $('#paymentFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#paymentFormPaymentId').html('<input type="hidden" name="id" value="'+paymentId+'" />');
          $('#paymentCreateForm').attr('action', '{{route('payment.update', ['language' => Config::get('language.current')])}}');
          $('#paymentCurrency').html('');

          $.ajax({
              type: "GET",
              url: "{{route('payment.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : paymentId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {

              $('#paymentFormName').val(data.data.name);
              $('#paymentFormType').val(data.data.type);
              $('#paymentFormMin').val(data.data.min);
              $('#paymentFormMax').val(data.data.max);
              $('#paymentFormActive').prop("checked", data.data.status);
              $('#paymentFormTakeFee').prop("checked", data.data.take_fee_from_user);
              $('#paymentFormClientId').val(data.data.client_id);
              $('#paymentFormSecretKey').val(data.data.secret_key);
              $('#paymentFormLimit').val(data.data.limit);

              $.each(data.data.currencies, function( index, value ) {
                  var selector = '<div id="selector'+value.id+'" class="col-sm-12"><div class="col-sm-9" style="float: left;"><select name="currency[]" class="select2 form-select">';
                  $.each(currencies, function( key, currency ) {
                      if (value.currency_id === currency.id) {
                          selector += '<option selected value="'+currency.id+'">'+currency.name+' ('+currency.description+')</option>';
                      } else {
                          selector += '<option value="'+currency.id+'">'+currency.name+' ('+currency.description+')</option>';
                      }
                  });
                  selector += '</select></div>'+
                      '<div class="col-sm-3" style="float: left;"><button type="button" onclick="removeCurrency('+value.id+')" class="btn btn-danger">x</button></div>' +
                      '</div>';

                  $('#paymentCurrency').append(selector);
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
