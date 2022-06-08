@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="edit-form">
        <form action="#">
            @csrf
            <div id="orderFormMethod"></div>
            <div id="orderFormOrderId"></div>
            <div class="add-service-header-block">
                <div class="add-service-header">
                    <i class="fas fa-edit"></i>
                    <span id="orderFormLabel">{{ __('locale.drip_feed.form.edit_order') }}</span>
                </div>
                <div class="add-service-close">
                    <div class="cross"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="input-group mb-3" style="width: 45%">
                    <span class="input-group-text">{{ __('locale.drip_feed.form.order_id') }}</span>
                    <input type="text" class="form-control" id="orderid" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                </div>
                <div class="input-group mb-3" style="width: 45%">
                    <input type="text" class="form-control" id="orderidapi"aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                    <span class="input-group-text">{{ __('locale.drip_feed.form.api_order_id') }}</span>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ __('locale.drip_feed.form.type') }}</span>
                <input type="text" class="form-control" id="type" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ __('locale.drip_feed.form.user') }}</span>
                <input type="text" class="form-control" id="user" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ __('locale.drip_feed.form.service') }}</span>
                <input type="text" class="form-control" id="service" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="d-flex justify-content-between">
                <div class="input-group mb-3" style="width: 45%">
                    <span class="input-group-text">{{ __('locale.drip_feed.form.quantity') }}</span>
                    <input type="number" class="form-control" id="quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                </div>
                <div class="input-group mb-3" style="width: 45%">
                    <input type="number" class="form-control" id="amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                    <span class="input-group-text">{{ __('locale.drip_feed.form.amount') }}</span>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="input-vert mb-3" style="width: 30%">
                    <label for="counter">{{ __('locale.drip_feed.form.start_counter') }}</label>
                    <input type="text" class="form-control" id="counter" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-vert mb-3" style="width: 30%">
                    <label for="remains" id="inputGroup-sizing-default">{{ __('locale.drip_feed.form.remains') }}</label>
                    <input type="text" class="form-control" id="remains" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group edit-form-select" style="width: 30%; height: 70%; margin-top: 24px">
                    <select class="form-select" name="status" id="status" aria-label="Example select with button addon">
                        <option selected disabled>{{ __('locale.drip_feed.form.status') }}</option>
                        @foreach($statuses as $key => $status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">{{ __('locale.drip_feed.form.link') }}</span>
                <input type="text" class="form-control" id="url" aria-describedby="basic-addon3">
            </div>
            <div class="edit-form-submit-holder">
                <button class="edit-form-submit">{{ __('locale.drip_feed.form.submit') }}</button>
                <div class="edit-form-cancel">{{ __('locale.drip_feed.form.cancel') }}</div>
            </div>
        </form>
    </div>

    <div class="order__block mt-3">
        <div class="order__block--body _section-block">
            <div class="order__block--header _section-block-header">
                <div class="order__block--header-body d-flex flex-column">
                    <h2 class="order__block--title _title ps-md-4 pt-2 pb-4">
                        {{ __('locale.drip_feed.drip_feed.drip_feed') }}
                    </h2>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="error" style="color: firebrick">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="order__block--nav order__nav">
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <form
                                action="{{route('admin.order.drip-feed', ['language' => Config::get('language.current')])}}"
                                class="order__nav--search-form order__search-form ps-2 pe-2 ps-sm-4 pe-sm-4 pb-2"
                            >
                                <label class="order__search-form--label _form-label">
                                <span class="order__search-form--label-body _form-elem-wrapper">
                                    <span class="order__search-form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input type="text" name="search" placeholder="{{ __('locale.drip_feed.drip_feed.filter.search') }}" class="order__search-form--input _form-input _form-elem">
                                </span>
                                </label>
                                <label class="order__search-form--label _form-label">
                                <span class="order__search-form--label-body _form-elem-wrapper">
                                    <span class="order__search-form--icon _form-icon _icon-arrow"></span>
                                    <select name="search_field" class="order__search-form--select _form-select _form-elem">
                                        <option value="id" selected>{{ __('locale.drip_feed.drip_feed.filter.order_id') }}</option>
                                        <option value="api_order_id">{{ __('locale.drip_feed.drip_feed.filter.api_order_id') }}</option>
                                        <option value="link">{{ __('locale.drip_feed.drip_feed.filter.order_link') }}</option>
                                        <option value="user-email">{{ __('locale.drip_feed.drip_feed.filter.user_email') }}</option>
                                    </select>
                                </span>
                                </label>
                                <label class="order__search-form--label _form-label">
                                    <button
                                        type="submit"
                                        class="order__search-form--submit _form-btn _form-elem _icon-search"
                                        title="{{ __('locale.drip_feed.drip_feed.filter.search') }}"
                                    ></button>
                                </label>
                            </form>
                        @endif
                        <ul class="order__nav--list row ps-2 pe-2">
                            <li class="order__nav--item col-3 col-md-auto">
                                <a
                                    href="{{route('admin.order.drip-feed', ['language' => Config::get('language.current')])}}"
                                    class="order__nav--link _link"
                                >
                                    {{ __('locale.drip_feed.drip_feed.all') }}
                                </a>
                            </li>
                            @foreach($statuses as $status)
                                <li class="order__nav--item col-3 col-md-auto">
                                    <a
                                        href="{{route('admin.order.drip-feed', ['language' => Config::get('language.current'), 'status' => $status])}}"
                                        class="order__nav--link _link"
                                    >
                                        {{ucfirst($status)}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="order__block--table order__table _scrollbar-styles">
                <div class="order__table--body">
                    <div class="order__table--head order__head-table ps-4 pt-3">
                        <div class="order__head-table--id">
                            {{ __('locale.drip_feed.drip_feed.table.id') }}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <div class="order__head-table--api">
                                {{ __('locale.drip_feed.drip_feed.table.api_order') }}
                            </div>
                            <div class="order__head-table--user">
                                {{ __('locale.drip_feed.drip_feed.table.user') }}
                            </div>
                        @endif
                        <div class="order__head-table--details">
                            {{ __('locale.drip_feed.drip_feed.table.order_basic_details') }}
                        </div>
                        <div class="order__head-table--created">
                            {{ __('locale.drip_feed.drip_feed.table.created') }}
                        </div>
                        <div class="order__head-table--status">
                            {{ __('locale.drip_feed.drip_feed.table.status') }}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <div class="order__head-table--action">
                                {{ __('locale.drip_feed.drip_feed.table.action') }}
                            </div>
                        @endif
                    </div>
                    <div class="order__table--body order__body-table">
                        @foreach($orders as $order)
                            <div class="order__body-table--item pt-3 pb-3 ps-4">
                                <div class="order__body-table--id order__id">
                                    {{$order->id}}
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                    <div class="order__body-table--api order__api">
                                        {{$order->api_order_id}}
                                        {{--                                        {{$order->service->apiProvider->name}}--}}
                                    </div>

                                    <div class="order__body-table--user order__user">
                                        {{$order->user->first_name}}
                                    </div>
                                @endif
                                <div class="order__body-table--details order__details">
                                    <span class="order__details--icon _icon-followers me-3 mt-1"></span>
                                    <div class="order__details--block">
                                        <span class="order__details--name">
                                            {{ __('locale.drip_feed.drip_feed.table.instagram_followers') }}
                                        </span>
                                        <ul class="order__details--list">
                                            <li class="order__details--li">{{ __('locale.drip_feed.drip_feed.table.type') }} {{$order->type}}</li>
                                            <li class="order__details--li">{{ __('locale.drip_feed.drip_feed.table.link') }} {{$order->link}}</li>
                                            <li class="order__details--li">{{ __('locale.drip_feed.drip_feed.table.quantity') }} {{$order->quantity}}</li>
                                            <li class="order__details--li">{{ __('locale.drip_feed.drip_feed.table.charge') }} {{$order->charge}}</li>
                                            <li class="order__details--li">{{ __('locale.drip_feed.drip_feed.table.start_counter') }} {{$order->start_counter}}</li>
                                            <li class="order__details--li">{{ __('locale.drip_feed.drip_feed.table.remains') }} {{$order->remains}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="order__body-table--created order__created">
                                    {{$order->created_at->format('m.d.Y')}}
{{--                                    {{ Timezone::convertToLocal($order->created_at, 'm.d.Y') }}--}}
                                </div>
                                <div class="order__body-table--status order__status">
                                    <span class="order__status--elem _status-1">
                                        {{$order->status}}
                                    </span>
                                </div>
                                @if( \Illuminate\Support\Facades\Auth::user()->isAdmin() )
                                    <div class="order__body-table--action order__action">
                                        <a href="#" class="order__action--link _link" onclick="editOrder({{$order->id}})">
                                            <span class="order__action--icon _icon-edit"></span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <script>
        function editOrder(orderId)
        {
            $('#orderFormLabel').html('{{ __('locale.drip_feed.form.edit_order') }}');
            $('#orderFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
            $('#orderFormOrderId').html('<input type="hidden" name="id" value="'+orderId+'" />');
            $('#orderCreateForm').attr('action', '{{route('admin.order.update', ['language' => Config::get('language.current')])}}');

            $.ajax({
                type: "GET",
                url: "{{route('user.order.info', ['language' => Config::get('language.current')])}}",
                data: {
                    id : orderId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {

                $('#orderid').val(data.data.id);
                $('#link').val(data.data.link);
                $('#orderidapi').val(data.data.api_order_id);
                $('#type').val(data.data.type);
                $('#user').val(data.data.user.email);
                $('#service').val(data.data.service.name);
                $('#quantity').val(data.data.quantity);
                $('#amount').val(data.data.charge * data.data.quantity);
                $('#counter').val(data.data.start_counter);
                $('#remains').val(data.data.remains);
                $('#minamt').val(data.data.service.min);
                $('#maxamt').val(data.data.service.max);
                $('#rate').val(data.data.service.price);
                $('#status option').each(function (){
                    if ($(this).text() === data.data.status) {
                        $("#status").val($(this).val()).trigger('change');
                    }
                });
            });
        }

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= .1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        };

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "block";
            (function fade() {
                var val = parseFloat(el.style.opacity);
                if (!((val += .1) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        };

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
            fadeIn(overlay);
        }

        function addEdit() {
            var linksEdit = document.querySelectorAll("._icon-edit"),
                addForm = document.querySelector(".add-service"),
                formCloser = document.querySelector(".add-service-close");

            for(var i = 0; i < linksEdit.length; i++) {
                linksEdit[i].addEventListener("click", function(e) {
                    e.preventDefault();

                    putOverlay();
                    addForm.classList.add("active");

                    var overlay = document.querySelector(".madeup-overlay")

                    formCloser.addEventListener("click", function() {
                        addForm.classList.remove("active");
                        overlay.remove();
                    })

                    document.addEventListener("click", function(e) {
                        if(!(e.target.closest(".add-service")) && !(e.target.classList.contains("_icon-edit"))) {
                            overlay.remove();
                            addForm.classList.remove("active");
                        }
                    });
                    document.addEventListener("keydown", function(e) {
                        if(e.keyCode === 27) {
                            overlay.remove();
                            addForm.classList.remove("active");
                        }
                    })
                });
            }
        }

        addEdit();
    </script>
@stop
