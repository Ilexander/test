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
                <button onclick="addOrder()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-order-in">
                  <span>Add New Order</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>Order ID</th>
            <th>API OrderID</th>
            <th>User</th>
            <th>Order Basic Details</th>
            <th>Created</th>
            <th>Status</th>
            <th>API Response	</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($orders as $order)
            <tr id="order{{$order->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$order->id}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$order->api_order_id}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$order->user_id}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      <ul>
                        <li>Type: {{$order->type}}</li>
                        <li>Link: {{$order->link}}</li>
                        <li>Quantity: {{$order->quantity}}</li>
                        <li>Charge: {{$order->charge}}</li>
                        <li>Start counter: {{$order->start_counter}}</li>
                        <li>Remains: {{$order->remains}}</li>
                      </ul>
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                    {{$order->created_at}}
{{--                        {{Timezone::convertToLocal($order->created_at, 'Y-m-d H:i:s')}}--}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$order->status}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$order->sub_response_posts}}
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
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-order-edit" href="#" onclick="editOrder({{$order->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeOrder({{$order->id}})">
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
      <!-- Modal to add new order starts-->
      <div class="modal fade" tabindex="-1" aria-hidden="true" id="modals-order-in">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <form id="orderCreateForm" class="modal-content pt-0" action="{{route('order.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>

            <div class="modal-body flex-grow-1">
              <div class="row">
                <div class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Add Order</h4>
                    </div>
                    <div class="card-body">
                      <form class="form">
                        <div class="row">
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="category-column">Category</label>
                              <select class="select2 form-select" id="orderFormCategoryId" name="category_id">
                                @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1" id="orderCategoryService" style="display: none">
                              <label class="form-label" for="city-column">Order Service</label>
                              <select name="service_id" class="select2 form-select" id="orderFormServiceId">
                              </select>
{{--                              <label class="form-label" for="city-column">Order Service</label>--}}

                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Link</label>
                              <input
                                      type="text"
                                      id="orderFormLink"
                                      class="form-control"
                                      name="link"
                                      placeholder="https://"
                              />
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Quantity</label>
                              <input
                                      type="number"
                                      id="orderFormQuantity"
                                      class="form-control"
                                      name="quantity"
                              />
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Total Charge: $ </label>
                              <span id="orderFormTotalCharge"></span>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Order Resume</h4>
                    </div>
                    <div class="card-body">
                      <form class="form">
                        <div class="row">
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="first-name-column">Service name</label>
                              <input
                                      type="text"
                                      id="orderFormServiceName"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="city-column">Minimum Amount</label>
                              <input
                                      type="number"
                                      id="orderFormServiceMinimumAmount"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="city-column">Maximum Amount</label>
                              <input
                                      type="number"
                                      id="orderFormServiceMaximumAmount"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="city-column">Price per 1000 ($)</label>
                              <input
                                      type="number"
                                      id="orderFormServicePricePer"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Description</label>
                              <textarea
                                      rows="10"
                                      id="orderFormServiceDescription"
                                      class="form-control"
                                      readonly
                              ></textarea>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Modal to add new order Ends-->

      <div class="modal fade" tabindex="-1" aria-hidden="true" id="modals-order-edit">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <form id="orderEditForm" class="modal-content pt-0" action="{{route('order.update', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-clo  se" data-bs-dismiss="modal" aria-label="Close">×</button>
            <input type="hidden" name="_method" value="PUT" />
            <div id="orderEditFormOrderId"></div>

            <div class="modal-body flex-grow-1">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Edit Order</h4>
                    </div>
                    <div class="card-body">
                      <form class="form">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Order ID</label>
                              <input
                                      type="text"
                                      id="orderEditFormId"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">API OrderID</label>
                              <input
                                      type="text"
                                      id="orderFormApiOrderId"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Type</label>
                              <input
                                      type="text"
                                      id="orderFormType"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">User</label>
                              <input
                                      type="text"
                                      id="orderFormUser"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Service</label>
                              <input
                                      type="text"
                                      id="orderFormService"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Quantity</label>
                              <input
                                      type="text"
                                      id="orderEditFormQuantity"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Amount</label>
                              <input
                                      type="text"
                                      id="orderFormAmount"
                                      class="form-control"
                                      readonly
                              />
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Start counter</label>
                              <input
                                      type="number"
                                      id="orderFormStartCounter"
                                      class="form-control"
                                      name="start_counter"
                              />
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Remains</label>
                              <input
                                      type="number"
                                      id="orderFormRemains"
                                      class="form-control"
                                      name="remains"
                              />
                            </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Status</label>
                              <select class="select2 form-select" id="orderFormStatus" name="status">
                                @foreach($statuses as $status)
                                  <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="company-column">Link</label>
                              <input
                                      type="text"
                                      id="orderEditFormLink"
                                      class="form-control"
                                      name="link"
                              />
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- list and filter end -->
  </section>
  <!-- users list ends -->
