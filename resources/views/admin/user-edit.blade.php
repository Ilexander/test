@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="users-inside__row row">
        <div class="users-inside__block mt-3 col-12 col-xl-6">
            <div class="users-inside__block--body _section-block">
                <div class="users-inside__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <div class="users-inside__block--row _section-panel-active">
                        <h2 class="users-inside__block--title _title ps-2">
                            Basic information
                        </h2>
                        <div class="users-inside__block--panel _section-panel">
                            <div class="_section-panel-body pe-4 me-1">
                                <a href="#" class="_section-panel-link _hide-block-btn me-5 _link">

                                </a>
                                <a href="#" class="_section-panel-link _remove-block-btn ms-3 _link">
                                    <span class="_section-panel-icon "></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form
                    action="{{route('admin.user.update', ['language' => Config::get('language.current'), 'user' => $user->id])}}"
                    class="users-inside__block--form users-inside__form"
                    method="POST"
                >
                    @csrf
                    <input type="hidden" name="_method" value="PUT" />
                    <input type="hidden" name="id" value="{{$user->id}}" />
                    <div class="users-inside__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <div class="users-inside__form--row row ps-2 pe-2">
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        First name
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                <input type="text" value="{{$user->first_name}}" name="first_name" placeholder="First name" class="users-inside__form--input _form-input">
                            </span>
                            </label>
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                            <span class="users-inside__form--placeholder _form-placeholder">
                                Last name
                            </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <input type="text" value="{{$user->last_name}}" name="last_name" placeholder="First name" class="users-inside__form--input _form-input">
                            </span>
                            </label>
                        </div>
                        <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="users-inside__form--placeholder _form-placeholder">
                                    E-mail
                                </span>
                            <span class="users-inside__form--label-body _form-elem-wrapper">
                                    <input type="text" name="email" value="{{$user->email}}" placeholder="E-mail" class="users-inside__form--input _form-input">
                                </span>
                        </label>
                        <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="users-inside__form--placeholder _form-placeholder">
                                    Account type
                                </span>
                            <span class="users-inside__form--label-body _form-elem-wrapper">
                            <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                            <input
                                type="text"
                                value="{{$user->role->name}}"
                                name="role_name"
                                placeholder="Placeholder"
                                class="users-inside__form--input _form-input"
                            >
                            </span>
                        </label>
                        <div class="users-inside__form--row row ps-2 pe-2">
                            <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        Status
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-arrow"></span>
                                        <select name="status" class="users-inside__form--select _form-select">

                                            @foreach($statuses as $key => $status)
                                                <option value={{$key}} @if($user->status === $key) selected @endif>
                                                    {{ucfirst($status)}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </span>
                            </label>
                            <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label col-12 col-sm-6">
                                        <span class="users-inside__form--placeholder _form-placeholder">
                                            Time Zone
                                        </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                            <span class="users-inside__form--icon _form-icon _icon-arrow"></span>
                                            <select name="timezone" class="users-inside__form--select _form-select">
                                                @foreach($timezoneList as $name => $timezone)
                                                    <option value="{{$name}}" @if($user->timezone === $name) selected @endif>
                                                        ({{$timezone['diff_from_gtm']}}) {{$name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </span>
                            </label>
                        </div>
                        <div class="users-inside__form--row row ps-2 pe-2">
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        Password
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input type="password" name="change_password" placeholder="" class="users-inside__form--input _form-input">
                                    </span>
                            </label>
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        Confirm Password
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input type="password" name="confirm-password" placeholder="" class="users-inside__form--input _form-input">
                                    </span>
                            </label>
                            <div class="users-inside__form--note col-12 col-sm-6 pt-2 _pink _fs-12">
                                Note: If you don't want to change password then leave these password fields empty!
                            </div>
                        </div>
                        <label class="users-inside__form--label ps-2 pe-2 pt-3 _form-label">
                                <span class="users-inside__form--placeholder _form-placeholder">
                                    Description
                                </span>
                            <span class="users-inside__form--label-body _form-elem-wrapper _textarea-wrapper">
                            <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <textarea name="desc" rows="4" placeholder="Share a reply" class="users-inside__form--textarea _form-textarea">{{$user->desc}}
                                </textarea>
                            </span>
                        </label>
                        <div class="users-inside__form--row row ps-2 pe-2 pt-3">
                        <span class="users-inside__form--title fw-bold _fs-14">
                            Blocked payment methods:
                        </span>
                            @foreach($payments as $payment)
                                <div class="users-inside__form--switch col-6 col-sm-4 d-flex pt-2 pb-2">
                                    <input
                                        name="payments[]"
                                        value="{{$payment->id}}"
                                        type="checkbox"
                                        @if(in_array($payment->id, $canceledPayments)) checked @endif
                                        id="users-inside-checkbox-{{$payment->id}}"
                                        class="users-inside__form--switch-input _hidden-checkbox _form-switch-checkbox">
                                    <label
                                        for="users-inside-checkbox-{{$payment->id}}"
                                        class="users-inside__form--label _form-label-switch-checkbox d-flex align-items-center">
                                            <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray">
                                                {{$payment->name}}
                                            </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <button class="users-inside__form--submit _btn _large-btn me-2">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="users-inside__block mt-3 col-12 col-xl-6">
            <div class="users-inside__block--body _section-block">
                <div class="users-inside__block--header _section-block-header ps-4 pe-2 pb-1 pt-1">
                    <div class="users-inside__block--row _section-panel-active">
                        <h2 class="users-inside__block--title _title ps-2">
                            More information
                        </h2>
                        <div class="users-inside__block--panel _section-panel">
                            <div class="_section-panel-body pe-4 me-1">
                                <a href="#" class="_section-panel-link _hide-block-btn me-5 _link">

                                </a>
                                <a href="#" class="_section-panel-link _remove-block-btn ms-3 _link">

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form
                    action="{{route('admin.user.update', ['language' => Config::get('language.current'), 'user' => $user->id])}}"
                    class="users-inside__block--form users-inside__form"
                    method="POST"
                >
                    @csrf
                    <input type="hidden" name="_method" value="PUT" />
                    <input type="hidden" name="id" value="{{$user->id}}" />
                    <div class="users-inside__form--body p-3 ps-4 pe-4">
                        <div class="users-inside__form--row row ps-2 pe-2">
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        Website
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            type="text"
                                            name="more_information[website]"
                                            value="{{$user_more_information['website'] ?? ''}}"
                                            placeholder="" class="users-inside__form--input _form-input"
                                        >
                                    </span>
                            </label>
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        Phone
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            type="tel"
                                            name="more_information[phone]"
                                            placeholder=""
                                            value="{{$user_more_information['phone'] ?? ''}}"
                                            class="users-inside__form--input _form-input"
                                        >
                                    </span>
                            </label>
                        </div>
                        <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="users-inside__form--placeholder _form-placeholder">
                                    Skype
                                </span>
                            <span class="users-inside__form--label-body _form-elem-wrapper">
                                    <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input
                                        type="text"
                                        name="more_information[skype]"
                                        value="{{$user_more_information['skype'] ?? ''}}"
                                        placeholder="" class="users-inside__form--input _form-input"
                                    >
                                </span>
                        </label>
                        <div class="users-inside__form--row row ps-2 pe-2">
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        Address
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            type="text"
                                            name="more_information[address]"
                                            placeholder=""
                                            value="{{$user_more_information['address'] ?? ''}}"
                                            class="users-inside__form--input _form-input"
                                        >
                                    </span>
                            </label>
                            <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                    <span class="users-inside__form--placeholder _form-placeholder">
                                        WhatsApp Number
                                    </span>
                                <span class="users-inside__form--label-body _form-elem-wrapper">
                                        <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            type="text"
                                            name="more_information[whatsapp_number]"
                                            value="{{$user_more_information['whatsapp_number'] ?? ''}}"
                                            placeholder="" class="users-inside__form--input _form-input"
                                        >
                                    </span>
                            </label>
                            <div class="users-inside__form--note col-12 col-sm-6 pt-2 _pink _fs-12">
                                Note: If you don't want to change password then leave these password fields empty!
                            </div>
                            <div class="users-inside__form--min-item col-12 col-sm-6 pt-2 _fs-12">
                                    <span class="users-inside__form--subtitle _fs-12">
                                        Ignore minimum amount sum
                                    </span>
                                <div class="users-inside__form--row row">
                                    <div class="users-inside__form--switch col-6 d-flex pt-2 pb-2">
                                        <input @if(
                                                    isset(
                                                        $user_more_information['ignore_paypal_minimum_amount_sum'])
                                                        && $user_more_information['ignore_paypal_minimum_amount_sum'] === 'on'
                                                   ) checked @endif
                                               name="more_information[ignore_paypal_minimum_amount_sum]"
                                               type="checkbox"
                                               id="users-inside-checkbox-7"
                                               class="users-inside__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                        >
                                        <label for="users-inside-checkbox-7" class="users-inside__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray">
                                                    PayPal
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <button class="users-inside__form--submit _btn _large-btn me-2">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="users-inside__block mt-3 col-12 col-xl-6">
            <div class="users-inside__block--body _section-block">
                <div class="users-inside__block--header _section-block-header ps-4 pe-2 pb-1 pt-1">
                    <div class="users-inside__block--row _section-panel-active">
                        <h2 class="users-inside__block--title _title ps-2">
                            Add funds
                        </h2>
                        <div class="users-inside__block--panel _section-panel">
                            <div class="_section-panel-body pe-4 me-1">
                                <a href="#" class="_section-panel-link _hide-block-btn me-5 _link">

                                </a>
                                <a href="#" class="_section-panel-link _remove-block-btn ms-3 _link">

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form
                    action="{{route('admin.user.update', ['language' => Config::get('language.current'), 'user' => $user->id])}}"
                    class="users-inside__block--form users-inside__form"
                    method="POST"
                >
                    @csrf
                    <input type="hidden" name="_method" value="PUT" />
                    <input type="hidden" name="id" value="{{$user->id}}" />

                    <div class="users-inside__form--body p-3 ps-4 pe-4">
                        <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="users-inside__form--placeholder _form-placeholder">
                                    Funds
                                </span>
                            <span class="users-inside__form--label-body _form-elem-wrapper">
                                    <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input type="text" name="balance" value="{{$user->balance}}" placeholder="" class="users-inside__form--input _form-input">
                                </span>
                        </label>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <button class="users-inside__form--submit _btn _large-btn me-2">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let inputCloseBtns = document.querySelectorAll("._clear-input-btn");
        for(let i = 0; i < inputCloseBtns.length - 1; i++) {
            inputCloseBtns[i].addEventListener("click", (e) => {
                e.target.nextSibling.value = "";
                e.target.closest(".users-inside__form--label").style.display = "none";
            })
        }
    </script>
@stop
