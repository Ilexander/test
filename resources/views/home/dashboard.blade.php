
@extends('panel/master')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section class="app-user-list">
  <div class="row">
    @if(!$user->isAdmin())
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='dollar-sign'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">$ {{$user->balance}}</h3>
              <span><small>Your Balance</small></span>
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='dollar-sign'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">$ {{$user->getSpentAmount()}}</h3>
              <span><small>Total Amount Spent</small></span>
            </div>
          </div>
        </div>
      </div>


    @endif

    @if($user->isAdmin())
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='users'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">{{$blocksData['clients']}}</h3>
              <span><small>Total Users</small></span>
            </div>
          </div>
        </div>
      </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='dollar-sign'></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">$ {{$blocksData['total_amount_recieved']}}</h3>
                <span><small>Total Amount Recieved</small></span>
              </div>
            </div>
          </div>
        </div>
    @endif

    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='shopping-cart'></i>
                </span>
          </div>

          <div>
            <h3 class="fw-bolder mb-75">{{$blocksData['orders']}}</h3>
            <span><small>Total Orders</small></span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='tag'></i>
                </span>
          </div>

          <div>
            <h3 class="fw-bolder mb-75">{{$blocksData['tickets']}}</h3>
            <span><small>Total Tickets</small></span>
          </div>
        </div>
      </div>
    </div>

      @if($user->isAdmin())
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='dollar-sign'></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">$ {{$blocksData['total_users_balance']}}</h3>
                <span><small>Total User's Balance</small></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='clipboard'></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">$ {{$blocksData['total_providers_balance']}}</h3>
                <span><small>Total Provider's balance</small></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='bar-chart'></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">$ {{$blocksData['monthly_profit']}}</h3>
                <span><small>Total Profit 30 days</small></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='bar-chart'></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">$ {{$blocksData['today_profit']}}</h3>
                <span><small>Total Profit Today</small></span>
              </div>
            </div>
          </div>
        </div>
      @endif

  </div>

  <div class="container px-4 mx-auto">
    <div class="row">
      <div class="col-lg-6 col-sm-6 bg-white rounded shadow">
        {!! $weeklyChart->container() !!}
      </div>
      <div class="col-lg-6 col-sm-6 bg-white rounded shadow">
        {!! $chart->container() !!}
      </div>
    </div>
  </div>
  <br/>
  <section class="app-user-list">
    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='align-justify'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_COMPLETED])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_COMPLETED]->count : 0) +
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PROCESSING])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PROCESSING]->count : 0) +
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PENDING])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PENDING]->count : 0) +
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_IN_PROGRESS])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_IN_PROGRESS]->count : 0) +
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PARTIAL])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PARTIAL]->count : 0) +
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_CANCELED])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_CANCELED]->count : 0) +
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_REFUNDED])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_REFUNDED]->count : 0)
                }}
              </h3>
              <span><small>Total Orders</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='check'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_COMPLETED])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_COMPLETED]->count : 0)
                }}
              </h3>
              <span><small>Completed</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                  <i data-feather='trending-up'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PROCESSING])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PROCESSING]->count : 0)
                }}
              </h3>
              <span><small>Processing</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i data-feather='loader'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_IN_PROGRESS])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_IN_PROGRESS]->count : 0)
                }}
              </h3>
              <span><small>In progress</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i data-feather='pie-chart'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PENDING])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PENDING]->count : 0)
                }}
              </h3>
              <span><small>Pending</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i data-feather='activity'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PARTIAL])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PARTIAL]->count : 0)
                }}
              </h3>
              <span><small>Partial</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i data-feather='x'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_CANCELED])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_CANCELED]->count : 0)
                }}
              </h3>
              <span><small>Canceled</small></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i data-feather='refresh-ccw'></i>
                </span>
            </div>

            <div>
              <h3 class="fw-bolder mb-75">
                {{
                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_REFUNDED])
                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_REFUNDED]->count : 0)
                }}
              </h3>
              <span><small>Refunded</small></span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  @if($user->isAdmin())
  <div class="container px-4 mx-auto">
    <div class="row">
      <div class="col-lg-6 col-sm-6 bg-white rounded shadow">
        {!! $weeklyTicketChart->container() !!}
      </div>
      <div class="col-lg-6 col-sm-6 bg-white rounded shadow">
        {!! $ticketChart->container() !!}
      </div>

    </div>
  </div>
  <br/>

  <section class="app-user-list">
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i data-feather='refresh-ccw'></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">
                  {{$blocksData['tickets']}}
                </h3>
                <span><small>Total Tickets</small></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i class="ficon" data-feather="mail"></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">
                  {{$blocksData['tickets_statistics']->open_tickets}}
                </h3>
                <span><small>New</small></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i class="ficon" data-feather="mail"></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">
                  {{$blocksData['tickets_statistics']->pending_tickets}}
                </h3>
                <span><small>Pending</small></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="avatar bg-light-primary p-50">
                <span class="avatar-content">
                 <i class="ficon" data-feather="mail"></i>
                </span>
              </div>

              <div>
                <h3 class="fw-bolder mb-75">
                  {{$blocksData['tickets_statistics']->close_tickets}}
                </h3>
                <span><small>Closed</small></span>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>
  @endif



  <section class="app-user-list">
    <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
      <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
        <div class="dataTables_length" id="DataTables_Table_0_length">
          Top bestsellers
        </div>
      </div>
    </div>
    <table class="table">
      <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Total Orders</th>
        <th>Type</th>
        <th>API Provider</th>
        <th>API ServiceID</th>
        <th>Rate Per 1000($)</th>
        <th>Min / Max Order</th>
        <th>Description</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
      @foreach($topBestsellers as $topBestseller)
        <tr>
          <td>{{$topBestseller->id}}</td>
          <td>{{$topBestseller->name}}</td>
          <td>{{$topBestseller->total_orders}}</td>
          <td>{{$topBestseller->type}}</td>
          <td>{{$topBestseller->api_provider}}</td>
          <td>{{$topBestseller->api_service_id}}</td>
          <td>{{$topBestseller->price}} - {{$topBestseller->original_price}}</td>
          <td>{{$topBestseller->min}} / {{$topBestseller->max}}</td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modals-service-in" onclick="showDetails({{$topBestseller->id}})">Details</button></td>
          <td><button type="button" class="btn {{$topBestseller->status ? 'btn-success' : 'btn-danger'}}"></button></td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </section>

  @if($user->isAdmin())
    <section class="app-user-list">
      <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
        <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
          <div class="dataTables_length" id="DataTables_Table_0_length">
            Last 5 Newest Users
          </div>
        </div>
      </div>
      <table class="table">
        <thead class="table-light">
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>E-Mail</th>
          <th>Type</th>
          <th>Funds</th>
          <th>Last IP Address</th>
          <th>Created</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lastUsers as $lastUser)
          <tr>
            <td>{{$lastUser->id}}</td>
            <td>{{$lastUser->first_name}} {{$lastUser->last_name}}</td>
            <td>{{$lastUser->email}}</td>
            <td>
              @switch($lastUser->role_id)
                @case(\App\Models\User::ROLE_ADMIN)
                Admin
                @break
                @case(\App\Models\User::ROLE_CLIENT)
                Regular User
                @break
              @endswitch
            </td>
            <td>{{$lastUser->balance}}</td>
            <td>{{$lastUser->lastSession ? $lastUser->lastSession->ip : ''}}</td>
            <td>{{$lastUser->created_at}}</td>
{{--            <td>{{ Timezone::convertToLocal($lastUser->created_at, 'Y-m-d H:i:s') }}</td>--}}
            <td><button type="button" class="btn {{$lastUser->status ? 'btn-success' : 'btn-danger'}}"></button></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </section>

    <section class="app-user-list">
      <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
        <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
          <div class="dataTables_length" id="DataTables_Table_0_length">
            Last 5 Newest Users
          </div>
        </div>
      </div>
      <table class="table">
        <thead class="table-light">
        <tr>
          <th>Order ID</th>
          <th>User</th>
          <th>Name</th>
          <th>Type</th>
          <th>Link</th>
          <th>Quantity</th>
          <th>Amount</th>
          <th>Created</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lastOrders as $lastOrder)
          <tr>
            <td>{{$lastOrder->id}}</td>
            <td>{{$lastOrder->user->email}}</td>
            <td>{{$lastOrder->service->name}}</td>
            <td>{{$lastOrder->type}}</td>
            <td>{{$lastOrder->link}}</td>
            <td>{{$lastOrder->quantity}}</td>
            <td>{{$lastOrder->charge}}</td>
            <td>{{$lastOrder->created_at}}</td>
{{--            <td>{{ Timezone::convertToLocal($lastOrder->created_at, 'Y-m-d H:i:s') }}</td>--}}
            <td><button type="button" class="btn btn-primary">{{$lastOrder->status}}</button></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </section>
  @endif

  <script src="{{ $chart->cdn() }}"></script>
  <script src="{{ $weeklyChart->cdn() }}"></script>
  <script src="{{ $ticketChart->cdn() }}"></script>
  <script src="{{ $weeklyTicketChart->cdn() }}"></script>
  {{ $chart->script() }}
  {{ $weeklyChart->script() }}
  {{ $ticketChart->script() }}
  {{ $weeklyTicketChart->script() }}



  <div class="modal modal-slide-in fade" id="modals-service-in">
    <div class="modal-dialog modal-lg" style="width: 40rem">
      <form id="serviceCreateForm" class="modal-content pt-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="serviceFormLabel"></h5>
        </div>
        <div id="serviceFormDescription"></div>

        <div class="modal-body flex-grow-1">
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
  function showDetails(serviceId)
  {
      $.ajax({
          type: "GET",
          url: "{{route('service.info', ['language' => Config::get('language.current')])}}",
          data: {
              id : serviceId,
          }
      }).done(function(data) {
          $('#serviceFormLabel').html(data.data.name);
          $('#serviceFormDescription').html(data.data.desc);
      });
  }
</script>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
{{--  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>--}}
  {{-- vendor files --}}

  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
{{--  <script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>--}}
  {{-- Page js files --}}
{{--  <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>--}}
@endsection
