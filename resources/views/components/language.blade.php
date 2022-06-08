<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<div class="section-header__lang _drop-down">
    @foreach($languages as $language)
        @if($language->alt === $current_language)
            <div class="section-header__lang--current section-header__lang--item">
                <button class="section-header__lang--link _drop-down-current">
                    <img src="{{$language->image_url}}" width="32" height="24" alt="" class="section-header__lang--flag">
                    {{$language->alt}}
                </button>
            </div>
        @endif
    @endforeach

    <ul class="section-header__lang--list _drop-down-list">

        @foreach($languages as $language)
            @if($language->alt !== $current_language)
                @php
                    $params = Route::current()->originalParameters();
                    $params['language'] = strtolower($language->alt);
                @endphp
                <li class="section-header__lang--item">
                    <a href="{{route(Route::current()->getName(), $params)}}" class="section-header__lang--link">
                        <img src="{{$language->image_url}}" width="32" height="24" alt="" class="section-header__lang--flag">
                        {{$language->alt}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
