<a
    href="{{route('user.ticket.list', ['language' => Config::get('language.current')])}}"
    class="section-header__message--link section-header__min-link @if($count > 0) _has-effect @endif"
    title="Messages"
>
    <span class="section-header__message--icon section-header__min-icon _icon-message"></span>
</a>
