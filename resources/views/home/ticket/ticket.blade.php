
@extends('panel/master')

@section('title', 'Ticket')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap" rel="stylesheet">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-email.css')) }}">
@endsection

<!-- Sidebar Area -->
@section('content-sidebar')
  @include('home/ticket/ticket-sidebar')
@endsection

@section('content')
  <div class="body-content-overlay"></div>
  <!-- Email list Area -->
  <div class="email-app-list">
    <!-- Email search starts -->
    <div class="app-fixed-search d-flex align-items-center">
      <div class="sidebar-toggle d-block d-lg-none ms-1">
        <i data-feather="menu" class="font-medium-5"></i>
      </div>
      <div class="d-flex align-content-center justify-content-between w-100">
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
          <input
                  type="text"
                  class="form-control"
                  id="ticketSearch"
                  placeholder="Search ticket"
                  aria-label="Search..."
                  aria-describedby="email-search"
          />
          <select class="form-select text-capitalize mb-md-0 mb-2" id="ticketFilterStatus">
              <option value="0" >Status</option>
              @foreach(\App\Models\Ticket::TICKET_STATUS_LIST as $status => $statusName)
                  <option value="{{$status}}" >{{$statusName}}</option>
              @endforeach
          </select>
        </div>
          <select class="form-select text-capitalize mb-md-0 mb-2" id="ticketFilterImportant">
              <option value="2" >Important</option>
              <option value="1" >Yes</option>
              <option value="0" >No</option>
          </select>
          <button
              type="button"
              class="btn btn-primary w-100"
              data-bs-backdrop="false"
              onclick="ticketSearch()"
          >
              Search
          </button>
      </div>
    </div>
    <!-- Email search ends -->

    <!-- Email actions starts -->
    <div class="app-action">
      <div class="action-left">
      </div>
      <div class="action-right">
        <ul class="list-inline m-0">

        </ul>
      </div>
    </div>
    <!-- Email actions ends -->

    <!-- Email list starts -->
    <div class="email-user-list">
      <ul class="email-media-list">
        @foreach($tickets as $ticket)
          <li class="d-flex user-mail mail-read @if($ticket->is_important) selected-row-bg @endif" onclick="showTicketDetail({{$ticket->id}})">
            <div class="mail-body">
              <div class="mail-details">
                <div class="mail-items">
                  <h5 class="mb-25">
                      {{$ticket->subject}}
                      @if($ticket->entity_type)
                          -{{ucfirst($ticket->entity_type)}}
                      @endif
                      @if($ticket->entity_id)
                          -{{$ticket->entity_id}}
                      @endif
                  </h5>
                </div>
                  <div class="form-check form-switch form-check-primary">
                      important
                      <input
                          type="checkbox"
                          class="form-check-input"
                          id="customSwitch{{$ticket->id}}"
                          @if($ticket->is_important)
                            checked
                          @endif
                          onclick="changeTicketImportant({{$ticket->id}})"
                      />
                      <label class="form-check-label" for="customSwitch{{$ticket->id}}">
                          <span class="switch-icon-left"><i data-feather="check"></i></span>
                          <span class="switch-icon-right"><i data-feather="x"></i></span>
                      </label>
                  </div>
                <div class="mail-meta-item">
                  <span class="me-50 bullet bullet-success bullet-sm">

                  </span>
                  <span class="mail-date">
                      <span class="btn
                                @switch($ticket->status)
                                   @case(\App\Models\Ticket::OPEN_STATUS)
                                        btn-info
                                   @break
                                   @case(\App\Models\Ticket::CLOSE_STATUS)
                                        btn-gray-dark
                                   @break
                                   @case(\App\Models\Ticket::WAIT_FOR_ADMIN_ANSWER)
                                   @case(\App\Models\Ticket::WAIT_FOR_USER_ANSWER)
                                        btn-gray
                                   @break
                                @endswitch
                          btn-sm">
                          <small>{{\App\Models\Ticket::TICKET_STATUS_LIST[$ticket->status]}}</small>
                      </span>
                      {{$ticket->created_at->format('m.d.Y')}}
{{--                      {{ Timezone::convertToLocal($ticket->created_at, 'm.d.Y') }}--}}
                  </span>
                </div>
              </div>
              <div class="mail-message">
                <p class="text-truncate mb-0">
                  {{$ticket->user->first_name}} {{$ticket->user->last_name}} - {{$ticket->user->email}}
                </p>
              </div>
            </div>
          </li>
        @endforeach

      </ul>
      <div class="no-results">
        <h5>No Items Found</h5>
      </div>
    </div>
    <!-- Email list ends -->
  </div>
  <!--/ Email list Area -->
  <!-- Detailed Email View -->
  <div class="email-app-details">
    <!-- Detailed Email Header starts -->
    <div class="email-detail-header">
      <div class="email-header-left d-flex align-items-center">
        <span class="go-back me-1"><i data-feather="chevron-left" class="font-medium-4" onclick="backToTicketsList()"></i></span>
        <h4 class="email-subject mb-0" id="ticketDetailSubject"></h4>
      </div>
      <div class="email-header-right ms-2 ps-1">
        <ul class="list-inline m-0">
          <li class="list-inline-item">
            <span class="action-icon" id="deleteTicketButton"><i data-feather="trash" class="font-medium-2" onclick="removeTicket()"></i></span>
          </li>
        </ul>
      </div>
    </div>
    <!-- Detailed Email Header ends -->

    <!-- Detailed Email Content starts -->
    <div class="email-scroll-area" id="showTicketMessage">

    </div>
    <!-- Detailed Email Content ends -->
  </div>
  <!--/ Detailed Email View -->

  <!-- compose email -->
  <div class="modal modal-sticky" id="compose-mail" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content p-0">
        <div class="modal-header">
          <h5 class="modal-title">New Ticket</h5>
          <div class="modal-actions">
            <a href="#" class="text-body me-75"><i data-feather="minus"></i></a>
            <a href="#" class="text-body me-75 compose-maximize"><i data-feather="maximize-2"></i></a>
            <a class="text-body" href="#" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></a>
          </div>
        </div>
        <div class="modal-body flex-grow-1 p-0">
          <form method="POST" action="{{route('ticket.create', ['language' => Config::get('language.current')])}}">
            @csrf
            <div class="compose-mail-form-field">
              <label for="ticketSubject" class="form-label">Subject: </label>
                <select class="form-select ms-50 text-capitalize" id="ticketSubject" name="subject" onchange="showTicketForm(this)">
                    @foreach($subjects as $subject)
                        <option value="{{$subject}}">{{$subject}}</option>
                    @endforeach
                </select>
            </div>
            <div class="compose-mail-form-field" id="requestBlock">
                <label for="ticketSubject" class="form-label">Request: </label>
                <select class="form-select ms-50 text-capitalize" id="ticketRequest" name="request">
                    @foreach($requests as $request)
                        <option>{{$request}}</option>
                    @endforeach
                </select>
            </div>
            <div class="compose-mail-form-field" id="paymentBlock" style="display: none">
                <label for="ticketSubject" class="form-label">Payment: </label>
                <select class="form-select ms-50 text-capitalize" id="ticketPayment" name="payment">
                    @foreach($payments as $payment)
                        <option>{{$payment->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="compose-mail-form-field" id="orderIdBlock">
                <label for="ticketSubject" class="form-label">Order ID </label>
                <input type="text" id="ticketOrderId" class="form-control" placeholder="Subject" name="orderId" />
            </div>

            <div class="compose-mail-form-field" id="transactionIdBlock" style="display: none">
                <label for="ticketSubject" class="form-label">Transaction ID </label>
                <input type="text" id="ticketTransactionId" class="form-control" placeholder="Subject" name="transactionId" />
            </div>


            <div id="message-editor">
              <div id="ticketDescription" class="editor" data-name="editName" data-placeholder="Description"></div>
              <div class="compose-editor-toolbar">
                <span class="ql-formats me-0">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
              </span>
              </div>
            </div>
            <div class="compose-footer-wrapper">
              <div class="btn-wrapper d-flex align-items-center">
                <div class="btn-group dropup me-1">
                  <button type="button" onclick="createTicket()" class="btn btn-primary">Send</button>
                </div>
                <!-- add attachment -->
                <div class="email-attachement">
                  <label for="file-input" class="form-label">
                    <i data-feather="paperclip" width="17" height="17" class="ms-50"></i>
                  </label>

                  <input id="file-input" type="file" class="d-none" />
                </div>
              </div>
              <div class="footer-action d-flex align-items-center">
                <div class="dropup d-inline-block">
                  <i
                          class="font-medium-2 cursor-pointer me-50"
                          data-feather="more-vertical"
                          role="button"
                          id="composeActions"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                  >
                  </i>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="composeActions">
                    <a class="dropdown-item" href="#">
                      <span class="align-middle">Add Label</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="align-middle">Plain text mode</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <span class="align-middle">Print</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="align-middle">Check Spelling</span>
                    </a>
                  </div>
                </div>
                <i data-feather="trash" class="font-medium-2 cursor-pointer" data-bs-dismiss="modal"></i>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ compose email -->
@endsection

@section('vendor-script')
  <script>

    function changeTicketImportant(ticketId)
    {
        $.ajax({
            type: "POST",
            url: "{{route('ticket.importantChange', ['language' => Config::get('language.current')])}}",
            data: {
                id : ticketId,
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {

            {{--window.location.href = "{{route('ticket.list', ['language' => Config::get('language.current')])}}"--}}
        });



    }

    function ticketSearch()
    {
        var params = {};

        var ticketFilterStatus = $('#ticketFilterStatus').val();
        var ticketSearch = $('#ticketSearch').val();
        var ticketFilterImportant = $('#ticketFilterImportant').val();

        if (ticketSearch) {
            params['search'] = ticketSearch;
        }

        if (ticketFilterStatus && ticketFilterStatus != 0) {
            params['filter_status'] = ticketFilterStatus;
        }

        if (ticketFilterImportant && ticketFilterImportant != 2) {
            params['filter_important'] = ticketFilterImportant;
        }

        window.location.href = "{{route('ticket.list', ['language' => Config::get('language.current')])}}"
            +'?'+$.param( params );
    }
    function showTicketForm(item)
    {
        var requestBlock = $('#requestBlock');
        var orderIdBlock = $('#orderIdBlock');
        var paymentBlock = $('#paymentBlock');
        var transactionIdBlock = $('#transactionIdBlock');

        switch ($(item).val()) {
            case 'Order':
                requestBlock.show();
                orderIdBlock.show();
                paymentBlock.hide();
                transactionIdBlock.hide();
                break;
            case 'Payment':
                requestBlock.hide();
                orderIdBlock.hide();
                paymentBlock.show();
                transactionIdBlock.show();
                break;
            case 'Service':
                //no break
            case 'Other':
                requestBlock.hide();
                orderIdBlock.hide();
                paymentBlock.hide();
                transactionIdBlock.hide();
                break;

        }
    }

    function removeTicket()
    {
        $.ajax({
            type: "DELETE",
            url: "{{route('ticket.delete', ['language' => Config::get('language.current')])}}",
            data: {
                id : $('#deleteTicketButton').attr("data-value"),
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {
            window.location.href = "{{route('ticket.list', ['language' => Config::get('language.current')])}}"
        });
    }

    function showTicketDetail(ticketId)
    {
        $.ajax({
            type: "GET",
            url: "{{route('ticket.read', ['language' => Config::get('language.current')])}}",
            data: {
                id : ticketId
            }
        }).done(function(data) {
            $('#ticketDetailSubject').html(data.data.subject);
            $('#deleteTicketButton').attr("data-value", data.data.id);
        });

        $.ajax({
            type: "GET",
            url: "{{route('ticket.message.ticket', ['language' => Config::get('language.current')])}}",
            data: {
                ticket_id : ticketId
            }
        }).done(function(data) {

            var messages = '';
            $.each(data.data, function( index, value ) {
                messages += ' <div class="row">'+
                    '<div class="col-12">'+
                    '<div class="card">'+
                    '<div class="card-header email-detail-head">'+
                    '<div class="user-details d-flex justify-content-between align-items-center flex-wrap">'+
                    '<div class="avatar me-75">'+
                    '</div>'+
                    '<div class="mail-items">'+
                    '<h5 class="mb-0">'+value.first_name+' '+value.last_name+'</h5>'+
                    '<div class="email-info-dropup dropdown">'+
                    '<span>'+
                    ''+value.email+''+
                    '</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="mail-meta-item d-flex align-items-center">'+
                    '<small class="mail-date-time text-muted">'+value.created_at+'</small>'+
                    '<div class="dropdown ms-50">';
                    if (value.can_delete) {
                        messages += '<div><button type="button" class="btn btn-danger" onclick="removeTicketMessage('+value.id+')">x</button></div>';
                    }
                messages += '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="card-body mail-message-wrapper pt-2">'+
                    '<div class="mail-message">'+
                    '<p class="card-text">'+
                    ''+value.message+''+
                    '</p>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
            });

            $('#showTicketMessage').html(messages);
        });


        $('#newTicketMessageText').val('');
        $('#newTicketMessage').show();
    }

    function createTicket()
    {
        var ticketData = {
            subject : $('#ticketSubject').val(),
            description : $('#ticketDescription').text(),
            _token : "{{csrf_token()}}"
        };

        if (!$('#requestBlock').is(":hidden")) {
            ticketData["ticket_request"] = $('#ticketRequest').val();
        }

        if (!$('#orderIdBlock').is(":hidden")) {
            ticketData["orderId"] = $('#ticketOrderId').val();
        }

        if (!$('#paymentBlock').is(":hidden")) {
            ticketData["payment"] = $('#ticketPayment').val();
        }

        if (!$('#transactionIdBlock').is(":hidden")) {
            ticketData["transactionId"] = $('#ticketTransactionId').val();
        }

        $.ajax({
            type: "POST",
            url: "{{route('ticket.create', ['language' => Config::get('language.current')])}}",
            data: ticketData
        }).done(function(data) {
            if (data.status) {
                window.location.href = "{{route('ticket.list', ['language' => Config::get('language.current')])}}"
            }
        });
    }

    function backToTicketsList()
    {
        $('#newTicketMessage').hide();
    }

    function removeTicketMessage(ticketMessageId)
    {
        $.ajax({
            type: "DELETE",
            url: "{{route('ticket.message.delete', ['language' => Config::get('language.current')])}}",
            data: {
                id : ticketMessageId,
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {
            window.location.href = "{{route('ticket.list', ['language' => Config::get('language.current')])}}"
        });
    }
  </script>
  <!-- vendor js files -->
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-email.js')) }}"></script>
@endsection
