<div class="grey"></div>
<aside class="aside">
    <div class="aside__body  pt-lg-5 pb-lg-5  ps-lg-0 pe-lg-0 ps-3 pe-3">
        <a href="{{route('user.dashboard', ['language' => Config::get('language.current')])}}" class="aside__logo mb-lg-5 pt-2 pb-2">
            <img src="{{asset('admin/img/logo.png')}}" width="200" height="40" alt="" class="aside__logo--img">
        </a>
        <button class="aside__logo--burger _burger">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="aside__nav pb-lg-0 pb-5">
            <ul class="aside__nav--list">
                <li class="aside__nav--item">
                    <a
                        @if(!\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            href="{{route('user.dashboard', ['language' => Config::get('language.current')])}}"
                        @else
                            href="{{route('admin.dashboard', ['language' => Config::get('language.current')])}}"
                        @endif
                       class="aside__nav--link aside__link {{in_array(Route::currentRouteName(), ['user.dashboard', 'admin.dashboard']) ? '_current-page' : ''}}"
                    >
                        <span class="aside__link--icon _icon-statistics"></span>
                        {{ __('locale.nav_bar.statistics') }}
                    </a>
                </li>
                <li class="aside__nav--item">
                    <a
                        href="{{route('user.order.new', ['language' => Config::get('language.current')])}}"
                        class="aside__nav--link aside__link {{Route::currentRouteName() == 'user.order.new' ? '_current-page' : ''}}"
                    >
                        <span class="aside__link--icon _icon-new-order"></span>
                        {{ __('locale.nav_bar.new_order') }}
                    </a>
                </li>
                <li class="aside__nav--item _aside-sub-parent">
                    <button class="aside__nav--link aside__link _aside-sub-open">
                        <span class="aside__link--icon _icon-orders"></span>
                        {{ __('locale.nav_bar.order') }}
                    </button>
                    <ul class="aside__nav--sub-list _aside-sub-list">
                        <li class="aside__nav--sub-item _aside-sub-parent">
                            <a
                                href="{{route('user.order.all', ['language' => Config::get('language.current')])}}"
                               class="aside__nav--sub-link {{Route::currentRouteName() == 'user.order.all' ? '_current-page' : ''}}"
                            >
                                {{ __('locale.nav_bar.order_logs') }}
                            </a>
                        </li>
                        <li class="aside__nav--sub-item _aside-sub-parent">
                            <a
                                href="{{route('admin.order.drip-feed', ['language' => Config::get('language.current')])}}"
                                class="aside__nav--sub-link">
                                {{ __('locale.nav_bar.drip_feed') }}
                            </a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <li class="aside__nav--sub-item _aside-sub-parent">
                                <a
                                    href="{{route('admin.subscription.all', ['language' => Config::get('language.current')])}}"
                                    class="aside__nav--sub-link">
                                    {{ __('locale.nav_bar.subscriptions') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="aside__nav--item">
                    <a
                        @if(!\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            href="{{route('user.service.all', ['language' => Config::get('language.current')])}}"
                        @else
                            href="{{route('admin.service.all', ['language' => Config::get('language.current')])}}"
                        @endif
                        class="aside__nav--link aside__link {{in_array(Route::currentRouteName(), ['user.service.all', 'admin.service.all']) ? '_current-page' : ''}}"
                    >
                        <span class="aside__link--icon _icon-services"></span>
                        {{ __('locale.nav_bar.services') }}
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <li class="aside__nav--item">
                        <a
                            href="{{route('admin.category.list', ['language' => Config::get('language.current')])}}"
                            class="aside__nav--link aside__link {{in_array(Route::currentRouteName(), ['admin.category.list']) ? '_current-page' : ''}}"
                        >
                            <span class="aside__link--icon _icon-services"></span>
                            {{ __('locale.nav_bar.category') }}
                        </a>
                    </li>
                @endif
                <li class="aside__nav--item">
                    <a
                        href="{{route('user.api-doc.list', ['language' => Config::get('language.current')])}}"
                        class="aside__nav--link aside__link {{Route::currentRouteName() == 'user.api-doc.list' ? '_current-page' : ''}}"
                    >
                        <span class="aside__link--icon _icon-share"></span>
                        {{ __('locale.nav_bar.api') }}
                    </a>
                </li>
                <li class="aside__nav--item _aside-sub-parent">
                    <button class="aside__nav--link aside__link _aside-sub-open {{in_array(Route::currentRouteName(), ['user.ticket.list', 'user.faq.all'])  ? '_current-page' : ''}}">
                        <span class="aside__link--icon _icon-message"></span>
                        @if(!\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            {{ __('locale.nav_bar.support') }}
                        @else
                            {{ __('locale.nav_bar.tickets') }}
                        @endif
                        <span class="aside__link--count">{{$count}}</span>
                    </button>
                    <ul class="aside__nav--sub-list _aside-sub-list">
                        <li class="aside__nav--sub-item">
                            <a
                                href="{{route('user.ticket.list', ['language' => Config::get('language.current')])}}"
                                class="aside__nav--sub-link {{Route::currentRouteName() == 'user.ticket.list' ? '_current-page' : ''}}"
                            >
                                {{ __('locale.nav_bar.tickets') }}
                                <span class="aside__link--count">{{$count}}</span>
                            </a>
                        </li>
                        <li class="aside__nav--sub-item">
                            <a
                                href="{{route('user.faq.all', ['language' => Config::get('language.current')])}}"
                                class="aside__nav--sub-link {{Route::currentRouteName() == 'user.faq.all' ? '_current-page' : ''}}"
                            >
                                {{ __('locale.nav_bar.faqs') }}
                            </a>
                        </li>
                    </ul>
                </li>
                @if(!\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <li class="aside__nav--item">
                    <a
                        href="{{route('user.transaction.create', ['language' => Config::get('language.current')])}}"
                        class="aside__nav--link aside__link {{Route::currentRouteName() == 'user.transaction.create' ? '_current-page' : ''}}"
                    >
                        <span class="aside__link--icon _icon-add-funds"></span>
                        {{ __('locale.nav_bar.add_funds') }}
                    </a>
                </li>
                @endif
                <li class="aside__nav--item">
                    <a
                        href="{{route('user.transaction.list', ['language' => Config::get('language.current')])}}"
                        class="aside__nav--link aside__link {{Route::currentRouteName() == 'user.transaction.list' ? '_current-page' : ''}}"
                    >
                        <span class="aside__link--icon _icon-transaction"></span>
                        {{ __('locale.nav_bar.transaction_log') }}
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <li class="aside__nav--item">
                        <a
                            href="{{route('admin.user.all', ['language' => Config::get('language.current')])}}"
                            class="aside__nav--link aside__link {{Route::currentRouteName() == 'admin.user.all' ? '_current-page' : ''}}"
                        >
                            <span class="aside__link--icon _icon-user"></span>
                            {{ __('locale.nav_bar.user_manager') }}
                        </a>
                    </li>
                    <li class="aside__nav--item _aside-sub-parent">
                        <button class="aside__nav--link aside__link _aside-sub-open {{Route::currentRouteName() == 'admin.setting.index' ? '_current-page' : ''}}">
                            <span class="aside__link--icon _icon-settings"></span>
                            {{ __('locale.nav_bar.system_settings') }}
                        </button>
                        <ul class="aside__nav--sub-list _aside-sub-list">
                            <li class="aside__nav--sub-item _aside-sub-parent">
                                <button class="aside__nav--sub-link aside__link _aside-sub-open">
                                    <span class="aside__sub--icon _icon-general-settings"></span>
                                    {{ __('locale.nav_bar.general_setting') }}
                                </button>
                                <ul class="aside__nav--sub-list _aside-sub-list _min">
                                    <li class="aside__nav--sub-item">
                                        <form class="aside__status d-flex align-items-center">
                                            <input type="checkbox" id="aside-status-checkbox" class="aside__status--switch-input _hidden-checkbox _form-switch-checkbox _min">
                                            <label for="aside-status-checkbox" class="aside__status--label _form-label-switch-checkbox aside__nav--sub-link _min d-flex align-items-center">
                                                    <span class="ms-4 ps-3 _form-placeholder-switch-checkbox _fs-12 _dark-gray fw-semibold">
                                                        {{ __('locale.nav_bar.support_status') }}
                                                    </span>
                                            </label>
                                        </form>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::GENERAL_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.website_setting') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::SUPPORT_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            Support setting
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::TRANSLATION_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.translation_setting') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.language.all', ['language' => Config::get('language.current')])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.languages') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::LOGO_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.website_logo') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::COOKIE_POLICY_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.cookie_policy') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::TERMS_POLICY_PAGE_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.terms_policy_page') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::DEFAULT_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.default_setting') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::CURRENCY_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.currency_setting') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="#"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.currencies_list') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::RECAPTCHA_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.captcha_setting') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::OTHER_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.other') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="aside__nav--sub-item _aside-sub-parent">
                                <button class="aside__nav--sub-link aside__link _aside-sub-open">
                                    <span class="aside__sub--icon _icon-mail"></span>
                                    {{ __('locale.nav_bar.email') }}
                                </button>
                                <ul class="aside__nav--sub-list _aside-sub-list _min">
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::MAIL_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.email_settings') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::MAIL_TEMPLATE
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.email_template') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="aside__nav--sub-item _aside-sub-parent">
                                <button class="aside__nav--sub-link aside__link _aside-sub-open">
                                    <span class="aside__sub--icon _icon-settings"></span>
                                    {{ __('locale.nav_bar.integrations') }}
                                </button>
                                <ul class="aside__nav--sub-list _aside-sub-list _min">
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.payment.list', [
                                                        'language' => Config::get('language.current')
                                                   ])}}"
                                            class="aside__nav--sub-link _min {{Route::currentRouteName() == 'admin.payment.list' ? '_current-page' : ''}}"
                                        >
                                            {{ __('locale.nav_bar.payment') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.payment.payment-bonus.list', [
                                                        'language' => Config::get('language.current')
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            {{ __('locale.nav_bar.payment_bonuses') }}
                                        </a>
                                    </li>
                                    <li class="aside__nav--sub-item">
                                        <a
                                            href="{{route('admin.setting.index', [
                                                        'language' => Config::get('language.current'),
                                                        'page_name' => \App\Models\Settings::PAYPAL_SETTINGS
                                                   ])}}"
                                            class="aside__nav--sub-link _min"
                                        >
                                            Paypal Settings
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <div class="aside__nav--settings aside__settings"></div>
            <div class="aside__nav--user aside__user ps-3 pe-3 pt-5 mt-5 pb-5">
                <div class="aside__user--body row">
                    <div class="aside__user--avatar col-3">
                        <img src="{{(!$user->image_file || $user->image_file == '') ? asset('admin/img/user/avatar.png') : $user->image_file}}"
                             id="navbar_avatar"
                             width="32"
                             height="32"
                             alt="user avatar"
                             class="aside__user--img"
                        >
                    </div>
                    <input type="hidden" id="routeImg" value="{{$user->image_file}}" data-token="{{csrf_token()}}">
                    <div class="aside__user--info col-9 d-flex flex-column">
                      <button class="aside__edit" onclick="window.location.href='{{route('user.profile', ['language' => Config::get('language.current')])}}'">Edit</button>
                        <span class="aside__user--name">
                            {{ __('locale.nav_bar.hi') }}, {{mb_substr($user->first_name, 0, 100)}}
                        </span>
                        <span class="aside__user--balance">
                            {{ __('locale.nav_bar.balance') }}: ${{$user->balance}}
                        </span>

                        <a href="{{ route('auth.logout',['language' => Config::get('app.locale')]) }}" class="aside__user--log-out _link mt-2">
                            {{ __('locale.nav_bar.log_out') }}
                        </a>
                    </div>
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <div class="aside__nav--maintenance">
                    <button
                        class="maintenance-toggler {{($mainTenance && (bool)$mainTenance->field_value) ? 'active' : ''}}"
                    ></button>
                    <span class="maintenance-label">
                        {{ __('locale.nav_bar.maintenance_mode') }}
                    </span>
                </div>
            @endif

        </nav>
    </div>
