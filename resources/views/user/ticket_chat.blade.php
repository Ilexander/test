@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
<div class="statistics__chat mt-2">
    <div class="statistics__chat--row row">
        <div class="statistics__chat--block _chat-block col-12 col-xl-9 col-md-8 mt-md-0 mt-3">
            <div class="statistics__chat--body _section-block p-0">
                <div class="statistics__chat--header _section-block-header ps-3 pe-3 pt-3">
                    <div style="width: 50%">
                        <h2 class="statistics__chat--title _title">
                            {{ __('locale.ticket.chat') }}
                        </h2>
                    </div>
                    <div id="statusSelectBlock"></div>
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
                            <button
                                type="button"
                                class="statistics__chat-place--submit-btn _btn _large-btn"
                                onclick="window.location.href='{{route('user.ticket.list', ['language' => Config::get('app.locale')])}}'"
                            >
                                Back
                            </button>
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

<script>
    showTicketMessages({{$ticket_id}})

    function showTicketMessages(ticketId)
    {
        var statusList = '';
        $('#statusSelectBlock').html('')

        $.ajax({
            type: "GET",
            url: "{{route('user.ticket.status.list', ['language' => Config::get('language.current')])}}",
            data: {}
        }).done(function(data) {
            statusList = data.result;
        });

        $.ajax({
            type: "GET",
            url: "{{route('user.ticket.read', ['language' => Config::get('language.current')])}}",
            data: {
                id : ticketId
            }
        }).done(function(data) {

            var status = '';

            $.each(statusList, function( index, value ) {
                if (index == data.data.status) {
                    status += '<h4>'+value+'</h4>';
                }
            });

            $('#statusSelectBlock').html(status)
        });

        $('#ticketMessageAddingBlock').hide();
        $('#ticketMessageAddingBlock').show();
        $.ajax({
            type: "GET",
            url: "{{route('user.ticket.message.ticket', ['language' => Config::get('language.current')])}}",
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

    function addNewMessage()
    {
        $('#ticketErrors').html('');
        $('#ticketSendMessageButton').prop('disabled', true)
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('user.ticket.message.create', ['language' => Config::get('language.current')])); ?>",
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
            $('#ticketSendMessageButton').prop('disabled', false);
        });
    }
</script>
@stop
