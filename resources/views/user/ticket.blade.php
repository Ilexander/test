@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div id="ticketErrors"></div>
    @if(!\Illuminate\Support\Facades\Auth::user()->isAdmin())
        <div class="support__row mt-4">
            <div class="support__row--body row">
                <div class="support__block col-12 col-xl-6">
                    <div class="support__block--body _section-block">
                        <div class="support__block--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                            <div class="support__block--row _section-panel-active">
                                <h2 class="support__block--title _title">
                                    {{ __('locale.ticket.add_new_ticket') }}
                                </h2>
                                <div class="support__block--panel _section-panel">
                                </div>
                            </div>
                        </div>
                        <form action="{{route('user.ticket.create', ['language' => Config::get('language.current')])}}" class="support__block--form support__form" method="POST">
                            @csrf
                            <div class="support__form--body ps-2 pe-2 ps-sm-4 pe-sm-4 pb-4">
                                <label class="support__form--label pt-3 _form-label">
                                    <span class="support__form--placeholder _form-placeholder">
                                        {{ __('locale.ticket.form.subject') }}
                                    </span>
                                    <span class="support__form--label-body _form-elem-wrapper">
                                        <span class="support__form--icon _form-icon _icon-arrow"></span>
                                        <select class="support__form--select _form-select" id="ticketSubject" name="subject" onchange="showTicketForm(this)">
                                            @foreach($subjects as $subject)
                                                <option value="{{$subject}}">{{$subject}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </label>
                                <label class="support__form--label pt-3 _form-label" id="requestBlock">
                                    <span class="support__form--placeholder _form-placeholder">
                                        {{ __('locale.ticket.form.request') }}
                                    </span>
                                    <span class="support__form--label-body _form-elem-wrapper">
                                        <span class="support__form--icon _form-icon _icon-arrow"></span>
                                        <select class="support__form--select _form-select" id="ticketRequest" name="request">
                                            @foreach($requests as $request)
                                                <option>{{$request}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </label>
                                <label class="support__form--label pt-3 _form-label" id="paymentBlock" style="display: none">
                                    <span class="support__form--placeholder _form-placeholder">
                                        {{ __('locale.ticket.form.payment') }}
                                    </span>
                                    <span class="support__form--label-body _form-elem-wrapper">
                                        <span class="support__form--icon _form-icon _icon-arrow"></span>
                                        <select class="support__form--select _form-select" id="ticketPayment" name="payment">
                                             @foreach($payments as $payment)
                                                <option>{{$payment->name}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </label>
                                <label class="support__form--label pt-3 _form-label" id="orderIdBlock">
                                    <span class="support__form--placeholder _form-placeholder">
                                         {{ __('locale.ticket.form.order_id') }}
                                    </span>
                                    <span class="support__form--label-body _form-elem-wrapper">
                                        <span class="support__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input type="text" id="ticketOrderId" name="orderId" placeholder="Placeholder" class="support__form--input _form-input">
                                    </span>
                                </label>
                                <label class="support__form--label pt-3 _form-label" id="transactionIdBlock" style="display: none">
                                    <span class="support__form--placeholder _form-placeholder">
                                        {{ __('locale.ticket.form.transaction_id') }}
                                    </span>
                                    <span class="support__form--label-body _form-elem-wrapper">
                                        <span class="support__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input type="text" id="ticketTransactionId" name="transactionId" placeholder="Placeholder" class="support__form--input _form-input">
                                    </span>
                                </label>
                                <label class="support__form--label pt-3 _form-label">
                                    <span class="support__form--placeholder _form-placeholder">
                                        {{ __('locale.ticket.form.description') }}
                                    </span>
                                    <span class="support__form--label-body _form-elem-wrapper _textarea-wrapper">
                                        <span class="support__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <textarea id="ticketDescription" data-name="editName" name="description" rows="3" placeholder="Share a reply" class="support__form--textarea _form-textarea"></textarea>
                                    </span>
                                    <div class="errorMessages" id="descriptionError"></div>
                                </label>
                            </div>
                            <div class="support__form--footer ps-2 pe-2 ps-sm-4 pe-sm-4 pt-3 pb-2 _section-block-footer">
                                <div class="support__form--footer-body row justify-content-center align-items-center justify-content-md-between">
                                    <div class="support__form--info col-auto mt-1 mb-1">
                                        {{ __('locale.ticket.form.support') }}
                                        <span class="support__form--status @if($support['support_online'])  _online @else _offline @endif">
                                            @if($support['support_online'])
                                                online
                                            @else
                                                {{ __('locale.ticket.form.offline') }}
                                            @endif

                                        </span><!-- + _online -->
                                        @if(!$support['support_online'])
                                            <span class="support__form--time-left"><br>
                                            {{ __('locale.ticket.form.time_left') }}
                                            <span class="support__form--time-left-value">
                                                {{round($support['time_left'] / 100)}} Hours : {{$support['time_left'] % 100}} Minutes
                                            </span>
                                        </span>
                                        @endif

                                    </div>
                                    <div class="support__form--submit col-auto mt-1 mb-1">
                                        <button id="ticketSubmitButton" onclick="createTicket()" type="button" class="support__form--btn _btn _large-btn">
                                            {{ __('locale.ticket.form.submit') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="support__block col-12 col-xl-6 mt-4 mt-xl-0">
                    <div class="support__block--body _section-block">
                        <div class="support__block--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                            <div class="support__block--row _section-panel-active">
                                <h2 class="support__block--title _title">
                                    {{ __('locale.ticket.lists') }}
                                </h2>
                                <div class="support__block--panel _section-panel">
                                </div>
                            </div>
                        </div>
                        <div class="support__form--body ps-2 pe-2 ps-sm-4 pe-sm-4 pb-4">
                            <ul class="statistics__users--list _section-block-footer ps-0 m-0 p-0">
                                @foreach($ticketsShow as $ticket)
                                    @if($ticket->status !== \App\Models\Ticket::PROCESS_STATUS)
                                        <li
                                            class=" statistics__users--li"

                                            @switch($ticket->status)
                                            @case(\App\Models\Ticket::OPEN_STATUS)
                                            style="border: 1px solid cornflowerblue"
                                            @break
                                            @case(\App\Models\Ticket::CLOSE_STATUS)
                                            style="border: 1px solid grey"
                                            @break
                                            @case(\App\Models\Ticket::WAIT_FOR_ADMIN_ANSWER)
                                            style="border: 1px solid yellow"
                                            @break
                                            @case(\App\Models\Ticket::WAIT_FOR_USER_ANSWER)
                                            style="border: 1px solid coral"
                                            @break
                                            @endswitch
                                            onclick="showChat('{{$ticket->id}}')"
                                        >
                                    <span class="statistics__users--link p-3">
                                        #<span class="statistics__users--id ps-1 pe-2">{{$ticket->id}}</span> -
                                        <span class="statistics__users--name">{{$ticket->subject}}</span>

                                        @if($ticket->subject == "Payment" || $ticket->subject == "Order")
                                            - <span class="statistics__users--name">{{$ticket->entity_type}}</span>
                                            - <span class="statistics__users--name">{{$ticket->entity_id}}</span>
                                        @endif

                                        <br/>
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->first_name : ''}}</span>
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->last_name : ''}}</span> -
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->email : ''}}</span><br/>
                                        <span class="statistics__users--name">
                                            {{$ticket->created_at->format('Y-m-d H:i:s')}}
{{--                                            {{ Timezone::convertToLocal($ticket->created_at, 'm.d.Y') }}--}}
                                        </span>
                                    </span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
        <div class="statistics__chat mt-2">
            <div class="statistics__chat--row row">
                <div class="statistics__chat--block _users-block col-12 col-xl-3 col-md-4">
                    <div class="statistics__chat--users statistics__users _section-block p-0">
                        <div class="statistics__users--header _section-block-header ps-3 pe-3 pt-3">
                            <h2 class="statistics__users--title _title">
                                {{ __('locale.ticket.lists_of_tickets') }}
                            </h2>
                        </div>
                        <form action="#" class="statistics__users--form p-3">
                            <div class="statistics__users--row d-flex">
                                <label class="statistics__users--label _form-label">
                                    <input type="text" name="search" placeholder="Search" class="statistics__users--search _form-input _form-search-input _min">
                                </label>
                                <button class="statistics__users--submit _icon-search _btn _form-search-btn _min" type="submit"></button>
                            </div>

                        </form>
                        <ul class="statistics__users--list _section-block-footer ps-0 m-0 p-0">
                            @foreach($ticketsShow as $ticket)
                                @if($ticket->status !== \App\Models\Ticket::PROCESS_STATUS)
                                    <li
                                        id="ticketBlock{{$ticket->id}}"
                                        class="statistics__users--li supportBlockTickets"
                                        @switch($ticket->status)
                                        @case(\App\Models\Ticket::OPEN_STATUS)
                                        style="border: 1px solid cornflowerblue"
                                        @break
                                        @case(\App\Models\Ticket::CLOSE_STATUS)
                                        style="border: 1px solid grey"
                                        @break
                                        @case(\App\Models\Ticket::WAIT_FOR_ADMIN_ANSWER)
                                        style="border: 1px solid coral"
                                        @break
                                        @case(\App\Models\Ticket::WAIT_FOR_USER_ANSWER)
                                        style="border: 1px solid yellow"
                                        @break
                                        @endswitch
                                        onclick="showTicketMessages({{$ticket->id}})"
                                    >
                                    <span class="statistics__users--link p-3">
                                        #<span class="statistics__users--id ps-1 pe-2">{{$ticket->id}}</span> -
                                        <span class="statistics__users--name">{{$ticket->subject}}</span><br/>

                                         @if($ticket->subject == "Payment" || $ticket->subject == "Order")
                                            - <span class="statistics__users--name">{{$ticket->entity_type}}</span>
                                            - <span class="statistics__users--name">{{$ticket->entity_id}}</span>
                                         @endif

                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->first_name : ''}}</span>
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->last_name : ''}}</span> -
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->email : ''}}</span><br/>
                                        <span class="statistics__users--name">
                                            {{$ticket->created_at->format('m.d.Y')}}
{{--                                            {{ Timezone::convertToLocal($ticket->created_at, 'm.d.Y') }}--}}
                                        </span>
                                    </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="statistics__chat--block _chat-block col-12 col-xl-9 col-md-8 mt-md-0 mt-3">
                    <div class="statistics__chat--body _section-block p-0">
                        <div class="statistics__chat--header _section-block-header ps-3 pe-3 pt-3">
                            <div style="width: 50%">
                                <h2 class="statistics__chat--title _title">
                                    {{ __('locale.ticket.chat') }}
                                </h2>
                            </div>
                            <div class="static__wrapper">
                                <div id="newStatusSelector"></div>
                                    <div id="statusSelectBlock" style="display: none;"></div>
                                <select onchange="changeStatus(33)" id="ticketStatus">
                                    <option value="open">open</option>
                                    <option value="close">close</option>
                                    <option selected="" value="unread">unread</option>
                                    <option value="answered">answered</option>
                                </select>
                            <div id="statusSaveButton" style="display: none">
                                <button class="saveButton" type="button" onclick="location.reload()">Save</button>
                            </div>
                            <div id="ticketDeleteButton" style="  padding: 4px 16px;
  color: red;
  width: fit-content;
  border-radius: 15px;
  background: #efefef;
  border: 1px solid transparent;
  transition: border-color 0.4s, color 0.4s, background-color 0.4s;"></div>
                            </div>
                        </div>
                        <div id="ticketMessageAddingBlock" class="statistics__chat--place statistics__chat-place" style="display: none">
                            <div class="statistics__chat-place--list _scrollbar-styles pb-4 ps-3 pe-3 pt-4" id="showTicketMessage">

                            </div>
                            <form
                                action="{{route('user.ticket.message.create', ['language' => Config::get('language.current')])}}"
                                class="statistics__chat-place--form p-3"
                                method="POST"
                            >
                                @csrf
                                <label class="statistics__chat-place--label _form-label">
                                    <span class="statistics__chat-place--placeholder _form-placeholder">
                                        {{ __('locale.ticket.message') }}
                                    </span>
                                    <span class="statistics__chat-place--label-wrapper _form-elem-wrapper _textarea-wrapper">
                                        <span class="statistics__chat-place--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <textarea id="newTicketMessageText" name="message" rows="3" placeholder="Share a reply" class="statistics__chat-place--textarea _form-textarea"></textarea>
                                    </span>
                                    <input type="hidden" id="currentTicketId" name="ticket_id">
                                </label>
                                <div class="statistics__chat-place--submit d-flex justify-content-end pt-3 pb-2">
                                    <button type="button" id="ticketSendMessageButton" class="statistics__chat-place--submit-btn _btn _large-btn" onclick="addNewMessage()">
                                        {{ __('locale.ticket.send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        showFirst();
        function showFirst()
        {
            $('.supportBlockTickets').first().click();
        }

        function addVariables(ticketId)
        {
            if ($('#newDivSelectorForTicket'+ ticketId).hasClass("select__btn--active")) {
                $('#newDivSelectorForTicket'+ ticketId).removeClass('select__btn--active');
            } else {
                $('#newDivSelectorForTicket'+ ticketId).addClass('select__btn--active');
            }

        }

        function deleteTicket(ticketId)
        {

            $.ajax({
                type: "DELETE",
                url: "{{route('admin.ticket.delete', ['language' => Config::get('language.current')])}}",
                data: {
                    id: ticketId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                $('#ticketBlock'+ticketId).hide();
                $('#statusSelectBlock').hide();
                $('#statusSaveButton').hide();
                $('#ticketDeleteButton').hide();
                $('#ticketMessageAddingBlock').hide();
                $('#showTicketMessage').html('');
            });
        }

        function showChat(ticketId)
        {
            window.location.href = "{{route('user.ticket.chat', ['language' => Config::get('app.locale')])}}" + '?ticket_id='+ticketId;
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

        function createTicket()
        {
            $('.errorMessages').html('');
            $('#ticketSubmitButton').prop('disabled', true);
            $('#ticketErrors').html('');
            var ticketData = {
                subject : $('#ticketSubject').val(),
                description : $('#ticketDescription').val(),
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
                url: "{{route('user.ticket.create', ['language' => Config::get('language.current')])}}",
                data: ticketData
            }).done(function(data) {
                if (data.status) {
                    window.location.href = "{{route('user.ticket.list', ['language' => Config::get('language.current')])}}"
                }
            }).fail(function( data ) {

                $.each(data.responseJSON.errors, function (id, message) {
                    $('#'+id+'Error').html('<div class="error" style="color: firebrick">'+message[0]+'</div>')
                });

                $('#ticketSubmitButton').prop('disabled', false);
            });
        }

        function addNewMessage()
        {
            $('.errorMessages').html('');
            $('#ticketErrors').html('');
            $('#ticketSendMessageButton').prop('disabled', true)
            $.ajax({
                type: "POST",
                url: "<?php echo e(route('admin.ticket.message.create', ['language' => Config::get('language.current')])); ?>",
                data: {
                    message : $('#newTicketMessageText').val(),
                    ticket_id : $('#currentTicketId').val(),
                    _token : "<?php echo e(csrf_token()); ?>"
                }
            }).done(function(data) {
                if (data.status) {
                    var ticketMessages = '';
                    var userFirstName = "{{$user->first_name}}";
                    var userRole = "{{$user->role_id}}";
                    var userAvatar = "{{$user->image_file}}";

                    if(userAvatar === '' || userAvatar === null) {
                        userAvatar = "{{asset('admin/img/user/avatar.png')}}";
                    }

                    if(userRole === "1") {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0 _admin">'
                            +'<div class="statistics__chat-place--avatar">'
                            +'<img src="'+userAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + $('#newTicketMessageText').val()
                            +'</div>'
                            + '<span class="statistics__chat-place--name">'
                            + userFirstName
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    } else {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0">'

                            +'<div class="statistics__chat-place--avatar mt-4">'
                            +'<img src="'+userAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + $('#newTicketMessageText').val()
                            +'</div>'
                            +'<span class="statistics__chat-place--name">'
                            + userFirstName
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    }
                    $('#newTicketMessageText').val('');
                    $('#showTicketMessage').append(ticketMessages);
                }

                $('#ticketSendMessageButton').prop('disabled', false)
            }).fail(function( data ) {

                var errors = '';
                $.each(data.responseJSON.errors, function (id, message) {
                    errors += '<div class="error" style="color: firebrick">'+message[0]+'</div>'
                });

                $('#ticketErrors').html(errors);
                $('#ticketSendMessageButton').prop('disabled', false)
            });
        }

        function newStatusChange(currentStatusName, currentStatusId, currentTicketId)
        {
            $('#currentStatusForTicket'+currentTicketId).html(currentStatusName);

            $.ajax({
                type: "POST",
                url: "{{route('admin.ticket.status.update', ['language' => Config::get('language.current')])}}",
                data: {
                    id: currentTicketId,
                    ticket_id: currentStatusId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {

            });

        }

        function changeStatus(ticketId)
        {
            $.ajax({
                type: "POST",
                url: "{{route('admin.ticket.status.update', ['language' => Config::get('language.current')])}}",
                data: {
                    id: ticketId,
                    ticket_id: $('#ticketStatus').val(),
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {

            });

        }

        function showTicketMessages(ticketId)
        {
            var statusList = '';
            $('#statusSelectBlock').html('').show();
            $('#statusSaveButton').show();
            $('#ticketDeleteButton').show();

            $.ajax({
                type: "GET",
                url: "{{route('admin.ticket.status.list', ['language' => Config::get('language.current')])}}",
                data: {}
            }).done(function(data) {
                statusList = data.result;
            });

            $.ajax({
                type: "GET",
                url: "{{route('admin.ticket.read', ['language' => Config::get('language.current')])}}",
                data: {
                    id : ticketId
                }
            }).done(function(data) {

                var statusSelector = '<select onchange="changeStatus('+ticketId+')" id="ticketStatus">';

                var dataSelector = '';

                var selectedStatusValue = '';

                $.each(statusList, function( index, value ) {

                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        if(data.data.status == "{{\App\Models\Ticket::WAIT_FOR_ADMIN_ANSWER}}") {
                            data.data.status = "{{\App\Models\Ticket::UNREAD_STATUS}}"
                        }

                        if(data.data.status == "{{\App\Models\Ticket::WAIT_FOR_USER_ANSWER}}") {
                            data.data.status = "{{\App\Models\Ticket::ANSWERED_STATUS}}"
                        }
                    @endif


                    @if(!\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        if(data.data.status == "{{\App\Models\Ticket::WAIT_FOR_ADMIN_ANSWER}}") {
                            data.data.status = "{{\App\Models\Ticket::ANSWERED_STATUS}}"
                        }

                        if(data.data.status == "{{\App\Models\Ticket::WAIT_FOR_USER_ANSWER}}") {
                            data.data.status = "{{\App\Models\Ticket::UNREAD_STATUS}}"
                        }
                    @endif


                    var functionValue = "'"+value+"'";

                    if (index == data.data.status) {
                        statusSelector += '<option selected value="'+index +'">'+value+'</option>';
                        selectedStatusValue = value;

                        dataSelector += '<li value="'+index+'" onclick="newStatusChange('+functionValue+','+index+','+ticketId+')">'+value+'</li>'

                    } else {

                        if(value !== 'process') {
                            statusSelector += '<option value="'+index +'">'+value+'</option>';
                            dataSelector += '<li value="'+index+'" onclick="newStatusChange('+functionValue+','+index+','+ticketId+')">'+value+'</li>'
                        }

                    }
                });

                statusSelector += '</select>';

                $('#statusSelectBlock').html(statusSelector);

                var newSelector = '<div class="select" id="newDivSelectorForTicket'+ticketId+'" onclick="addVariables('+ticketId+')">' +
                '<button class="select__btn" id="currentStatusForTicket'+ticketId+'">'+selectedStatusValue+'</button>' +
                '<ul class="select__list" id="newSelectorForTicket'+ticketId+'"></ul>' +
                '</div>';

                $('#newStatusSelector').html(newSelector);
                $('#newSelectorForTicket'+ ticketId).html(dataSelector);







                $('#ticketDeleteButton').html("<button type='button' onclick='deleteTicket("+ticketId+")'>Delete</button>");
                // statusList = data.result;
            });

            $('#ticketMessageAddingBlock').hide();
            $('#ticketMessageAddingBlock').show();
            $.ajax({
                type: "GET",
                url: "{{route('admin.ticket.message.ticket', ['language' => Config::get('language.current')])}}",
                data: {
                    ticket_id : ticketId
                }
            }).done(function(data) {

                var ticketMessages = '';
                $.each(data.data, function( index, value ) {
                    var UserAvatar = value.user_avatar;

                    if(UserAvatar === '' || UserAvatar === null) {
                        UserAvatar = "{{asset('admin/img/user/avatar.png')}}";
                    }
                    if(value.is_admin) {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0 _admin">'
                            +'<div class="statistics__chat-place--avatar">'
                            +'<img src="'+UserAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + value.message
                            +'</div>'
                            + '<span class="statistics__chat-place--name">'
                            + value.first_name
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    } else {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0">'

                            +'<div class="statistics__chat-place--avatar mt-4">'
                            +'<img src="'+UserAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + value.message
                            +'</div>'
                            +'<span class="statistics__chat-place--name">'
                            + value.first_name
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    }
                });

                $('#showTicketMessage').html(ticketMessages);
                $('#currentTicketId').val(ticketId);
            });
        }
    </script>
@stop
