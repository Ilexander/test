@extends('panel/master')

@section('title', 'Api Providers')

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
                <button onclick="addApiProvider()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-api-provider-in">
                  <span>Add New Api Provider</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Url</th>
            <th>Key</th>
            <th>Type</th>
            <th>Balance</th>
            <th>Currency Code</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($apiProviders as $apiProvider)
            <tr id="apiProvider{{$apiProvider->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->url}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->key}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->type}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->balance}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->currency_code}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->description}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$apiProvider->status}}
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
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-api-provider-in" href="#" onclick="editApiProvider({{$apiProvider->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeApiProvider({{$apiProvider->id}})">
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
      <div class="modal modal-slide-in new-user-modal fade" id="modals-api-provider-in">
        <div class="modal-dialog">
          <form id="apiProviderCreateForm" class="modal-content pt-0" action="{{route('api-provider.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="apiProviderFormLabel">Add Api Provider</h5>
            </div>
            <div id="apiProviderFormMethod"></div>
            <div id="apiProviderFormApiProviderId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="apiProviderFormName"
                        placeholder="Api Provider Name"
                        name="name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Url</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="apiProviderFormUrl"
                        placeholder="Api Provider Url"
                        name="url"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Key</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="apiProviderFormKey"
                        placeholder="Api Provider Key"
                        name="key"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Type</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="apiProviderFormType"
                        placeholder="Api Provider Type"
                        name="type"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Balance</label>
                <input
                        type="number"
                        step="0.01"
                        class="form-control dt-full-name"
                        id="apiProviderFormBalance"
                        placeholder="Api Provider Balance"
                        name="balance"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Currency code</label>
                <select class="select2 form-select" id="apiProviderFormCurrencyCode" name="currency_code">
                  @foreach($currencies as $currency)
                    <option value="{{$currency->description}}">{{$currency->name}} ({{$currency->description}})</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Description</label>
                <textarea
                        rows="10"
                        class="form-control square plugin_editor"
                        id="apiProviderFormDescription"
                        name="description" ></textarea>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Active</label>
                <input type="hidden" value="0" name="status" />
                <input class="form-check-input" type="checkbox" value="1" id="apiProviderFormStatus" name="status" />
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
      function addApiProvider()
      {
          $('#apiProviderFormLabel').html('Add Api Provider');
          $('#apiProviderFormMethod').html('');
          $('#apiProviderFormApiProviderId').html('');
          $('#apiProviderCreateForm').attr('action', '{{route('api-provider.create', ['language' => Config::get('language.current')])}}');
          $('#apiProviderFormName').val('');
          $('#apiProviderFormUrl').val('');
          $('#apiProviderFormKey').val('');
          $('#apiProviderFormType').val('');
          $('#apiProviderFormBalance').val('');
          $('#apiProviderFormDescription').val('');
          $('#apiProviderFormStatus').prop('checked', false);
      }

      function removeApiProvider(apiProviderId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('api-provider.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : apiProviderId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#apiProvider'+apiProviderId).hide();
              }
          });
      }

      function editApiProvider(apiProviderId)
      {
          $('#apiProviderFormLabel').html('Edit Api Provider');
          $('#apiProviderFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#apiProviderFormApiProviderId').html('<input type="hidden" name="id" value="'+apiProviderId+'" />');
          $('#apiProviderCreateForm').attr('action', '{{route('api-provider.update', ['language' => Config::get('language.current')])}}');

          $.ajax({
              type: "GET",
              url: "{{route('api-provider.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : apiProviderId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {

              $('#apiProviderFormName').val(data.data.name);
              $('#apiProviderFormUrl').val(data.data.url);
              $('#apiProviderFormKey').val(data.data.key);
              $('#apiProviderFormType').val(data.data.type);
              $('#apiProviderFormBalance').val(data.data.balance);
              $('#apiProviderFormDescription').val(data.data.description);
              $('#apiProviderFormStatus').prop('checked', data.data.status);


              $('#apiProviderFormCurrencyCode option').each(function (){
                  if ($(this).val() === data.data.currency_code) {
                      $("#apiProviderFormCurrencyCode").val($(this).val()).trigger('change');
                  }
              })
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