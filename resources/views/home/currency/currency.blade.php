@extends('panel/master')

@section('title', 'Currencies')

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
                                <button onclick="addCurrency()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-currency-in">
                                    <span>Add New Currency</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Payment id</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currencies as $currency)
                        <tr id="currency{{$currency->id}}">
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$currency->name}}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$currency->description}}
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
                                        <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-currency-in" href="#" onclick="editCurrency({{$currency->id}})">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="removeCurrency({{$currency->id}})">
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
            <div class="modal modal-slide-in new-user-modal fade" id="modals-currency-in">
                <div class="modal-dialog">
                    <form id="currencyCreateForm" class="modal-content pt-0" action="{{route('currency.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="currencyFormLabel">Add Currency</h5>
                        </div>
                        <div id="currencyFormMethod"></div>
                        <div id="currencyFormCurrencyId"></div>

                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                <input
                                        type="text"
                                        class="form-control dt-full-name"
                                        id="currencyFormName"
                                        placeholder="Currency"
                                        name="name"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Description</label>
                                <input
                                        type="text"
                                        id="currencyFormDescription"
                                        class="form-control dt-email"
                                        placeholder="currencyDescription"
                                        name="description"
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
        function addCurrency()
        {
            $('#currencyFormLabel').html('Add Currency');
            $('#currencyFormMethod').html('');
            $('#currencyFormCurrencyId').html('');
            $('#currencyCreateForm').attr('action', '{{route('currency.create', ['language' => Config::get('language.current')])}}');
            $('#currencyFormName').val('');
            $('#currencyFormDescription').val('');
        }

        function removeCurrency(currencyId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{route('currency.delete', ['language' => Config::get('language.current')])}}",
                data: {
                    id : currencyId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    $('#currency'+currencyId).hide();
                }
            });
        }

        function editCurrency(currencyId)
        {
            $('#currencyFormLabel').html('Edit Currency');
            $('#currencyFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
            $('#currencyFormCurrencyId').html('<input type="hidden" name="id" value="'+currencyId+'" />');
            $('#currencyCreateForm').attr('action', '{{route('currency.update', ['language' => Config::get('language.current')])}}');

            $.ajax({
                type: "GET",
                url: "{{route('currency.info', ['language' => Config::get('language.current')])}}",
                data: {
                    id : currencyId
                }
            }).done(function(data) {
                $('#currencyFormName').val(data.data.name);
                $('#currencyFormDescription').val(data.data.description);
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