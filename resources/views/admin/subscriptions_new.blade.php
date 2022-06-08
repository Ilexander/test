@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="add-service">
        <form action="{{route('admin.subscription.send-mail', ['language' => Config::get('app.locale')])}}" method="POST">
            @csrf
            <input type="hidden" name="email" id="subscriber_email">
            <div class="add-service-header-block">
                <div class="add-service-header">{{ __('locale.subscription.form.send_user_a_mail') }}</div>
                <div class="add-service-close">
                    <div class="cross"></div>
                </div>
            </div>
            <hr>
            <div class="tarea-header mt-2">{{ __('locale.subscription.form.message_text') }}</div>
            <div class="form-floating mt-2">
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
            <div class="add-service-buttons mt-2">
                <button type="submit" class="btn btn-success me-3 mt-2">{{ __('locale.subscription.form.send') }}</button>
                <button type="reset" class="btn btn-danger me-3 mt-2">{{ __('locale.subscription.form.cancel') }}</button>
            </div>
        </form>
    </div>

    <div class="users__block mt-3">
        <div class="users__block--body _section-block">
            <div class="users__block--header _section-block-header ps-2 ps-sm-4 pt-2 pb-2 pe-sm-4 pe-2">
                <div class="users__block--header-row row justify-content-between align-items-center">
                    <h2 class="users__block--title _title col-auto ps-3">
                        {{ __('locale.subscription.list') }}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="error" style="color: firebrick">{{$error}}</div>
                            @endforeach
                        @endif
                    </h2>
                    <form
                        action="{{route('admin.subscription.all', ['language' => Config::get('app.locale')])}}"
                        class="users__block--form users__search d-flex col-auto pe-3"
                    >
                        <label class="users__search--label _form-label">
                        <span class="users__search--label-body _form-elem-wrapper">
                            <span class="users__search--icon _form-icon _icon-arrow"></span>
                            <input type="search" name="search" class="users__search--select _form-select">
                        </span>
                        </label>
                        <label class="users__search--label _form-label">
                            <button class="users__search--submit _btn _icon-search"></button>
                        </label>
                    </form>
                </div>
            </div>
            <form action="#" class="users__block--wrapper _scrollbar-styles">
                <table class="users__block--table users__table _table">
                    <colgroup>
                        <col class="users__table--col-1">
                        <col class="users__table--col-2">
                        <col class="users__table--col-3">
                    </colgroup>
                    <thead>
                    <tr>
                        <td class="pb-1 ps-5 pt-4 pe-3">
                            {{ __('locale.subscription.table.no') }}
                        </td>
                        <td class="p-3 pb-1 pt-4">
                            {{ __('locale.subscription.table.email') }}
                        </td>
                        <td class="p-3 pb-1 pt-4">
                            {{ __('locale.subscription.table.created') }}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <!--foreach-->
                    @foreach($subscribers as $subscriber)
                        <tr id="subscriber-{{$subscriber->id}}">
                            <td class="p-3 fw-semibold ps-5">
                                {{$subscriber->id}}
                            </td>
                            <td class="p-3">
                                <div class="users__table--user-email fw-bold">
                                    {{$subscriber->email}}
                                </div>
                            </td>
                            <td class="p-3">
                                {{$subscriber->created_at->format('m.d.Y')}}
{{--                                {{ Timezone::convertToLocal($subscriber->created_at, 'm.d.Y') }}--}}
                            </td>
                            <td class="p-3">
                                <div class="users__table--action users__action _sub-parent d-flex justify-content-center pe-3">
                                    <a href="#" class="users__action--link _sub-open _link _icon-details"></a>
                                    <ul class="users__action--sub-list _sub-list">
                                        <li class="users__action--sub-item">
                                            <a href="#" class="users__action--sub-link _link _link-del" onclick="deleteSubscription({{$subscriber->id}})">
                                                <span class="users__action--sub-icon _icon-trash"></span>
                                                {{ __('locale.subscription.table.delete') }}
                                            </a>
                                        </li>
                                        <li class="users__action--sub-item" onclick="addSendMail('{{$subscriber->email}}')">
                                            <a href="#" class="users__action--sub-link _link _link-mail">
                                                <span class="users__action--sub-icon _icon-mail"></span>
                                                {{ __('locale.subscription.table.send_mail') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <!-- endforeach -->
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script>

        function deleteSubscription(subscriptionId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{route('admin.subscription.delete', ['language' => Config::get('language.current')])}}",
                data: {
                    id : subscriptionId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    $('#subscriber-'+subscriptionId).hide();
                }
            });
        }

        $('.user_status_checkbox').change(function() {

        });


        function removeUserPrice(userPriceId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{route('admin.user-price.delete', ['language' => Config::get('language.current')]) }}",
                data: {
                    id : userPriceId,
                    _token : "{{ csrf_token() }}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    $('#userPriceShowItem-'+userPriceId).hide();
                }
            });
        }

        function removeAllUserPrice(userId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{ route('admin.user-price.delete-for-user', ['language' => Config::get('language.current')]) }}",
                data: {
                    user_id : userId,
                    _token : "{{ csrf_token() }}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    $('.userPriceItem-'+userId).hide();
                }
            });
        }

        $('#userPriceAddingService').on('change', function (){

            var result = $(this).val().split('-');

            var userId = result[0];
            var serviceId = result[1];

            $.ajax({
                type: "GET",
                url: "{{route('service.info', ['language' => Config::get('language.current')])}}",
                data: {
                    id : serviceId,
                }
            }).done(function(data) {

                var service = '<tr>'
                    +'<td class="p-3 fw-semibold">'
                    +'<span class="ps-4">'
                    +data.data.id
                    +'</span>'
                    +'</td>'
                    +'<td class="p-3 fw-semibold">'
                    +'<input type="hidden" name="services[]" value="'+data.data.id+'">'
                    +data.data.name
                    +'</td>'
                    +'<td class="p-3">'
                    +'<div class="users-block__popup--table-value fw-bold">'
                    +data.data.price
                    +'</div>'
                    +'<div class="users-block__popup--table-value">'
                    +data.data.original_price
                    +'</div>'
                    +'</td>'
                    +'<td class="p-3">'
                    +'<label class="users-block__popup--label _form-label">'
                    +'<input name="service_prices[]" type="text" value="'+data.data.price+'" class="users-block__popup--input _form-input">'
                    +'</label>'
                    +'</td>'
                    +'<td class="p-3">'
                    +'<div class="users-block__popup--btn-body pe-4">'
                    +'<buttom type="button" class="users-block__popup--btn-remove _icon-trash"></buttom>'
                    +'</div>'
                    +'</td>'
                    +'</tr>';

                $('#userPriceShowTable-'+userId).append(service);
            });
        });

        function putOverlay() {
            var overlay = document.createElement("div");
            overlay.classList.add("madeup-overlay")
            var ovStyles = {
                "height": "100vh",
                "width": "100%",
                "background-color": "rgba(0, 0, 0, .7)",
                "z-index": 5,
                "position": "fixed",
                "top": 0,
                "left": 0,
                "display": "none",
            }
            Object.assign(overlay.style, ovStyles);
            document.querySelector('body').appendChild(overlay);
            $(overlay).fadeIn();
        }

        function addDelete() {
            var linksDel = document.querySelectorAll("._link-del");
            for(var i = 0; i < linksDel.length; i++) {
                linksDel[i].addEventListener("click", function(e) {
                    e.preventDefault();
                    this.closest("tr").remove();
                });
            }
        }

        function addSendMail(email) {
            $('#subscriber_email').val(email)
            var linksSend = document.querySelectorAll("._link-mail");
            for(var j = 0; j < linksSend.length; j++) {
                linksSend[j].addEventListener("click", function(e) {
                    e.preventDefault();
                    putOverlay();

                    var formLetter = document.querySelector(".add-service");
                    var formCloser = document.querySelector(".add-service-close");
                    var overlay = document.querySelector(".madeup-overlay");

                    formLetter.classList.add("active");

                    formCloser.addEventListener("click", function() {
                        formLetter.classList.remove("active");
                        overlay.remove();
                    })

                    document.addEventListener("click", function(e) {
                        if(!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-mail"))) {
                            overlay.remove();
                            formLetter.classList.remove("active");
                        }
                    });
                    document.addEventListener("keydown", function(e) {
                        if(e.keyCode === 27) {
                            overlay.remove();
                            formLetter.classList.remove("active");
                        }
                    })

                });
            }
        }

        // ClassicEditor
        //     .create( document.querySelector( '#message' ) )
        //     .catch( error => {
        //         console.error( error );
        //     } );

        addDelete();
        addSendMail('');
    </script>
@stop
