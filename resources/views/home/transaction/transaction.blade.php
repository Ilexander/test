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
                  <div class="col-md-2">
                      <input type="search" name="user_filter" class="form-control" placeholder="User" aria-controls="DataTables_Table_0">
                  </div>
                  <div class="col-md-2">
                      <input type="search" name="transaction_id_filter" class="form-control" placeholder="Transaction ID" aria-controls="DataTables_Table_0">
                  </div>
                  <div class="col-md-2">
                      <select class="select2 form-select" id="select-payment" name="payment_filter">
                          <option value="">Payment</option>
                          @foreach($payments as $payment)
                              <option value="{{$payment->id}}">{{$payment->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-2">
                      <input type="search" name="amount_filter" class="form-control" placeholder="Amount (Includes Fee)" aria-controls="DataTables_Table_0">
                  </div>
                  <div class="col-md-2">
                      <input type="search" name="transaction_fee_filter" class="form-control" placeholder="Transaction Fee" aria-controls="DataTables_Table_0">
                  </div>
                  <div class="col-md-2">
                      <select class="select2 form-select" id="select-status" name="status_filter">
                          <option value="">Status</option>
                          @foreach($statuses as $key => $status)
                              <option value="{{$key}}">{{$status}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-md-2">
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
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>No.</th>
            <th>User</th>
            <th>Transaction id</th>
            <th>Payment Method</th>
            <th>Amount (Includes Fee)	</th>
            <th>Txn fee</th>
            <th>Created</th>
            <th>Status</th>

            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($transactions as $transaction)
            <tr id="payment{{$transaction->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$transaction->id}}
                      @if ($transaction->bonus)
                        <button
                                type="button"
                                class="btn btn-success btn-sm"
                                onclick="showBonus({{$transaction->id}})">+</button>
                      @endif
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$transaction->payer_email}}
                </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$transaction->transaction_id}}
                </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$transaction->payment->name}}
                </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$transaction->amount}}
                </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{$transaction->txn_fee}}
                </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                    {{$transaction->created_at}}
{{--                    {{Timezone::convertToLocal($transaction->created_at, 'Y-m-d H:i:s')}}--}}
                </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                <span class="fw-bolder">
                  {{\App\Models\Transaction::STATUS_LIST[$transaction->status]}}
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
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-slide-in" href="#" onclick="">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="">
                      <i data-feather="trash" class="font-medium-2"></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            @if ($transaction->bonus)
              <tr id="paymentBonus{{$transaction->id}}" style="display: none">
                <td colspan="4">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder">
                          Bonus
                      </span>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder">
                          {{$transaction->bonus->amount}}
                      </span>
                    </div>
                  </div>
                </td>
                <td colspan="4">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder">
                          {{$transaction->bonus->created_at}}
{{--                          {{Timezone::convertToLocal($transaction->bonus->created_at, 'Y-m-d H:i:s')}}--}}
                      </span>
                    </div>
                  </div>
                </td>
              </tr>
            @endif
          @endforeach
          </tbody>
        </table>
          {{
            $transactions->appends([
                "user_filter"               => $filters['user_filter'],
                "transaction_id_filter"     => $filters['transaction_id_filter'],
                "payment_filter"            => $filters['payment_filter'],
                "amount_filter"             => $filters['amount_filter'],
                "transaction_fee_filter"    => $filters['transaction_fee_filter'],
                "status_filter"             => $filters['status_filter'],
            ])->links()
          }}
      </div>
      <!-- Modal to add new user Ends-->
    </div>
    <!-- list and filter end -->
  </section>
  <!-- users list ends -->

  <script>
      function showBonus(transactionId)
      {
          if ($('#paymentBonus'+transactionId).is(":visible")) {
              $('#paymentBonus'+transactionId).hide();
          } else {
              $('#paymentBonus'+transactionId).show();
          }

      }
  </script>
@endsection

@section('vendor-script')

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
