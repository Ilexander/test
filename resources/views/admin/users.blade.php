@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="add-service">
        <form action="{{route('admin.subscription.send-mail', ['language' => Config::get('app.locale')])}}" method="POST">
            @csrf
            <input type="hidden" name="email" id="user_email">
            <div class="add-service-header-block">
                <div class="add-service-header">Send user a mail</div>
                <div class="add-service-close">
                    <div class="cross"></div>
                </div>
            </div>
            <hr>
            <div class="tarea-header mt-2">Message text</div>
            <div class="form-floating mt-2">
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
            <div class="add-service-buttons mt-2">
                <button type="submit" class="btn btn-success me-3 mt-2">Send</button>
                <button type="reset" class="btn btn-danger me-3 mt-2">Cancel</button>
            </div>
        </form>
    </div>

    <div class="users__block mt-3">
        <div class="users__block--body _section-block">
            <div class="users__block--header _section-block-header ps-2 ps-sm-4 pt-2 pb-2 pe-sm-4 pe-2">
                <div class="users__block--header-row row justify-content-between align-items-center">
                    <h2 class="users__block--title _title col-auto ps-3">
                        List
                    </h2>
                    <form action="{{route('admin.user.all', ['language' => Config::get('app.locale')])}}" class="users__block--form users__search d-flex col-auto pe-3">
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
                        <col class="users__table--col-4">
                        <col class="users__table--col-5">
                        <col class="users__table--col-6">
                        <col class="users__table--col-7">
                    </colgroup>
                    <thead>
                    <tr>
                        <td class="pb-1 ps-5 pt-4 pe-3">
                            No.
                        </td>
                        <td class="p-3 pb-1 pt-4">
                            User Profile
                        </td>
                        <td class="p-3 pb-1 pt-4">
                            Funds
                        </td>
                        <td class="p-3 pb-1 pt-4">
                            Custom Rate(%)
                        </td>
                        <td class="p-3 pb-1 pt-4">
                            Created
                        </td>
                        <td class="p-3 pb-1 pt-4 text-center">
                            Status
                        </td>
                        <td class="p-3 pb-1 pt-4 text-center">
                            Action
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="p-3 fw-semibold ps-5">
                                {{$user->id}}
                            </td>
                            <td class="p-3">
                                <div class="users__table--user-name fw-bold">
                                    {{$user->full_name}}
                                </div>
                                <div class="users__table--user-info">
                                    {{$user->email}}<br>
                                    @switch($user->role_id)
                                        @case(\App\Models\User::ROLE_ADMIN)
                                        Admin
                                        @break
                                        @case(\App\Models\User::ROLE_CLIENT)
                                        Regular User
                                        @break
                                    @endswitch
                                </div>
                            </td>
                            <td class="p-3">
                                $ {{$user->balance}}
                            </td>
                            <td class="p-3">
                                <a href="#users-popup-{{$user->id}}" class="users__table--custome-rate-link _btn-popup _btn _alt">
                                    <span class="users__table--custome-rate-link-icon _icon-plus"></span>
                                    Custom Rate
                                </a>
                            </td>
                            <td class="p-3">
                                {{$user->created_at->format('m.d.Y')}}
{{--                                {{ Timezone::convertToLocal($user->created_at, 'm.d.Y') }}--}}
                            </td>
                            <td class="p-3">
                                <div class="users__table--switch d-flex justify-content-center">
                                    <input
                                        @if($user->status) checked @endif
                                    type="checkbox"
                                        id="users-checkbox-{{$user->id}}"
                                        class="users__table--switch-input _hidden-checkbox _form-switch-checkbox user_status_checkbox"
                                        value="{{$user->id}}"
                                        onclick="changeStatus({{$user->id}})"
                                    >
                                    <label for="users-checkbox-{{$user->id}}" class="users__table--label _form-label-switch-checkbox"></label>
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="users__table--action users__action _sub-parent d-flex justify-content-center pe-3">
                                    <a href="#" class="users__action--link _sub-open _link _icon-details"></a>
                                    <ul class="users__action--sub-list _sub-list">
                                        <li class="users__action--sub-item">
                                            <a
                                                href="{{route('admin.user.edit', ['language' => Config::get('language.current'), 'user' => $user->id])}}"
                                                class="users__action--sub-link _link"
                                            >
                                                <span class="users__action--sub-icon _icon-edit-alt"></span>
                                                Edit
                                            </a>
                                        </li>
                                        <li class="users__action--sub-item" onclick="loginAsUser({{$user->id}})">
                                            <a href="#" class="users__action--sub-link _link">
                                                <span class="users__action--sub-icon _icon-eye"></span>
                                                View User
                                            </a>
                                        </li>
                                        <li class="users__action--sub-item">
                                            <a href="#" class="users__action--sub-link _link _link-del">
                                                <span class="users__action--sub-icon _icon-trash"></span>
                                                Delete
                                            </a>
                                        </li>
                                        <li class="users__action--sub-item" onclick="addSendMail('{{$user->email}}')">
                                            <a href="#" class="users__action--sub-link _link _link-mail">
                                                <span class="users__action--sub-icon _icon-mail"></span>
                                                Send Mail
                                            </a>
                                        </li>
                                        <li class="users__action--sub-item">
                                            <a href="{{route('admin.user.edit', ['language' => Config::get('language.current'), 'user' => $user->id])}}" class="users__action--sub-link _link">
                                                <span class="users__action--sub-icon _icon-dollar"></span>
                                                Add funds
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </form>
            @foreach($users as $user)
                <div class="users-block__popup _popup" id="users-popup-{{$user->id}}">
                    <div class="_popup-wrapper">
                        <div class="users-block__popup--bg _popup-bg"></div>
                        <form
                            action="{{route('admin.user-price.create', ['language' => Config::get('language.current')])}}"
                            class="users-block__popup--body _popup-body p-0"
                            method="POST"
                        >
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button type="button" class="users-block__popup--close-btn _popup-close-btn _close-popup">
                                ✕
                            </button>
                            <div class="users-block__popup--header _section-block-header p-3 pt-4 ps-4 pe-4">
                                <h2 class="users-block__popup--title _title ps-2 pe-2">
                                    Edit custom  rates ({{$user->email}})
                                </h2>
                            </div>
                            <div class="users-block__popup--row p-4">
                                <label class="users-block__popup--label _form-label ps-2 pe-2">
                                    <select id="userPriceAddingService" class="support__form--select _form-select _focus-event">
                                        <option value="none" selected="" disabled="">Add Custom Rate</option>
                                        @foreach($services as $service)
                                            <option value="{{$user->id}}-{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="users-block__popup--inner _scrollbar-styles">
                                <table class="users-block__popup--table _table">
                                    <colgroup>
                                        <col class="users-block__popup--table-col-1">
                                        <col class="users-block__popup--table-col-2">
                                        <col class="users-block__popup--table-col-3">
                                        <col class="users-block__popup--table-col-4">
                                        <col class="users-block__popup--table-col-5">
                                    </colgroup>
                                    <tbody id="userPriceShowTable-{{$user->id}}">
                                    @foreach($user->userPrice as $userPrice)
                                        <tr id="userPriceShowItem-{{$userPrice->id}}" class="userPriceItem-{{$user->id}}">
                                            <td class="p-3 fw-semibold">
                                                    <span class="ps-4">
                                                        {{$userPrice->id}}
                                                    </span>
                                            </td>
                                            <td class="p-3 fw-semibold">
                                                <input type="hidden" name="services[]" value="{{$userPrice->service->id}}">
                                                {{$userPrice->service->name}}
                                            </td>
                                            <td class="p-3">
                                                <div class="users-block__popup--table-value fw-bold">{{round($userPrice->service->price, 2)}}</div>
                                                <div class="users-block__popup--table-value">{{round($userPrice->service->original_price, 2)}}</div>
                                            </td>
                                            <td class="p-3">
                                                <label class="users-block__popup--label _form-label">
                                                    <input type="text" name="service_prices[]" value="{{round($userPrice->service_price, 2)}}" class="users-block__popup--input _form-input">
                                                </label>
                                            </td>
                                            <td class="p-3">
                                                <div class="users-block__popup--btn-body pe-4">
                                                    <buttom
                                                        type="button"
                                                        class="users-block__popup--btn-remove _icon-trash"
                                                        onclick="removeUserPrice({{$userPrice->id}})"
                                                    ></buttom>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="users-block__popup--row p-4 pt-0 mt-2 _section-block-footer">
                                <div class="users-block__popup--footer mt-4 ps-2 pe-2 d-flex justify-content-between flex-wrap align-items-center flex-md-row flex-column">
                                    <div class="users-block__popup--footer-item">
                                        <button type="button" class="users-block__popup--delete-all" onclick="removeAllUserPrice({{$user->id}})">
                                            Delete all
                                        </button>
                                    </div>
                                    <div class="users-block__popup--footer-item">
                                        <button type="submit" class="users-block__popup--submit _btn _large-btn me-3">
                                            Save
                                        </button>
                                        <button type="button" class="users-block__popup--close _close-popup _btn _large-btn _disabled">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>

        function changeStatus(userId)
        {
            $.ajax({
                type: "POST",
                url: "{{route('admin.user.change-status', ['language' => Config::get('language.current')]) }}",
                data: {
                    id : userId,
                    _token : "{{ csrf_token() }}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    {{--window.location.href = "{{route('admin.dashboard', ['language' => Config::get('language.current')])}}";--}}
                }
            });
        }

        function loginAsUser(userId)
        {
            $.ajax({
                type: "POST",
                url: "{{route('admin.user.login-as', ['language' => Config::get('language.current')]) }}",
                data: {
                    id : userId,
                    _token : "{{ csrf_token() }}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    window.location.href = "{{route('admin.dashboard', ['language' => Config::get('language.current')])}}";
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
            $('#user_email').val(email)
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
