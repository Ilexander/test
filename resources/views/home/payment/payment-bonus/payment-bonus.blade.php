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
                <button onclick="addPaymentBonus()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-payment-bonus-in">
                  <span>Add Payment Bonus</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>No.</th>
            <th>Method</th>
            <th>Bonus Percentage</th>
            <th>bonus Start Funds</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($paymentBonuses as $paymentBonus)
            <tr id="paymentBonus{{$paymentBonus->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$paymentBonus->id}}
                    </span>
                  </div>
                </div>
              </td>

              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$paymentBonus->payment->name}}
                    </span>
                  </div>
                </div>
              </td>

              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$paymentBonus->percentage}} %
                    </span>
                  </div>
                </div>
              </td>

              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$paymentBonus->bonus_start_funds}}
                    </span>
                  </div>
                </div>
              </td>

              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      <button type="button" class="btn {{$paymentBonus->status ? 'btn-success' : 'btn-danger'}}"></button>
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
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-payment-bonus-in" href="#" onclick="editPaymentBonus({{$paymentBonus->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removePaymentBonus({{$paymentBonus->id}})">
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
      <div class="modal modal-slide-in fade" id="modals-payment-bonus-in">
        <div class="modal-dialog modal-lg" style="width: 40rem">
          <form id="paymentBonusCreateForm" class="modal-content pt-0" action="{{route('payment-bonus.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="paymentBonusFormLabel">Add Payment Bonus</h5>
            </div>
            <div id="paymentBonusFormMethod"></div>
            <div id="paymentBonusFormPaymentBonusId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Payment</label>
                <select class="select2 form-select" id="paymentBonusFormPaymentId" name="payment_id">
                  @foreach($payments as $payment)
                    <option value="{{$payment->id}}">{{$payment->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Bonus Start Funds</label>
                <input
                        type="number"
                        step="1"
                        class="form-control dt-full-name"
                        id="paymentBonusFormPrice"
                        name="bonus_start_funds"
                />
              </div>

              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Percentage</label>
                <input
                        type="number"
                        step="1"
                        min="1"
                        max="100"
                        class="form-control dt-full-name"
                        id="paymentBonusFormPercentage"
                        name="percentage"
                />
              </div>

              <div class="mb-1">
                <div class="form-check form-check-inline">
                  <input type="hidden" value="0" name="status" />
                  <input class="form-check-input" name="status" value="1" type="checkbox" id="paymentBonusFormStatus" checked />
                  <label class="form-check-label" for="inlineCheckbox1">Is Active</label>
                </div>
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

      function addPaymentBonus()
      {
          $('#paymentBonusFormLabel').html('Add Payment Bonus');
          $('#paymentBonusFormMethod').html('');
          $('#paymentBonusFormPaymentBonusId').html('');
          $('#paymentBonusCreateForm').attr('action', '{{route('payment-bonus.create', ['language' => Config::get('language.current')])}}');

          $('#paymentBonusFormPrice').val('');
          $('#paymentBonusFormPercentage').val('');
          $('#paymentBonusFormStatus').prop("checked", true);

          $('#paymentBonusFormPaymentId option').each(function (){
              $("#paymentBonusFormPaymentId").val($(this).val()).trigger('change');
              return false;
          });

      }

      function removePaymentBonus(paymentBonusId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('payment-bonus.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : paymentBonusId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#paymentBonus'+paymentBonusId).hide();
              }
          });
      }

      function editPaymentBonus(paymentBonusId)
      {
          $('#paymentBonusFormLabel').html('Edit Payment Bonus');
          $('#paymentBonusFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#paymentBonusFormPaymentBonusId').html('<input type="hidden" name="id" value="'+paymentBonusId+'" />');
          $('#paymentBonusCreateForm').attr('action', '{{route('payment-bonus.update', ['language' => Config::get('language.current')])}}');

          $.ajax({
              type: "GET",
              url: "{{route('payment-bonus.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : paymentBonusId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              $('#paymentBonusFormPrice').val(data.data.bonus_start_funds);
              $('#paymentBonusFormPercentage').val(data.data.percentage);
              $('#paymentBonusFormStatus').prop("checked", data.data.status);
              $("#paymentBonusFormPaymentId").val(data.data.payment_id).trigger('change');
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