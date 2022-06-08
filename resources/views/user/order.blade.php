@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="add-service">
        <form action="#" id="orderCreateForm" method="POST">
            @csrf
            <div id="orderFormMethod"></div>
            <div id="orderFormOrderId"></div>
            <div class="add-service-header-block">
                <div class="add-service-header">
                    <i class="fas fa-edit"></i>
                    <span id="orderFormLabel">{{ __('locale.order_log.form.edit_order') }}</span>
                </div>
                <div class="add-service-close">
                    <div class="cross"></div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div class="input-group mb-3" style="width: 45%">
                    <span class="input-group-text">{{ __('locale.order_log.form.order_id') }}</span>
                    <input type="text" class="form-control" id="orderid" readonly>
                </div>
                <div class="input-group mb-3" style="width: 45%">
                    <span class="input-group-text">{{ __('locale.order_log.form.api_order_id') }}</span>
                    <input type="text" class="form-control" id="orderidapi" disabled>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ __('locale.order_log.form.type') }}</span>
                <input type="text" class="form-control" id="type" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ __('locale.order_log.form.user') }}</span>
                <input type="text" class="form-control" id="user" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ __('locale.order_log.form.service') }}</span>
                <input type="text" class="form-control" id="service" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="d-flex justify-content-between">
                <div class="input-group mb-3" style="width: 45%">
                    <span class="input-group-text">{{ __('locale.order_log.form.quantity') }}</span>
                    <input type="number" class="form-control" id="quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                </div>
                <div class="input-group mb-3" style="width: 45%">
                    <input type="number" class="form-control" id="amount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
                    <span class="input-group-text">{{ __('locale.order_log.form.amount') }}</span>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="input-vert mb-3" style="width: 30%">
                    <label for="counter">{{ __('locale.order_log.form.start_counter') }}</label>
                    <input type="text" class="form-control" name="start_counter" id="counter" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-vert mb-3" style="width: 30%">
                    <label for="remains" id="inputGroup-sizing-default">{{ __('locale.order_log.form.remains') }}</label>
                    <input type="text" class="form-control" name="remains" id="remains" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group edit-form-select" style="width: 30%; height: 70%; margin-top: 24px">
                    <select class="form-select" name="status" id="status" aria-label="Example select with button addon">
                        <option selected disabled>{{ __('locale.order_log.order_logs.status.all') }}</option>
                        @foreach($statuses as $key => $status)
                            <option value="{{$key}}">{{ __('locale.order_log.order_logs.status.'.$status) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="input-vert mb-12" style="width: 100%">
                <label for="remains" id="inputGroup-sizing-default">{{ __('locale.order_log.form.link') }}</label>
                <input type="text" class="form-control" name="link" id="link" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            {{--        <div class="d-flex justify-content-between mt-2">--}}
            {{--            <div class="input-group" style="width: 30%">--}}
            {{--                <label for="minamt" style="width: 100%">Minimum Amount</label>--}}
            {{--                <input class="form-control" type="number" id="minamt" name="type" min="1" max="19999" placeholder="50">--}}
            {{--            </div>--}}
            {{--            <div class="input-group" style="width: 30%">--}}
            {{--                <label for="maxamt" style="width: 100%">Maximum Amount</label>--}}
            {{--                <input class="form-control" type="number" id="maxamt" name="maxamt" min="1" max="20000" placeholder="20000">--}}
            {{--            </div>--}}
            {{--            <div class="input-group" style="width: 30%">--}}
            {{--                <label for="rate" style="width: 100%">Rate per 1000</label>--}}
            {{--                <input class="form-control" type="text" id="rate" name="rate" placeholder="0.80">--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <div class="add-service-buttons mt-2">
                <button type="submit" class="btn btn-success me-3 mt-2">{{ __('locale.order_log.form.submit') }}</button>
                <button type="reset" class="btn btn-danger me-3 mt-2">{{ __('locale.order_log.form.cancel') }}</button>
            </div>
        </form>
    </div>
    <div class="order__block mt-3">
        <div class="order__block--body _section-block">
            <div class="order__block--header _section-block-header">
                <div class="order__block--header-body d-flex flex-column">
                    <h2 class="order__block--title _title ps-md-4 pt-2 pb-4">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="error" style="color: firebrick">{{$error}}</div>
                            @endforeach
                        @endif
                        {{ __('locale.order_log.order_logs.order_logs') }}
                    </h2>
                    <div class="order__block--nav order__nav">
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <form
                                action="{{route('user.order.all', ['language' => Config::get('language.current')])}}"
                                class="order__nav--search-form order__search-form ps-sm-4 pe-sm-4 pb-2"
                            >
                                <label class="order__search-form--label _form-label">
                                <span class="order__search-form--label-body _form-elem-wrapper">
                                    <span class="order__search-form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input type="text" name="search" placeholder="{{ __('locale.order_log.order_logs.filter.search') }}" class="order__search-form--input _form-input _form-elem">
                                </span>
                                </label>
                                <label class="order__search-form--label _form-label">
                                <span class="order__search-form--label-body _form-elem-wrapper">
                                    <span class="order__search-form--icon _form-icon _icon-arrow"></span>
                                    <select name="search_field" class="order__search-form--select _form-select _form-elem">
                                        <option value="id" selected>{{ __('locale.order_log.order_logs.filter.order_id') }}</option>
                                        <option value="api_order_id">{{ __('locale.order_log.order_logs.filter.api_order_id') }}</option>
                                        <option value="link">{{ __('locale.order_log.order_logs.filter.order_link') }}</option>
                                        <option value="user-email">{{ __('locale.order_log.order_logs.filter.user_email') }}</option>
                                    </select>
                                </span>
                                </label>
                                <label class="order__search-form--label _form-label">
                                    <button
                                        type="submit"
                                        class="order__search-form--submit _form-btn _form-elem _icon-search"
                                        title="{{ __('locale.order_log.order_logs.filter.search') }}"
                                    ></button>
                                </label>
                            </form>
                        @endif
                        <div class="order__nav-list-holder _scrollbar-styles">
                            <ul class="order__nav--list row ps-2 pe-2">
                                <li class="order__nav--item col-3 col-md-auto">
                                    <a
                                        href="{{route('user.order.all', ['language' => Config::get('language.current')])}}"
                                        class="order__nav--link _link"
                                    >
                                        {{ __('locale.order_log.order_logs.status.all') }}
                                    </a>
                                </li>
                                @foreach($statuses as $status)
                                    <li class="order__nav--item col-3 col-md-auto">
                                        <a
                                            href="{{route('user.order.all', ['language' => Config::get('language.current'), 'status' => $status])}}"
                                            class="order__nav--link _link"
                                        >
                                            {{ucfirst(__('locale.order_log.order_logs.status.'.$status))}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order__block--table order__table _scrollbar-styles">
                <div class="order__table--body">
                    <div class="order__table--head order__head-table ps-4 pt-3">
                        <div class="order__head-table--id">
                            {{ __('locale.order_log.order_logs.table.id') }}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <div class="order__head-table--api">
                                {{ __('locale.order_log.order_logs.table.api_order') }}
                            </div>
                            <div class="order__head-table--user">
                                {{ __('locale.order_log.order_logs.table.user') }}
                            </div>
                        @endif
                        <div class="order__head-table--details">
                            {{ __('locale.order_log.order_logs.table.order_basic_details') }}
                        </div>
                        <div class="order__head-table--created">
                            {{ __('locale.order_log.order_logs.table.created') }}
                        </div>
                        <div class="order__head-table--status">
                            {{ __('locale.order_log.order_logs.table.status') }}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <div class="order__head-table--action">
                                {{ __('locale.order_log.order_logs.table.action') }}
                            </div>
                        @endif
                    </div>
                    <div class="order__table--body order__body-table">
                        @foreach($orders as $order)
                            <div class="order__body-table--item pt-3 pb-10 ps-10" id="orderRow{{$order->id}}">
                                <div class="order__body-table--id order__id">
                                    {{$order->id}}
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                    <div class="order__body-table--api order__api">
                                        {{$order->api_order_id}}
                                        {{--                                        {{$order->service->apiProvider->name}}--}}
                                    </div>

                                    <div class="order__body-table--user order__user">
                                        {{$order->user->email}}
                                    </div>
                                @endif
                                <div class="order__body-table--details order__details">
                                    <span class="order__details--icon _icon-followers me-3 mt-1"></span>
                                    <div class="order__details--block">
                                        <span class="order__details--name">
                                            {{ __('locale.order_log.order_logs.table.instagram_followers') }}
                                        </span>
                                        <ul class="order__details--list">
                                            <li class="order__details--li">{{ __('locale.order_log.order_logs.table.type') }} {{$order->type}}</li>
                                            <li class="order__details--li">
                                                {{ __('locale.order_log.order_logs.table.link') }}
                                                <a href=" {{$order->link}}" target="_blank"> {{$order->link}}</a>
                                            </li>
                                            <li class="order__details--li">{{ __('locale.order_log.order_logs.table.quantity') }} {{$order->quantity}}</li>
                                            <li class="order__details--li">{{ __('locale.order_log.order_logs.table.charge') }} {{$order->charge}}</li>
                                            <li class="order__details--li">{{ __('locale.order_log.order_logs.table.start_counter') }} {{$order->start_counter}}</li>
                                            <li class="order__details--li">{{ __('locale.order_log.order_logs.table.remains') }} {{$order->remains}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="order__body-table--created order__created">
                                    {{$order->created_at ? $order->created_at->format('m.d.Y') : ''}}
{{--                                    {{ Timezone::convertToLocal($order->created_at, 'm.d.Y') }}--}}
                                </div>
                                <div class="order__body-table--status order__status">
                                    <span
                                        class="order__status--elem _status-1"
                                        @if(\App\Models\Order::ORDER_STATUS_CANCELED == $order->status)
                                            style="color: firebrick"
                                        @endif
                                    >
                                        {{$order->status}}
                                    </span>
                                </div>
                                @if( \Illuminate\Support\Facades\Auth::user()->isAdmin() )
                                    <div class="order__body-table--action order__action">

                                            <a href="#" class="order__action--link _link" onclick="editOrder({{$order->id}})">
                                                <span class="order__action--icon _icon-edit"></span>
                                            </a>

                                            <a href="#" onclick="deleteOrder({{$order->id}})" class="users__action--sub-link _link _link-del">
                                                <span class="users__action--sub-icon _icon-trash"></span>
                                            </a>

                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>

    <script>
        function deleteOrder(orderId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{route('admin.order.delete', ['language' => Config::get('language.current')])}}",
                data: {
                    id : orderId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                $('#orderRow'+orderId).hide();
            });
        }
        function editOrder(orderId)
        {
            $('#orderFormLabel').html('{{ __('locale.order_log.form.edit_order') }}');
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