@endsection

@section('vendor-script')
  <script>
      $('#orderFormQuantity').keyup(function (e) {
          setTimeout(function() {
              $('#orderFormTotalCharge').html($('#orderFormQuantity').val() * $('#orderFormServicePricePer').val())
          }, 10);
      });

      $('#orderFormCategoryId').on('change', function (){
          $('#orderCategoryService').hide();

          $('#orderFormServiceName').val('');
          $('#orderFormServiceMinimumAmount').val('');
          $('#orderFormServiceMaximumAmount').val('');
          $('#orderFormServicePricePer').val('');
          $('#orderFormServiceDescription').val('');

          $.ajax({
              type: "GET",
              url: "{{route('service.list', ['language' => Config::get('language.current')])}}",
              data: {
                  "category_id": $(this).val(),
              }
          }).done(function(data) {
              var services = '<option value="0">Choose a service</option>';
              $.each(data.data, function( index, value ) {
                  services += '<option value="'+value.id+'">'+value.name+'</option>';
              });

              $('#orderFormServiceId').html(services);
              $('#orderCategoryService').show();

          });
      });

      $('#orderFormServiceId').on('change', function (){

          $('#orderFormServiceName').val('');
          $('#orderFormServiceMinimumAmount').val('');
          $('#orderFormServiceMaximumAmount').val('');
          $('#orderFormServicePricePer').val('');
          $('#orderFormServiceDescription').val('');

          if ($(this).val() > 0) {
              $.ajax({
                  type: "GET",
                  url: "{{route('service.info', ['language' => Config::get('language.current')])}}",
                  data: {
                      id : $(this).val(),
                      _token : "{{csrf_token()}}"
                  }
              }).done(function(data) {

                  $('#orderFormServiceName').val(data.data.name);
                  $('#orderFormServiceMinimumAmount').val(data.data.min);
                  $('#orderFormServiceMaximumAmount').val(data.data.max);
                  $('#orderFormServicePricePer').val(data.data.price);
                  $('#orderFormServiceDescription').val(data.data.desc);

              });
          }

      });

      function addOrder()
      {
          $('#orderFormLink').val('');
          $('#orderFormQuantity').val('');
          $('#orderFormTotalCharge').html('');
          $('#orderFormServiceName').val('');
          $('#orderFormServiceMinimumAmount').val('');
          $('#orderFormServiceMaximumAmount').val('');
          $('#orderFormServicePricePer').val('');
          $('#orderFormServiceDescription').val('');


          $('#orderFormCategoryId option').each(function (){
              $("#orderFormCategoryId").val($(this).val()).trigger('change');
              return false;
          });

          $('#orderFormServiceId option').each(function (){
              $("#orderFormServiceId").val($(this).val()).trigger('change');
              return false;
          });
      }

      function removeOrder(orderId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('order.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : orderId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#order'+orderId).hide();
              }
          });
      }

      function editOrder(orderId)
      {
          $('#orderEditFormOrderId').html('<input type="hidden" name="id" value="'+orderId+'" />');

          $.ajax({
              type: "GET",
              url: "{{route('order.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : orderId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {

              $('#orderEditFormId').val(data.data.id);
              $('#orderFormApiOrderId').val(data.data.api_order_id);
              $('#orderFormType').val(data.data.type);
              $('#orderFormUser').val(data.data.user.email);
              $('#orderFormService').val(data.data.service.name);
              $('#orderEditFormQuantity').val(data.data.quantity);
              $('#orderFormAmount').val(data.data.charge);

              $('#orderFormStartCounter').val(data.data.start_counter);
              $('#orderFormRemains').val(data.data.remains);
              $('#orderFormStatus option').each(function (){
                  if ($(this).val() === data.data.status) {
                      $("#orderFormStatus").val($(this).val()).trigger('change');
                  }
              });
              $('#orderEditFormLink').val(data.data.link);
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
