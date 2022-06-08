@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
    <div id="settingErrors"></div>
    @switch($page)
        @case(\App\Models\Settings::GENERAL_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        WebSite Settings
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="status"
                                @if(isset($settings['status']) && json_decode($settings['status']['field_value'])) checked @endif
                                type="checkbox"
                                id="website-settings-checkbox-active"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="website-settings-checkbox-active" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                    <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                        Active
                                    </span>
                            </label>
                        </div>
                        <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                            Note: Make sure you remember this link to get access Maintenance mode before you activate:
                        </div>
                        <a href="#" class="website-settings__form--link p-2 pt-0 _fs-12">
                            https://follow.sale/maintenance/access
                        </a>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Website name
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input
                                        @if(isset($settings['website_name']))
                                        value="{{$settings['website_name']['field_value']}}"
                                        @endif
                                        type="text"
                                        name="website_name"
                                        placeholder=""
                                        class="website-settings-field website-settings__form--input _form-input"
                                    >
                                </span>
                        </label>
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Website Description
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <textarea
                                    name="website_description"
                                    rows="4"
                                    placeholder="Share a reply"
                                    class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                    style="resize: none;"
                                >@if(isset($settings['website_description'])){{$settings['website_description']['field_value']}}@endif</textarea>
                            </span>
                        </label>
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Website keywords
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <textarea
                                        name="website_keywords"
                                        rows="4"
                                        placeholder="Share a reply"
                                        class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                        style="resize: none;"
                                    >@if(isset($settings['website_keywords'])){{$settings['website_keywords']['field_value']}}@endif</textarea>
                                </span>
                        </label>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Website title
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <input
                                    @if(isset($settings['website_title']))
                                    value="{{$settings['website_title']['field_value']}}"
                                    @endif
                                    type="text"
                                    name="website_title"
                                    placeholder=""
                                    class="website-settings-field website-settings__form--input _form-input"
                                >
                            </span>
                        </label>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::LOGO_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Website Logo
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <label class="preview-image website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                            <div class="website-settings__form--placeholder _form-placeholder">
                                @if(isset($settings['website_favicon']))
                                    <img src="{{$settings['website_favicon']['field_value']}}">
                                @endif
                                Website favicon
                            </div>
                            <span class="website-settings__form--label-body _form-elem-wrapper" style="width: 100%;">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input
                                        @if(isset($settings['website_favicon']))
                                        value="{{$settings['website_favicon']['field_value']}}"
                                        @endif
                                        type="file"
                                        name="website_favicon"
                                        class="website-settings-field website-settings__form--input _form-input"
                                        style="display: block;"
                                    >
                                </span>
                        </label>
                        <label class="preview-image website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                            <div class="website-settings__form--placeholder _form-placeholder">
                                @if(isset($settings['website_logo']))
                                    <img src="{{$settings['website_logo']['field_value']}}">
                                @endif
                                Website Logo
                            </div>
                            <span class="website-settings__form--label-body _form-elem-wrapper" style="width: 100%;">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input
                                        @if(isset($settings['website_logo']))
                                        value="{{$settings['website_logo']['field_value']}}"
                                        @endif
                                        type="file"
                                        name="website_logo"
                                        placeholder=""
                                        class="website-settings-field website-settings__form--input _form-input"
                                        style="display: block"
                                    >
                                </span>
                        </label>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label preview-image">
                            <div class="website-settings__form--placeholder _form-placeholder">
                                @if(isset($settings['website_logo_white']))
                                    <img src="{{$settings['website_logo_white']['field_value']}}">
                                @endif
                                Website logo (white)
                            </div>
                            <span class="website-settings__form--label-body _form-elem-wrapper" style="width: 100%;">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input
                                        @if(isset($settings['website_logo_white']))
                                        value="{{$settings['website_logo_white']['field_value']}}"
                                        @endif
                                        type="file"
                                        name="website_logo_white"
                                        placeholder=""
                                        class="website-settings-field website-settings__form--input _form-input"
                                        style="display: block"
                                    >
                                </span>
                        </label>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::COOKIE_POLICY_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Cookie Policy Page
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="status"
                                @if(isset($settings['status']) && json_decode($settings['status']['field_value'])) checked @endif
                                type="checkbox"
                                id="cookie-policy-checkbox-active"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="cookie-policy-checkbox-active" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                    <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                        Active
                                    </span>
                            </label>
                        </div>
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Content
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <textarea
                                    name="cookie_policy_description"
                                    rows="4"
                                    placeholder="Share a reply"
                                    class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                    style="resize: none;"
                                >@if(isset($settings['cookie_policy_description'])){{$settings['cookie_policy_description']['field_value']}}@endif</textarea>
                            </span>
                        </label>

                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::TERMS_POLICY_PAGE_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Terms & Policy
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Content of Terms
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <textarea
                                        name="content_of_terms"
                                        rows="4"
                                        placeholder="Share a reply"
                                        class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                        style="resize: none;"
                                    >@if(isset($settings['content_of_terms'])){{$settings['content_of_terms']['field_value']}}@endif</textarea>
                                </span>
                        </label>
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Content of Policy
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <textarea
                                        name="content_of_policy"
                                        rows="4"
                                        placeholder="Share a reply"
                                        class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                        style="resize: none;"
                                    >@if(isset($settings['content_of_policy'])){{$settings['content_of_policy']['field_value']}}@endif</textarea>
                                </span>
                        </label>

                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::DEFAULT_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Default Setting
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <label style="width: 45%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Default Homepage
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['default_homepage']))
                                                value="{{$settings['default_homepage']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="default_homepage"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label style="width: 45%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                             Header Menu Skin Colors
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['header_menu_skin_colors']))
                                                value="{{$settings['header_menu_skin_colors']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="header_menu_skin_colors"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label style="width: 45%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Pagination
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['pagination']))
                                                value="{{$settings['pagination']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="pagination"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <br/>
                        <br/>
                        <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                            Auto clear ticket lists
                        </div>
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="auto_clear_ticket_lists_status"
                                @if(
                                    isset($settings['auto_clear_ticket_lists_status'])
                                    && json_decode($settings['auto_clear_ticket_lists_status']['field_value'])
                                )
                                checked
                                @endif
                                type="checkbox"
                                id="auto_clear_ticket_lists_status"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="auto_clear_ticket_lists_status" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                            <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                Active
                                            </span>
                            </label>
                        </div>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Clear Ticket lists (after X days) without any response from user
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['clear_ticket_interval']))
                                                value="{{$settings['clear_ticket_interval']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="clear_ticket_interval"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label style="width: 33%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Default Min Order
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['default_min_order']))
                                                value="{{$settings['default_min_order']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="default_min_order"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label style="width: 33%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Default Max Order
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['default_max_order']))
                                                value="{{$settings['default_max_order']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="default_max_order"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label style="width: 33%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Default Price per 1000
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['default_price_per_1000']))
                                                value="{{$settings['default_price_per_1000']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="default_price_per_1000"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <br/>
                        <br/>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            <h4> Drip-feed option </h4>
                        </div>
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="drip_feed_option_status"
                                @if(
                                        isset($settings['drip_feed_option_status'])
                                        && json_decode($settings['drip_feed_option_status']['field_value'])
                                ) checked @endif
                                type="checkbox"
                                id="website-settings-checkbox-active"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="website-settings-checkbox-active" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                            <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                Active
                                            </span>
                            </label>
                        </div>
                        <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                            Note: Please make sure the Drip-feed feature has the 'Active' status in API provider before you activate.
                        </div>
                        <label style="width: 48%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Default Runs
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['drip_feed_default_runs']))
                                                value="{{$settings['drip_feed_default_runs']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="drip_feed_default_runs"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label style="width: 48%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                           Default Interval (in minutes)
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['drip_feed_default_interval']))
                                                value="{{$settings['drip_feed_default_interval']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="drip_feed_default_interval"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <br/>
                        <br/>
                        <div style="width: 50%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Disable Home page (Langding page)
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="disable_home_page"
                                    @if(
                                        isset($settings['disable_home_page'])
                                        && json_decode($settings['disable_home_page']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="disable_home_page"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="disable_home_page" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>
                        <div style="width: 49%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Disable Signup Page
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="disable_signup_page"
                                    @if(
                                        isset($settings['disable_signup_page'])
                                        && json_decode($settings['disable_signup_page']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="disable_signup_page"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="disable_signup_page" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>
                        <div style="width: 50%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Explication of the service symbol
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="explication_of_the_service_symbol"
                                    @if(
                                        isset($settings['explication_of_the_service_symbol'])
                                        && json_decode($settings['explication_of_the_service_symbol']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="explication_of_the_service_symbol"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="explication_of_the_service_symbol" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>
                        <div style="width: 49%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Displays the service lists without login or register
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="displays_the_service_lists_without_login_or_register"
                                    @if(
                                        isset($settings['displays_the_service_lists_without_login_or_register'])
                                        && json_decode($settings['displays_the_service_lists_without_login_or_register']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="displays_the_service_lists_without_login_or_register"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="displays_the_service_lists_without_login_or_register" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>
                        <div style="width: 50%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Displays News & Announcement feature
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="displays_news_announcement_feature"
                                    @if(
                                        isset($settings['displays_news_announcement_feature'])
                                        && json_decode($settings['displays_news_announcement_feature']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="displays_news_announcement_feature"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="displays_news_announcement_feature" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>
                        <div style="width: 49%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Displays API tab in header
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="displays_api_tab_in_header"
                                    @if(
                                        isset($settings['displays_api_tab_in_header'])
                                        && json_decode($settings['displays_api_tab_in_header']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="displays_api_tab_in_header"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="displays_api_tab_in_header" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>
                        <div style="width: 50%; display: inline-flex;">
                            <div class="website-settings__form--note p-2 pb-0 _fs-12">
                                Displays required SkypeID field in signup page
                            </div>
                            <div class="website-settings__form--switch d-flex p-2">
                                <input
                                    name="displays_required_skype_id_field_in_signup_page"
                                    @if(
                                        isset($settings['displays_required_skype_id_field_in_signup_page'])
                                        && json_decode($settings['displays_required_skype_id_field_in_signup_page']['field_value'])
                                    )
                                    checked
                                    @endif
                                    type="checkbox"
                                    id="displays_required_skype_id_field_in_signup_page"
                                    class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                                >
                                <label for="displays_required_skype_id_field_in_signup_page" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            Displays Google reCAPTCHA
                        </div>
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="displays_google_re_captcha"
                                @if(
                                    isset($settings['displays_google_re_captcha'])
                                    && json_decode($settings['displays_google_re_captcha']['field_value'])
                                )
                                checked
                                @endif
                                type="checkbox"
                                id="displays_google_re_captcha"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="displays_google_re_captcha" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                                <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                    Active
                                                </span>
                            </label>
                        </div>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Google reCAPTCHA site key
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['google_re_captcha_site_key']))
                                                value="{{$settings['google_re_captcha_site_key']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="google_re_captcha_site_key"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                        <span class="website-settings__form--placeholder _form-placeholder">
                                            Google reCAPTCHA secret key
                                        </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                            <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                            <input
                                                @if(isset($settings['google_re_captcha_secret_key']))
                                                value="{{$settings['google_re_captcha_secret_key']['field_value']}}"
                                                @endif
                                                type="text"
                                                name="google_re_captcha_secret_key"
                                                placeholder=""
                                                class="website-settings-field website-settings__form--input _form-input"
                                            >
                                        </span>
                        </label>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::CURRENCY_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Currency Setting
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">

                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Currency Code
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['currency_code']))
                                            value="{{$settings['currency_code']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="currency_code"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>

                        <label style="width: 24%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Currency Symbol
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['currency_symbol']))
                                            value="{{$settings['currency_symbol']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="currency_symbol"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 24%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Thousand Separator
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['thousand_separator']))
                                            value="{{$settings['thousand_separator']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="thousand_separator"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 24%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Decimal Separator
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['decimal_separator']))
                                            value="{{$settings['decimal_separator']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="decimal_separator"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 24%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Currency decimal places
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['currency_decimal_places']))
                                            value="{{$settings['currency_decimal_places']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="currency_decimal_places"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Use for sync and Bulk add services
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['use_for_sync_and_bulk_add_services']))
                                            value="{{$settings['use_for_sync_and_bulk_add_services']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="use_for_sync_and_bulk_add_services"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        (Auto rounding to X decimal places)
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['auto_roundin']))
                                            value="{{$settings['auto_roundin']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="auto_roundin"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <br/>
                        <br/>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            <h6> Auto Currency converter </h6>
                        </div>
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="auto_currency_converter_status"
                                @if(
                                        isset($settings['auto_currency_converter_status'])
                                        && json_decode($settings['auto_currency_converter_status']['field_value'])
                                ) checked @endif
                                type="checkbox"
                                id="auto_currency_converter_status"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="auto_currency_converter_status" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                            <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                Active
                                            </span>
                            </label>
                        </div>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Currency Rate (Applying when you fetch, sync all services from SMM providers)
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['currency_rate']))
                                            value="{{$settings['currency_rate']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="currency_rate"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            * If you don't want to change Currency rate then leave this currency rate field to 1
                        </div>


                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::OTHER_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Other settings
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">

                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            <h6> Enable HTTPS </h6>
                        </div>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            Status
                        </div>
                        <div class="website-settings__form--switch d-flex p-2">
                            <input
                                name="enable_https_status"
                                @if(
                                        isset($settings['enable_https_status'])
                                        && json_decode($settings['enable_https_status']['field_value'])
                                ) checked @endif
                                type="checkbox"
                                id="enable_https_status"
                                class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                            >
                            <label for="enable_https_status" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                        <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                            Active
                                        </span>
                            </label>
                        </div>
                        <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                            Note: Please make sure the SSL certificate has the 'Active' status in your hosting before you activate.
                        </div>
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Emded Code
                                    </span>
                            <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                                {{ "Put in the <head> tag of the page. Using for Google Analytics, Facebook pixel code etc" }}
                            </div>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <textarea
                                            name="head_emded_code"
                                            rows="4"
                                            placeholder="Share a reply"
                                            class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                            style="resize: none;"
                                        >@if(isset($settings['head_emded_code'])){{$settings['head_emded_code']['field_value']}}@endif</textarea>
                                    </span>
                            <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                                Note: Only supports Javascript code
                            </div>
                        </label>
                        <label class="website-settings__form--label ps-2 pe-2 pt-3 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Emded Code
                                    </span>
                            <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                                {{ "Be placed immediately before the closing </body> tag of the page. Using for Chat plugin etc" }}
                            </div>
                            <span class="website-settings__form--label-body _form-elem-wrapper _textarea-wrapper">
                                    <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <textarea
                                            name="body_emded_code"
                                            rows="4"
                                            placeholder="Share a reply"
                                            class="website-settings-field website-settings__form--textarea _form-textarea _fs-14 lh-base"
                                            style="resize: none;"
                                        >@if(isset($settings['body_emded_code'])){{$settings['body_emded_code']['field_value']}}@endif</textarea>
                                    </span>
                            <div class="website-settings__form--note p-2 pb-0 _pink _fs-12">
                                Note: Only supports Javascript code
                            </div>
                        </label>
                        <br/>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            <h6> Social Media links </h6>
                        </div>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Facebook
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['facebook_link']))
                                            value="{{$settings['facebook_link']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="facebook_link"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Instagram
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['instagram_link']))
                                            value="{{$settings['instagram_link']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="instagram_link"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Pinterest
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['pinterest_link']))
                                            value="{{$settings['pinterest_link']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="pinterest_link"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Twitter
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['twitter_link']))
                                            value="{{$settings['twitter_link']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="twitter_link"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Tumblr
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['tumblr_link']))
                                            value="{{$settings['tumblr_link']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="tumblr_link"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Youtube
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['youtube_link']))
                                            value="{{$settings['youtube_link']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="youtube_link"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>

                        <br/>
                        <br/>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            <h6> Contact Informations </h6>
                        </div>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Tel
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['tel']))
                                            value="{{$settings['tel']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="tel"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        E-mail
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['email']))
                                            value="{{$settings['email']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="email"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                        <label style="width: 49%; display: inline-flex;" class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Working Hour
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['working_hour']))
                                            value="{{$settings['working_hour']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="working_hour"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>

                        <br/>
                        <br/>
                        <div class="website-settings__form--note p-2 pb-0 _fs-12">
                            <h6> CopyRight </h6>
                        </div>
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                    <span class="website-settings__form--placeholder _form-placeholder">
                                        Content
                                    </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                        <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <input
                                            @if(isset($settings['copy_right_content']))
                                            value="{{$settings['copy_right_content']['field_value']}}"
                                            @endif
                                            type="text"
                                            name="copy_right_content"
                                            placeholder=""
                                            class="website-settings-field website-settings__form--input _form-input"
                                        >
                                    </span>
                        </label>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Pay">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::MAIL_TEMPLATE)
        <div class="order__block mt-3">
            <div class="order__block--body _section-block">
                <form action="#" id="mail-set-form" class="p-5">
                    <div class="add-service-header-block">
                        <div class="add-service-header"><i class="fa fa-edit" style="padding-right: 6px;"></i>Email Template</div>
                    </div>
                    <hr>
                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>Email verification for new customer accounts</div>
                    <div class="input-group mt-2">
                        <label for="subject-new" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control website-settings-field" value="{website_name} - Please validate your account" name="subject-new" id="subject-new">
                    </div>

                    <div class="input-group mt-2">
                        <label for="subject-new-tarea" style="width: 100%">Content</label>
                        <textarea class="website-settings-field" name="subject-new-tarea" id="subject-new-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>New User Welcome Email</div>
                    <div class="input-group mt-2">
                        <label for="subject" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control website-settings-field" value="{website_name} - Getting Started with Our Service!" name="subject-welcome" id="subject-welcome" style="widht: 100%">
                    </div>

                    <div class="input-group mt-2">
                        <label for="subject-welcoming-tarea" style="width: 100%">Content</label>
                        <textarea class="website-settings-field" name="subject-welcoming-tarea" id="subject-welcoming-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>New User Notification Email</div>
                    <div class="input-group mt-2">
                        <label for="notify" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control website-settings-field" value="{website_name} - New Registration" name="notify" id="notify">
                    </div>

                    <div class="input-group mt-2">
                        <label for="notify-tarea" style="width: 100%">Content</label>
                        <textarea class="website-settings-field" name="notify-tarea" id="notify-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>Password Recovery</div>
                    <div class="input-group mt-2">
                        <label for="recovery" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control website-settings-field" value="{website_name} - Password Recovery" name="recovery" id="recovery">
                    </div>

                    <div class="input-group mt-2">
                        <label for="recovery-tarea" style="width: 100%">Content</label>
                        <textarea class="website-settings-field" name="recovery-tarea" id="recovery-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-header-templates py-3"><i class="fa fa-link" style="padding-right: 6px;"></i>Payment Notification Email</div>
                    <div class="input-group mt-2">
                        <label for="payment" style="width: 100%;">Subject</label>
                        <input type="text" class="form-control website-settings-field" value="{website_name} -  Thank You! Deposit Payment Received" name="payment" id="payment">
                    </div>

                    <div class="input-group mt-2">
                        <label for="payment-tarea" style="width: 100%">Content</label>
                        <textarea class="website-settings-field" name="payment-tarea" id="payment-tarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-note mt-2">
                        <strong>Note: </strong>You can use the following template within the message template:
                        <ul>
                            <li style="list-style-type: disc">{user_firstname} - displays the user's first name</li>
                            <li style="list-style-type: disc">{user_lastname} - displays the user's last name</li>
                            <li style="list-style-type: disc">{user_email} - displays the user's email</li>
                            <li style="list-style-type: disc">{user_timezone} - displays the user's timezone</li>
                            <li style="list-style-type: disc">{recovery_password_link} - displays recovery password link</li>
                        </ul>
                    </div>

                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Save">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::MAIL_SETTINGS)
        <div class="order__block mt-3">
            <div class="order__block--body _section-block">
                <form action="#" id="mail-set-form" class="p-5">
                    <div class="add-service-header-block">
                        <div class="add-service-header">Email Setting</div>
                    </div>
                    <hr>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="verify"
                            id="verify"
                            @if(
                                isset($settings['verify'])
                                && json_decode($settings['verify']['field_value'])
                            ) checked @endif
                        >
                        <label for="verify"> Email verification for new customer accounts (Preventing Spam Account)</label>
                    </div>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="welcoming"
                            id="welcoming"
                            @if(
                                isset($settings['welcoming'])
                                && json_decode($settings['welcoming']['field_value'])
                            ) checked @endif
                        >
                        <label for="welcoming"> New User Welcome Email</label>
                    </div>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="notify"
                            id="noitfy"
                            @if(
                                isset($settings['notify'])
                                && json_decode($settings['notify']['field_value'])
                            ) checked @endif
                        >
                        <label for="noitfy"> New User Notification Email <span class="input-smallspan">(Receive notification when a new user registers to the site)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="payment"
                            id="payment"
                            @if(
                               isset($settings['payment'])
                               && json_decode($settings['payment']['field_value'])
                           ) checked @endif
                        >
                        <label for="payment"> Payment notify <span class="input-smallspan">(Send notification when a new user add funds successfully to user balance)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="ticket_reply_to_admin"
                            id="ticket"
                            @if(
                               isset($settings['ticket_reply_to_admin'])
                               && json_decode($settings['ticket_reply_to_admin']['field_value'])
                           ) checked @endif
                        >
                        <label for="ticket"> Ticket Notification Email <span class="input-smallspan">(Send notification to user when Admin reply to a ticket)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="ticket_open_to_admin"
                            id="ticket"
                            @if(
                               isset($settings['ticket_open_to_admin'])
                               && json_decode($settings['ticket_open_to_admin']['field_value'])
                           ) checked @endif
                        >
                        <label for="ticket"> Ticket Notification Email <span class="input-smallspan">(Send notification to Admin when user open a ticket)</span></label>
                    </div>
                    <div class="input-holder mt-1">
                        <input
                            class="website-settings-field"
                            type="checkbox"
                            name="user_place_order"
                            id="ticket"
                            @if(
                               isset($settings['user_place_order'])
                               && json_decode($settings['user_place_order']['field_value'])
                           ) checked @endif
                        >
                        <label for="ticket"> Ticket Notification Email <span class="input-smallspan">(Receive notification when a user place order successfully)</span></label>
                    </div>
                    <div class="input-holder mt-2">
                        <label for="from">From</label>
                        <input
                            type="text"
                            class="form-control
                                    website-settings-field"
                            id="from"
                            name="from"
                            @if(isset($settings['from']))
                            value="{{$settings['from']['field_value']}}"
                            @endif
                        >
                    </div>
                    <div class="input-holder mt-2">
                        <label for="name">Your name</label>
                        <input
                            type="text"
                            class="form-control website-settings-field"
                            id="name"
                            name="name"
                            @if(isset($settings['name']))
                            value="{{$settings['name']['field_value']}}"
                            @endif
                        >
                    </div>
                    <div class="form-check form-switch mt-2">
                        <input
                            class="form-check-input website-settings-field"
                            type="checkbox"
                            id="phpmail"
                            name="phpmail"
                            value="yes"
                            @if(
                               isset($settings['phpmail'])
                               && json_decode($settings['phpmail']['field_value'])
                           ) checked @endif
                        >
                        <label class="form-check-label" for="phpmail">PHP mail function</label>
                    </div>
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input website-settings-field"
                            type="checkbox"
                            id="smtp"
                            name="smtp"
                            value="yes"
                            @if(
                               isset($settings['smtp'])
                               && json_decode($settings['smtp']['field_value'])
                           ) checked @endif
                        >
                        <label class="form-check-label" for="smtp">SMTP <span class="input-smallspan">(Recommended)</span></label>
                    </div>
                    <div class="form-note"><strong>Note:</strong> Sometime, email is going into recepients' spam folders if PHP mail function is enabled.</div>
                    <div class="smtp-adv">
                        <div class="input-group mt-2">
                            <label for="server" style="width: 100%"><b>SMTP Server</b></label>
                            <input type="text" id="server" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="server" style="width: 100%"><b>SMTP Port</b></label>
                                <input type="text" id="server" class="form-control">
                            </div>
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="encryption" style="width: 100%"><b>SMTP Encryption</b></label>
                                <select name="encryption" id="encryption" class="form-select">
                                    <option value="none">None</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="server" style="width: 100%"><b>SMTP Username</b></label>
                                <input type="text" id="server" class="form-control">
                            </div>
                            <div class="input-group mt-2" style="width: 45%">
                                <label for="server" style="width: 100%"><b>SMTP Password</b></label>
                                <input type="text" id="server" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Save">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::SUPPORT_SETTINGS)
        <div class="website-settings__block mt-3">
            <div class="website-settings__block--body _section-block">
                <div class="website-settings__block--header _section-block-header ps-2 ps-sm-4 pe-2 pb-1 pt-1">
                    <h2 class="website-settings__block--title _title ps-2">
                        Support settings
                    </h2>
                </div>
                <form action="#" class="website-settings__block--form website-settings__form">
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Support start time
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <input
                                    @if(isset($settings['support_start_time']))
                                    value="{{$settings['support_start_time']['field_value']}}"
                                    @endif
                                    type="text"
                                    name="support_start_time"
                                    placeholder=""
                                    class="website-settings-field website-settings__form--input _form-input"
                                >
                            </span>
                        </label>
                    </div>
                    <div class="website-settings__form--body p-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                        <label class="website-settings__form--label pt-3 ps-2 pe-2 _form-label">
                                <span class="website-settings__form--placeholder _form-placeholder">
                                    Support end time
                                </span>
                            <span class="website-settings__form--label-body _form-elem-wrapper">
                                <span class="website-settings__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                <input
                                    @if(isset($settings['support_end_time']))
                                    value="{{$settings['support_end_time']['field_value']}}"
                                    @endif
                                    type="text"
                                    name="support_end_time"
                                    placeholder=""
                                    class="website-settings-field website-settings__form--input _form-input"
                                >
                            </span>
                        </label>
                    </div>
                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Save">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::RECAPTCHA_SETTINGS)
        <div class="order__block mt-3">
            <div class="order__block--body _section-block">
                <form action="#" id="mail-set-form" class="p-5">
                    <div class="add-service-header-block">
                        <div class="add-service-header">Сaptcha Setting</div>
                    </div>
                    <hr>
                    <div class="input-holder mt-2">
                        <label for="from">RECAPTCHA SITE KEY</label>
                        <input
                            type="text"
                            class="form-control
                                    website-settings-field"
                            id="from"
                            name="recaptcha_site_key"
                            @if(isset($settings['recaptcha_site_key']))
                            value="{{$settings['recaptcha_site_key']['field_value']}}"
                            @endif
                        >
                    </div>
                    <div class="input-holder mt-2">
                        <label for="name">RECAPTCHA SECRET KEY</label>
                        <input
                            type="text"
                            class="form-control website-settings-field"
                            id="name"
                            name="recaptcha_secret_key"
                            @if(isset($settings['recaptcha_secret_key']))
                            value="{{$settings['recaptcha_secret_key']['field_value']}}"
                            @endif
                        >
                    </div>

                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Save">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::TRANSLATION_SETTINGS)
        <div class="order__block mt-3">
            <div class="order__block--body _section-block">
                <input type="hidden" id="isTranslationSetting" value="true">
                <form action="#" id="mail-set-form" class="p-5">
                    <div class="add-service-header-block">
                        <div class="add-service-header">Translation Setting</div>
                    </div>
                    <hr>
                    <div class="tab">
                        <button type="button" class="tablinks" onclick="openCity(event, 'Login')">Login</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'Service')">Service</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'Policy')">Policy</button>
                    </div>

                    <div id="Login" class="tabcontent">

                        <div class="tab">
                            @foreach($languages as $language)
                                <button
                                    type="button"
                                    class="tablinks"
                                    onclick="openLanguage(event, '{{'Login'.$language->id}}')"
                                >
                                    {{$language->name}}
                                </button>
                            @endforeach
                        </div>

                        @foreach($languages as $language)

                            <div id="Login{{$language->id}}" class="tabcontentLanguage">
                                <h3>Login page translation</h3>
                                <hr>
                                <center><h5>Title</h5></center>
                                <hr>
                                <div class="input-holder mt-2">
                                    <label for="from">Name</label>

                                    <input
                                        type="text"
                                        class="form-control website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="title_name"
                                        @if(isset($translations[$language->id]['title_name']))
                                            value="{{$translations[$language->id]['title_name']->context}}"
                                        @elseif(isset($settings['title_name']))
                                            value="{{$settings['title_name']['field_value']}}"
                                        @endif
                                    >
                                </div>

                                <br/>
                                <center><h5>Why choose us?</h5></center>
                                <hr>
                                <div class="input-holder mt-2">
                                    <label for="from">Title</label>

                                    <input
                                        type="text"
                                        class="form-control  website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_title"
                                        @if(isset($translations[$language->id]['choose_title']))
                                            value="{{$translations[$language->id]['choose_title']->context}}"
                                        @elseif(isset($settings['choose_title']))
                                            value="{{$settings['choose_title']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">First block name</label>

                                    <input
                                        type="text"
                                        class="form-control website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_first_block_name"
                                        @if(isset($translations[$language->id]['choose_first_block_name']))
                                            value="{{$translations[$language->id]['choose_first_block_name']->context}}"
                                        @elseif(isset($settings['choose_first_block_name']))
                                            value="{{$settings['choose_first_block_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">First block text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_first_block_text"
                                        @if(isset($translations[$language->id]['choose_first_block_text']))
                                            value="{{$translations[$language->id]['choose_first_block_text']->context}}"
                                        @elseif(isset($settings['choose_first_block_text']))
                                            value="{{$settings['choose_first_block_text']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Second block name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_second_block_name"
                                        @if(isset($translations[$language->id]['choose_second_block_name']))
                                            value="{{$translations[$language->id]['choose_second_block_name']->context}}"
                                        @elseif(isset($settings['choose_second_block_name']))
                                            value="{{$settings['choose_second_block_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Second block text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_second_block_text"
                                        @if(isset($translations[$language->id]['choose_second_block_text']))
                                            value="{{$translations[$language->id]['choose_second_block_text']->context}}"
                                        @elseif(isset($settings['choose_second_block_text']))
                                            value="{{$settings['choose_second_block_text']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Third block name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_third_block_name"
                                        @if(isset($translations[$language->id]['choose_third_block_name']))
                                            value="{{$translations[$language->id]['choose_third_block_name']->context}}"
                                        @elseif(isset($settings['choose_third_block_name']))
                                            value="{{$settings['choose_third_block_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Third block text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="choose_third_block_text"
                                        @if(isset($translations[$language->id]['choose_third_block_text']))
                                            value="{{$translations[$language->id]['choose_third_block_text']->context}}"
                                        @elseif(isset($settings['choose_third_block_text']))
                                            value="{{$settings['choose_third_block_text']['field_value']}}"
                                        @endif
                                    >
                                </div>

                                <br/>
                                <center><h5>How it works?</h5></center>
                                <hr>
                                <div class="input-holder mt-2">
                                    <label for="from">Name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_name"
                                        @if(isset($translations[$language->id]['how_works_name']))
                                            value="{{$translations[$language->id]['how_works_name']->context}}"
                                        @elseif(isset($settings['how_works_name']))
                                            value="{{$settings['how_works_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">First step name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_first_step_name"
                                        @if(isset($translations[$language->id]['how_works_first_step_name']))
                                            value="{{$translations[$language->id]['how_works_first_step_name']->context}}"
                                        @elseif(isset($settings['how_works_first_step_name']))
                                            value="{{$settings['how_works_first_step_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">First step text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_first_step_text"
                                        @if(isset($translations[$language->id]['how_works_first_step_text']))
                                            value="{{$translations[$language->id]['how_works_first_step_text']->context}}"
                                        @elseif(isset($settings['how_works_first_step_text']))
                                            value="{{$settings['how_works_first_step_text']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Second step name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_second_step_name"
                                        @if(isset($translations[$language->id]['how_works_second_step_name']))
                                            value="{{$translations[$language->id]['how_works_second_step_name']->context}}"
                                        @elseif(isset($settings['how_works_second_step_name']))
                                            value="{{$settings['how_works_second_step_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Second step text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_second_step_text"
                                        @if(isset($translations[$language->id]['how_works_second_step_text']))
                                            value="{{$translations[$language->id]['how_works_second_step_text']->context}}"
                                        @elseif(isset($settings['how_works_second_step_text']))
                                            value="{{$settings['how_works_second_step_text']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Third step name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_third_step_name"
                                        @if(isset($translations[$language->id]['how_works_third_step_name']))
                                            value="{{$translations[$language->id]['how_works_third_step_name']->context}}"
                                        @elseif(isset($settings['how_works_third_step_name']))
                                            value="{{$settings['how_works_third_step_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Third step text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_third_step_text"
                                        @if(isset($translations[$language->id]['how_works_third_step_text']))
                                            value="{{$translations[$language->id]['how_works_third_step_text']->context}}"
                                        @elseif(isset($settings['how_works_third_step_text']))
                                            value="{{$settings['how_works_third_step_text']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Fourth step name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_fourth_step_name"
                                        @if(isset($translations[$language->id]['how_works_fourth_step_name']))
                                            value="{{$translations[$language->id]['how_works_fourth_step_name']->context}}"
                                        @elseif(isset($settings['how_works_fourth_step_name']))
                                            value="{{$settings['how_works_fourth_step_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Fourth step text</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_fourth_step_text"
                                        @if(isset($translations[$language->id]['how_works_fourth_step_text']))
                                            value="{{$translations[$language->id]['how_works_fourth_step_text']->context}}"
                                        @elseif(isset($settings['how_works_fourth_step_text']))
                                            value="{{$settings['how_works_fourth_step_text']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Our offer name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_our_offer_name"
                                        @if(isset($translations[$language->id]['how_works_our_offer_name']))
                                            value="{{$translations[$language->id]['how_works_our_offer_name']->context}}"
                                        @elseif(isset($settings['how_works_our_offer_name']))
                                            value="{{$settings['how_works_our_offer_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Our offer desc</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="how_works_our_offer_desc"
                                        @if(isset($translations[$language->id]['how_works_our_offer_desc']))
                                            value="{{$translations[$language->id]['how_works_our_offer_desc']->context}}"
                                        @elseif(isset($settings['how_works_our_offer_desc']))
                                            value="{{$settings['how_works_our_offer_desc']['field_value']}}"
                                        @endif
                                    >
                                </div>

                                <br/>
                                <center><h5>Reviews</h5></center>
                                <hr>
                                <div class="input-holder mt-2">
                                    <label for="from">Name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="reviews_name"
                                        @if(isset($translations[$language->id]['reviews_name']))
                                            value="{{$translations[$language->id]['reviews_name']->context}}"
                                        @elseif(isset($settings['reviews_name']))
                                            value="{{$settings['reviews_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Description</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="reviews_desc"
                                        @if(isset($translations[$language->id]['reviews_desc']))
                                            value="{{$translations[$language->id]['reviews_desc']->context}}"
                                        @elseif(isset($settings['reviews_desc']))
                                            value="{{$settings['reviews_desc']['field_value']}}"
                                        @endif
                                    >
                                </div>

                                <br/>
                                <center><h5>FAQ</h5></center>
                                <hr>
                                <div class="input-holder mt-2">
                                    <label for="from">Name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="faq_name"
                                        @if(isset($translations[$language->id]['faq_name']))
                                            value="{{$translations[$language->id]['faq_name']->context}}"
                                        @elseif(isset($settings['faq_name']))
                                            value="{{$settings['faq_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Description</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="faq_desc"
                                        @if(isset($translations[$language->id]['faq_desc']))
                                            value="{{$translations[$language->id]['faq_desc']->context}}"
                                        @elseif(isset($settings['faq_desc']))
                                            value="{{$settings['faq_desc']['field_value']}}"
                                        @endif
                                    >
                                </div>

                                <br/>
                                <center><h5>Newsletter</h5></center>
                                <hr>
                                <div class="input-holder mt-2">
                                    <label for="from">Name</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="newsletter_name"
                                        @if(isset($translations[$language->id]['newsletter_name']))
                                            value="{{$translations[$language->id]['newsletter_name']->context}}"
                                        @elseif(isset($settings['newsletter_name']))
                                            value="{{$settings['newsletter_name']['field_value']}}"
                                        @endif
                                    >
                                </div>
                                <div class="input-holder mt-2">
                                    <label for="from">Description</label>

                                    <input
                                        type="text"
                                        class="form-control
                                    website-settings-field"
                                        id="from"
                                        data-language="{{$language->name}}"
                                        data-language-id="{{$language->id}}"
                                        name="newsletter_desc"
                                        @if(isset($translations[$language->id]['newsletter_desc']))
                                            value="{{$translations[$language->id]['newsletter_desc']->context}}"
                                        @elseif(isset($settings['newsletter_desc']))
                                            value="{{$settings['newsletter_desc']['field_value']}}"
                                        @endif
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div id="Service" class="tabcontent">
                        <h3>Service page translation</h3>

                    </div>

                    <div id="Policy" class="tabcontent">
                        <h3>Policy page translation</h3>
                        <hr>
                        <div class="input-holder mt-2">
                            <label for="from">Title</label>

                            <input
                                type="text"
                                class="form-control
                                    website-settings-field"
                                id="from"
                                name="service_title_name"
                                @if(isset($settings['service_title_name']))
                                value="{{$settings['service_title_name']['field_value']}}"
                                @endif
                            >
                        </div>
                        <div class="input-holder mt-2">
                            <label for="from">Terms name</label>

                            <input
                                type="text"
                                class="form-control
                                    website-settings-field"
                                id="from"
                                name="service_terms_name"
                                @if(isset($settings['service_terms_name']))
                                value="{{$settings['service_terms_name']['field_value']}}"
                                @endif
                            >
                        </div>

                        <div class="input-holder mt-2">
                            <label for="from">Privacy policy name</label>

                            <input
                                type="text"
                                class="form-control
                                    website-settings-field"
                                id="from"
                                name="service_privacy_policy_name"
                                @if(isset($settings['service_privacy_policy_name']))
                                value="{{$settings['service_privacy_policy_name']['field_value']}}"
                                @endif
                            >
                        </div>
                    </div>


                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Save">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
        @case(\App\Models\Settings::PAYPAL_SETTINGS)
        <div class="order__block mt-3">
            <div class="order__block--body _section-block">
                <form action="#" id="mail-set-form" class="p-5">
                    <div class="add-service-header-block">
                        <div class="add-service-header">Paypal Setting</div>
                    </div>
                    <hr>
                    <div class="website-settings__form--switch d-flex p-2">
                        <input
                            name="paypal_limit_active"
                            @if(isset($settings['paypal_limit_active']) && json_decode($settings['paypal_limit_active']['field_value'])) checked @endif
                            type="checkbox"
                            id="paypal_limit_active"
                            class="website-settings-field website-settings__form--switch-input _hidden-checkbox _form-switch-checkbox"
                        >
                        <label for="paypal_limit_active" class="website-settings__form--label _form-label-switch-checkbox d-flex align-items-center">
                                    <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                        Active
                                    </span>
                        </label>
                    </div>
                    <div class="input-holder mt-2">
                        <label for="from">Paypal day limit factor</label>
                        <input
                            type="text"
                            class="form-control
                                    website-settings-field"
                            id="from"
                            name="paypal_day_limit_factor"
                            @if(isset($settings['paypal_day_limit_factor']))
                            value="{{$settings['paypal_day_limit_factor']['field_value']}}"
                            @endif
                        >
                    </div>
                    <div class="input-holder mt-2">
                        <label for="name">Paypal transaction limit factor</label>
                        <input
                            type="text"
                            class="form-control website-settings-field"
                            id="name"
                            name="paypal_transaction_limit_factor"
                            @if(isset($settings['paypal_transaction_limit_factor']))
                            value="{{$settings['paypal_transaction_limit_factor']['field_value']}}"
                            @endif
                        >
                    </div>

                    <div class="input-holder mt-2">
                        <label for="name">Paypal minimal client amount sum</label>
                        <input
                            type="text"
                            class="form-control website-settings-field"
                            id="name"
                            name="paypal_minimal_client_amount_sum"
                            @if(isset($settings['paypal_minimal_client_amount_sum']))
                            value="{{$settings['paypal_minimal_client_amount_sum']['field_value']}}"
                            @endif
                        >
                    </div>

                    <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                        <input type="button" class="_btn _large-btn me-2" onclick="addSettings()" value="Save">
                        {{--                        <button class="_btn _large-btn me-2" onclick="addSettings()">--}}
                        {{--                            Pay--}}
                        {{--                        </button>--}}
                    </div>
                </form>
            </div>
        </div>
        @break
    @endswitch
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function openLanguage(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontentLanguage");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function addSettings()
        {
            $('#settingErrors').html('');

            if ($('#isTranslationSetting').val() == 'true') {

                $.ajax({
                    type: "DELETE",
                    url: "{{route('admin.translation.delete', ['language' => Config::get('language.current')])}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        entity_type: "App\\Models\\Settings"
                    }
                }).done(function (data) {

                }).fail(function (data) {

                });
            }

            $('.website-settings-field').each(function () {

                var fd = new FormData;

                fd.append('page_name', '{{$page}}');
                fd.append('field_name', $(this).attr("name"));
                fd.append('field_value', $(this).val());

                if ($('#isTranslationSetting').val() == 'true') {

                    if ($(this).attr("data-language") !== 'undefined') {
                        fd.append('language_name', $(this).attr("data-language"));
                    }

                    if ($(this).attr("data-language-id") !== 'undefined') {
                        fd.append('language_id', $(this).attr("data-language-id"));
                    }
                }

                if ($(this).prop('files') !== null && $(this).prop('files') !== undefined) {
                    fd.append('field_value', $(this).prop('files')[0]);
                }

                if (tinymce.get($(this).attr("id")) !== null) {
                    fd.append('field_value', tinymce.get($(this).attr("id")).getContent());
                }

                if ($(this).attr('type') === 'checkbox') {
                    fd.append('field_value', $(this).is(':checked'));
                }

                fd.append('_token', "{{csrf_token()}}");

                $.ajax({
                    type: "POST",
                    url: "{{route('admin.setting.store', ['language' => Config::get('language.current')])}}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                }).done(function(data) {

                }).fail(function( data ) {

                    var errors = '';
                    $.each(data.responseJSON.errors, function (id, message) {
                        errors += '<div class="error" style="color: firebrick">'+message[0]+'</div>'
                    });

                    $('#settingErrors').html(errors);
                });
            })
        }

        tinymce.init({
            selector:'#subject-new-tarea',
            width:'100%',
            height: 400,
            autoresize_min_height: 400,
            autoresize_max_height: 800,
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent(`
                    <p><b>Welcome to {website_name}!</b></p>
                    <p>Hello <b>{user_firstname}!</b></p>
                    <p>Thank you for joining! We're glad to have you as community member, and we're stocked for you to start exploring our service. If you don't verify your address, you won't be able to create a User Account.</p>
                    <p>All you need to do is activate your account by click this link: {activation_link}</p>
                    <p>Thanks and Best Regards!</p>
                `);
                });
            }});

        tinymce.init({
            selector:'#subject-welcoming-tarea',
            width:'100%',
            height: 400,
            autoresize_min_height: 400,
            autoresize_max_height: 800,
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent(`
                    <p><b>Welcome to {website_name}!</b></p>
                    <p>Hello <b>{user_firstname}!</b></p>
                    <p>Congratulations! You have successfully signed up for our service - {website_name} with follow data</p>
                    <ul>
                        <li style="list-style-type: disc">Firstname: {user_firstname}</li>
                        <li style="list-style-type: disc">Lastname: {user_lastname}</li>
                        <li style="list-style-type: disc">Email: {user_email}</li>
                        <li style="list-style-type: disc">Timezone: {user_timezone}</li>

                    </ul>
                    <p>We want to exceed your expectations, so please do not hesitate to reach out at any time if you have any questions or concerns. We look to working with you.</p>
                    <p>Best Regards,</p>
                `);
                });
            }});

        tinymce.init({
            selector:'#notify-tarea',
            width:'100%',
            height: 400,
            autoresize_min_height: 400,
            autoresize_max_height: 800,
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent(`
                    <p>Hi Admin!</p>
                    <p>Someone signed up in <b>{website_name}</b> with follow data</p>
                    <ul>
                        <li style="list-style-type: disc">Firstname: {user_firstname}</li>
                        <li style="list-style-type: disc">Lastname: {user_lastname}</li>
                        <li style="list-style-type: disc">Email: {user_email}</li>
                        <li style="list-style-type: disc">Timezone: {user_timezone}</li>
                `);
                });
            }});

        tinymce.init({
            selector:'#recovery-tarea',
            width:'100%',
            height: 400,
            autoresize_min_height: 400,
            autoresize_max_height: 800,
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent(`
                    <p>Hi <b>{user_firstname}!</b></p>
                    <p>Somebody (hopefully you) requested a new password for your account.</p>
                    <p>No changes have been made to your account yet. You can reset your password by click this link: {recovery_password_link}</p>
                    <p>If you did not request a password reset, no further action is required.</p>
                    <p>Thanks and Best Regards!</p>
                `);
                });
            }});

        tinymce.init({
            selector:'#payment-tarea',
            width:'100%',
            height: 400,
            autoresize_min_height: 400,
            autoresize_max_height: 800,
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent(`
                    <p>Hi <b>{user_firstname}!</b></p>
                    <p>We've just received your final remittance and would like to thank you. We appreciate your diligence in adding funds to your balance in our service.</p>
                    <p>It has been a pleasure doing business with you. We wish you the best of luck.</p>
                    <p>Thanks and Best Regards!</p>
                `);
                });
            }});

        let inputClosers = document.querySelectorAll(".website-settings__form--icon");
        let inputClearBtns = document.querySelectorAll("._clear-input-btn");

        for(let i = 0; i < inputClearBtns.length; i++) {
            inputClearBtns[i].addEventListener("click", (e) => {
                let target = e.target,
                    parent = target.parentElement,
                    children = parent.children;

                for(let j = 0; j < children.length; j++) {
                    if(children[j].classList.contains("_form-input")) {
                        children[j].setAttribute("value", "")

                    }
                }
            })
        }

    </script>
@stop
