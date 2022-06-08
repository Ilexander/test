<header>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-logo">
                <a href="{{route('auth.login',['language' => Config::get('app.locale')])}}">
                    <picture><source srcset="{{asset('new/img/logo.svg')}}" type="image/webp"><img src="{{asset('new/img/logo.svg')}}" alt="logo"></picture>
                </a>
              </div>
            <x-language-selector/>
            <div class="navbar-buttons">
                <a href="{{route('auth.services',['language' => Config::get('app.locale')])}}"><button class="btn btn-services" tabindex="-1">services</button></a>
                <a href="{{route('auth.api',['language' => Config::get('app.locale')])}}"><button class="btn btn-api" tabindex="-1">API</button></a>
                <a class="btn-signup--login" href="/">Log In</a>
                <a href="#"><button class="btn btn-signup" data-register="true" tabindex="-1">sign up</button></a>
            </div>
            <div class="navbar-hamburger">
                <div class="navbar-hamburger-bar"></div>
                <div class="navbar-hamburger-bar"></div>
                <div class="navbar-hamburger-bar"></div>
            </div>
            <div class="navbar-hidden">
                <ul class="navbar-list">
                    <a href="{{route('auth.services',['language' => Config::get('app.locale')])}}">
                        <li class="navbar-list-item">Services</li>
                    </a>
                    <a href="{{route('auth.api',['language' => Config::get('app.locale')])}}">
                        <li class="navbar-list-item">API</li>
                    </a>
                    <a href="{{route('auth.faq',['language' => Config::get('app.locale')])}}">
                        <li class="navbar-list-item">FAQs</li>
                    </a>
                    <a href="{{route('auth.policy',['language' => Config::get('app.locale')])}}">
                        <li class="navbar-list-item">Terms and Conditions</li>
                    </a>
                    <li class="navbar-list-item" data-register="true">Sign up</li>
                    <a href="{{route('auth.login',['language' => Config::get('app.locale')])}}">
                        <li class="navbar-list-item" data-login="true">Log in</li>
                    </a>
                </ul>
                <!-- <div class="navbar-lang">
                    <div class="navbar-lang-option" id="en"></div>
                    <div class="navbar-lang-option" id="fr"></div>
                    <div class="navbar-lang-option" id="de"></div>
                </div> -->
            </div>
        </div>
    </nav>
</header>
