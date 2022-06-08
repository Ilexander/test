<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="statistics__header section-header _section-elem">
    <ul class="section-header__list pb-lg-0 pt-lg-0 pb-3 pt-3">
        <li class="section-header__list--item">
            <a
                href="{{route('user.order.new', ['language' => Config::get('language.current')])}}"
                class="section-header__list--link {{Route::currentRouteName() == 'user.order.new' ? '_accent' : ''}}"
            >
                <span class="section-header__list--icon _icon-section-new-order"></span>
                {{ __('locale.header.order.new') }}
            </a>
        </li>
        <li class="section-header__list--item">
            <a
                href="{{route('user.order.all', ['language' => Config::get('language.current')])}}"
                class="section-header__list--link {{in_array(Route::currentRouteName(), ['user.order.all'])  ? '_accent' : ''}}"
            >
                <span class="section-header__list--icon _icon-orders"></span>
                {{ __('locale.header.order.all') }}
            </a>
        </li>
    </ul>
    <div class="section-header__settings">
        <x-language-selector/>
        <div class="section-header__settings--block d-flex">
            <div class="section-header__theme ps-3 pe-3 ps-md-1 pe-md-1 _append-item" data-append-to=".aside__settings">
                <a href="#" class="section-header__theme--link _theme-link _light-theme section-header__min-link" title="Change theme">
                    <span class="section-header__theme--icon section-header__min-icon _icon-theme-to-dark"></span>
                    <script>
                        if(localStorage.getItem('theme') == 'dark') {
                            let themeLink = document.querySelector('._theme-link');
                            themeLink.classList.remove('_light-theme');
                            themeLink.classList.add('_dark-theme');

                            let themeIcon = themeLink.querySelector('._icon-theme-to-dark');
                            themeIcon.classList.remove('_icon-theme-to-dark');
                            themeIcon.classList.add('_icon-theme-to-light');
                        }
                    </script>
                </a>
            </div>
            <div class="section-header__message ps-3 pe-3 ps-md-2 pe-md-2 _append-item" data-append-to=".aside__settings">
                <a
                    href="{{route('user.ticket.list', ['language' => Config::get('language.current')])}}"
                    class="section-header__message--link section-header__min-link @if($count > 0) _has-effect @endif"
                    title="Messages"
                >
                    <span class="section-header__message--icon section-header__min-icon _icon-message"></span>
                </a>
            </div>
        </div>
        <div class="section-header__user ms-1 ms-md-4">
            <div class="section-header__user--info">
                <a href="{{route('user.profile', ['language' => Config::get('language.current')])}}" class="section-header__user--name _link">
                    {{ __('locale.header.hi') }}, {{mb_substr($user->first_name, 0, 100)}}
                </a>
                <span class="section-header__user--balance">
                    <a href="{{route('user.transaction.create', ['language' => Config::get('language.current')])}}" class="section-header__user--name _link">
                        {{ __('locale.header.balance') }}: ${{$user->balance}}
                    </a>
                </span>

                @if(Session::get('asUserLogin'))
                    <a
                        href="{{route('user.impersonate', [
                                    'language' => Config::get('language.current'),
                                    'id' => 1
                                    ])}}"
                        class="section-header__user--name _link"
                    >
                        Back to admin
                    </a>
                @endif


            </div>
            <a href="#" class="section-header__user--avatar ms-1 ms-md-4">
                <a href="{{route('user.profile', ['language' => Config::get('language.current')])}}" class="section-header__user--name _link">
                    <img src="{{$user->image_file}}" width="32" height="32" id="header_avatar" alt="" class="section-header__user--img">
                </a>
            </a>
        </div>
    </div>
</div>

<script>
    $("#header_avatar")
        .on('load', function() {  })
        .on('error', function() { $("#header_avatar").attr("src","{{asset('admin/img/user/avatar.png')}}"); })
    ;
</script>