</aside>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<script>
    $("#aside-status-checkbox").change(function () {

    });
     $("#navbar_avatar")
         .on('load', function() {  })
         .on('error', function() { $("#navbar_avatar").attr("src","{{asset('admin/img/user/avatar.png')}}"); })
     ;

    function changeMaintenanceMode()
    {
        $.ajax({
            type: "POST",
            url: "{{route('admin.main-tenance', ['language' => Config::get('language.current')])}}",
            data: {
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {

        });
    }

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

    const maintenanceBtn = document.querySelector(".aside__nav--maintenance");
    maintenanceBtn.addEventListener("click", () => {
        const modalMaintenance = document.createElement("div"),
        body = document.querySelector("body");
        modalMaintenance.classList.add("maintenance-popup");
        modalMaintenance.innerHTML = `
            <div class="maintenance-popup-header">Do you really want to switch to <span style="color: red; font-weight: 600">maintenance</span> mode?</div>
            <div class="maintenance-popup-paragraph">The access to all pages form client side will be restricted.</div>
            <div class="maintenance-popup-btns">
                <button class="btn btn-danger">Switch anyway</button>
                <button class="btn btn-info">Go back</button>
            </div>
        `;
        body.append(modalMaintenance);
        putOverlay();
        $(modalMaintenance).fadeIn();

        $(".btn-danger").on("click", () => {
            changeMaintenanceMode()
        });
        $(".btn-info").on("click", () => {
            $(modalMaintenance).fadeOut();
            modalMaintenance.remove();
            $("madeup-overlay").fadeOut();
            document.querySelector(".madeup-overlay").remove();
            $("body", "html").css({"overflow": "auto", "height": "auto"})
        })
    });

    function loadAvatar() {
        const imageRoute = document.getElementById("routeImg");

        $.ajax({
            type: "GET",
            url: imageRoute,
            dataType:"image/png",
            success: function (data) {
                $('#navbar_avatar').attr('src', data);
            }
        });
    }
    loadAvatar();
</script>
