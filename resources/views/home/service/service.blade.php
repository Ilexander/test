@extends('panel/master')

@section('title', 'Services')

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
                <button onclick="addService()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-service-in">
                  <span>Add New Service</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Provider</th>
            <th>Rate Per 1000($)</th>
            <th>Min / Max Order</th>
            <th>Description</th>
            <th>Drip-Feed</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($services as $service)
            <tr id="service{{$service->id}}">
              <td>{{$service->id}}</td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$service->name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$service->apiProvider->name}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                  <div class="justify-content-left align-items-center text-center">
                      <div>
                          {{$service->price}}
                      </div>
                      <small class="text-muted">
                          {{$service->original_price}}
                      </small>
                  </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$service->min}} / {{$service->max}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
{{--                      @bb($service->desc)--}}
                      <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#modals-service-descr"
                          href="#"
                          onclick="showServiceDescription({{$service->id}})"
                      >
                          Details
                      </button>
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      <button type="button" class="btn {{$service->dripfeed ? 'btn-success' : 'btn-danger'}}"></button>
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      <button type="button" class="btn {{$service->status ? 'btn-success' : 'btn-danger'}}"></button>
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
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-service-in" href="#" onclick="editService({{$service->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeService({{$service->id}})">
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

      <div class="modal modal-slide-in fade" id="modals-service-descr">
            <div class="modal-dialog modal-lg" style="width: 40rem">
                <form id="serviceCreateForm" class="modal-content pt-0" action="{{route('service.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="serviceFormLabel">Description</h5>
                    </div>

                    <div class="modal-body flex-grow-1">
                        <div id="serviceDescription"></div>
                        <br/>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
      <!-- Modal to add new user starts-->
      <div class="modal modal-slide-in fade" id="modals-service-in">
        <div class="modal-dialog modal-lg" style="width: 40rem">
          <form id="serviceCreateForm" class="modal-content pt-0" action="{{route('service.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="serviceFormLabel">Add Service</h5>
            </div>
            <div id="serviceFormMethod"></div>
            <div id="serviceFormServiceId"></div>

            <div class="modal-body flex-grow-1">
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                <input
                        type="text"
                        class="form-control dt-full-name"
                        id="serviceFormName"
                        placeholder="Service Name"
                        name="name"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Category</label>
                <select class="select2 form-select" id="serviceFormCategoryId" name="category_id">
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Type</label>
                <div class="form-check form-check-inline">
                  <input
                          class="form-check-input"
                          type="radio"
                          name="add_type"
                          id="addTypeManual"
                          value="manual"
                          checked
                  />
                  <label class="form-check-label" for="inlineRadio1">Manual</label>
                </div>
                <div class="form-check form-check-inline">
                  <input
                          class="form-check-input"
                          type="radio"
                          name="add_type"
                          id="addTypeApi"
                          value="api"
                  />
                  <label class="form-check-label" for="inlineRadio2">Api</label>
                </div>
              </div>
              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Api Provider Id</label>
                <select class="select2 form-select" id="serviceFormApiProviderId" name="api_provider_id">
                  @foreach($providers as $provider)
                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-fullname">List of API Services</label>
                  <select class="select2 form-select" id="serviceFormApiProviderServices" name="api_service_id">
                  </select>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-fullname">Original Price</label>
                  <input
                          type="number"
                          step="0.0001"
                          class="form-control dt-full-name"
                          id="serviceFormOriginalPrice"
                          placeholder="Service Original Price"
                          name="original_price"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Min</label>
                    <input
                            type="number"
                            class="form-control dt-full-name"
                            id="serviceFormMin"
                            name="min"
                            value="300"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Max</label>
                    <input
                            type="number"
                            class="form-control dt-full-name"
                            id="serviceFormMax"
                            name="max"
                            value="5000"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Price</label>
                    <input
                            type="text"
                            class="form-control dt-full-name"
                            id="serviceFormPrice"
                            name="price"
                            value="0.80"
                    />
                  </div>
                </div>
              </div>

              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Status</label>
                <input type="hidden" value="0" name="status" />
                <input class="form-check-input" type="checkbox" value="1" id="serviceFormStatus" name="status" />
              </div>

              <div class="mb-1">
                <label class="form-label" for="basic-icon-default-fullname">Description</label>
{{--                <input--}}
{{--                        type="text"--}}
{{--                        class="form-control dt-full-name"--}}
{{--                        id="serviceFormDesc"--}}
{{--                        placeholder="Service Description"--}}
{{--                        name="desc"--}}
{{--                />--}}
                <textarea
                    rows="10"
                    class="form-control square plugin_editor"
                    id="serviceFormDesc"
                    name="desc" ></textarea>
              </div>

              <input
                      type="hidden"
                      class="form-control dt-full-name"
                      id="serviceFormType"
                      placeholder="Service Type"
                      name="type"
              />
{{--              <div class="mb-1">--}}
{{--                <label class="form-label" for="basic-icon-default-fullname">Api Service Id</label>--}}
{{--                <input--}}
{{--                        type="text"--}}
{{--                        class="form-control dt-full-name"--}}
{{--                        id="serviceFormApiServiceId"--}}
{{--                        placeholder="Service ID"--}}
{{--                        name="api_service_id"--}}
{{--                />--}}
{{--              </div>--}}

{{--              <div class="mb-1">--}}
{{--                <label class="form-label" for="basic-icon-default-fullname">Drip Feed</label>--}}
{{--                <input type="hidden" value="0" name="dripfeed" />--}}
{{--                <input class="form-check-input" type="checkbox" value="1" id="serviceFormDripfeed" name="dripfeed" />--}}
{{--              </div>--}}

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

      function showServiceDescription(serviceId)
      {
          $.ajax({
              type: "GET",
              url: "{{route('service.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : serviceId
              }
          }).done(function(data) {
              $('#serviceDescription').html(data.data.desc);
          });
      }

      $('#serviceFormApiProviderServices').on('change', function (){
          $('#serviceFormMin').val($(this).find(':selected').data('min'));
          $('#serviceFormMax').val($(this).find(':selected').data('max'));
          $('#serviceFormOriginalPrice').val($(this).find(':selected').data('rate'));
          $('#serviceFormType').val($(this).find(':selected').data('type'));
      });


      $('#serviceFormApiProviderId').on('change', function (){

          $('#serviceFormPrice').val('0.80');

          setProviderServiceSelector($(this).val(), 0);
      });


      function setProviderServiceSelector(ApiProviderId, ServiceId)
      {
          $.ajax({
              type: "GET",
              url: "{{route('api-provider.services', ['language' => Config::get('language.current')])}}",
              data: {
                  id : ApiProviderId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {

              var result = '';

              if (typeof data.data.data !== 'undefined') {
                  result = data.data.data;
              } else {
                  result = data.data;
              }

              var services = '';
              var i = 0;

              $.each(result, function( index, value ) {
                  services += '<option ' +
                      'value="'+value.service+'" ' +
                      'data-min="'+value.min+'" ' +
                      'data-max="'+value.max+'" ' +
                      'data-rate="'+value.rate+'" ' +
                      'data-type="'+value.type+'" ' ;

                  if (value.service === ServiceId) {
                      services += ' selected ';
                  }

                  services += '>'+value.name+'</option>';

                  if (i === 0) {
                      $('#serviceFormMin').val(value.min);
                      $('#serviceFormMax').val(value.max);
                      $('#serviceFormOriginalPrice').val(value.rate);
                      $('#serviceFormType').val(value.type);

                      i++;
                  }
              });

              $('#serviceFormApiProviderServices').html(services);
              // $('#orderCategoryService').show();

          });
      }

      function addService()
      {
          $('#serviceFormLabel').html('Add Service');
          $('#serviceFormMethod').html('');
          $('#serviceFormServiceId').html('');
          $('#serviceCreateForm').attr('action', '{{route('service.create', ['language' => Config::get('language.current')])}}');
          $('#serviceFormName').val('');
          $('#serviceFormCategoryId').val('');
          $('#serviceFormDesc').val('');
          $('#serviceFormPrice').val('');
          $('#serviceFormOriginalPrice').val('');
          $('#serviceFormMin').val('');
          $('#serviceFormMax').val('');
          // $('#serviceFormAddType').val('');
          $('#serviceFormType').val('');
          $('#serviceFormApiServiceId').val('');
          $('#serviceFormApiProviderId').val('');
          $('#serviceFormDripfeed').prop('checked', false);
          $('#serviceFormStatus').prop('checked', false);

          $('#serviceFormCategoryId option').each(function (){
              $("#serviceFormCategoryId").val($(this).val()).trigger('change');
              return false;
          });

          // $('#serviceFormAddType option').each(function (){
          //     $("#serviceFormAddType").val($(this).val()).trigger('change');
          //     return false;
          // });

          $('#serviceFormApiProviderId option').each(function (){
              $("#serviceFormApiProviderId").val($(this).val()).trigger('change');
              return false;
          });
      }

      function removeService(serviceId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('service.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : serviceId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#service'+serviceId).hide();
              }
          });
      }

      function editService(serviceId)
      {
          $('#serviceFormLabel').html('Edit Service');
          $('#serviceFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#serviceFormServiceId').html('<input type="hidden" name="id" value="'+serviceId+'" />');
          $('#serviceCreateForm').attr('action', '{{route('service.update', ['language' => Config::get('language.current')])}}');

          $.ajax({
              type: "GET",
              url: "{{route('service.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : serviceId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              $('#serviceFormName').val(data.data.name);
              $('#serviceFormDesc').val(data.data.desc);
              $('#serviceFormPrice').val(data.data.price);
              $('#serviceFormOriginalPrice').val(data.data.original_price);
              $('#serviceFormMin').val(data.data.min);
              $('#serviceFormMax').val(data.data.max);
              $('#serviceFormApiProviderId').val('');
              $('#serviceFormType').val(data.data.type);
              $('#serviceFormDripfeed').prop('checked', data.data.dripfeed);
              $('#serviceFormStatus').prop('checked', data.data.status);


              $('#serviceFormCategoryId option').each(function (){
                  if ($(this).val() == data.data.category_id) {
                      $("#serviceFormCategoryId").val($(this).val()).trigger('change');
                  }
              });

              // addTypeManual

              if (data.data.add_type === "manual") {
                  $("#addTypeManual").prop('checked', true);
              }

              if (data.data.add_type === "api") {
                  $("#addTypeApi").prop('checked', true);
              }


              // $('#serviceFormAddType option').each(function (){
              //     if ($(this).val() == data.data.add_type) {
              //         $("#serviceFormAddType").val($(this).val()).trigger('change');
              //     }
              // });

              $('#serviceFormApiProviderId option').each(function (){
                  if ($(this).val() == data.data.api_provider_id) {
                      $("#serviceFormApiProviderId").val($(this).val()).trigger('change');
                  }
              });

              setProviderServiceSelector(data.data.api_provider_id, data.data.api_service_id);

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
