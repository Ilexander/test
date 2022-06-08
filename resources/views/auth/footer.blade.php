<footer class="footer">
    <div class="container">
        <div class="footer-wrapper">
            <div class="footer-info">
                <div class="footer-header"><a href="{{route('auth.login',['language' => Config::get('app.locale')])}}" translate="no">Follow.sale</a></div>
                <div class="footer-text">All user information is kept 100% private and will NOT be shared with anyone. Always remember, you are protected with our panel - Most trusted smm panel</div>
            </div>
            <div class="footer-access">
                <ul class="footer-list">
                    <div class="footer-header">Quick Links</div>
                    <li><a href="{{route('auth.login',['language' => Config::get('app.locale')])}}#login" class="footer-link">Login</a></li>
                    <li><a href="{{route('auth.login',['language' => Config::get('app.locale')])}}" class="footer-link" data-register="true">Sign up</a></li>
                </ul>
                <ul class="footer-list">
                    <div class="footer-header">Contacts</div>
                    <li><a href="mailto:topfollow@rambler.ru">topfollow@rambler.ru</a></li>
                </ul>
            </div>
            <div class="footer-rest">
                <ul class="footer-list">
                    <li><a href="{{route('auth.policy',['language' => Config::get('app.locale')])}}" class="footer-link">Terms & Conditions</a></li>
                    <li><a href="{{route('auth.faq',['language' => Config::get('app.locale')])}}" class="footer-link">FAQs</a></li>
                    <li><a href="{{route('auth.api',['language' => Config::get('app.locale')])}}" class="footer-link">API Documentation</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copyright">Copyright © 2022</div>
            <ul class="footer-bottom-links">
                <li><a href="#" class="footer-link"><picture><source srcset="{{asset('new/img/pinterest-footer.svg')}}" type="image/webp"><img src="{{asset('new/img/pinterest-footer.svg')}}" alt="pinterest link"></picture></a></li>
                <li><a href="#" class="footer-link"><picture><source srcset="{{asset('new/img/insta-footer.svg')}}" type="image/webp"><img src="{{asset('new/img/insta-footer.svg')}}" alt="instagram link"></picture></a></li>
                <li><a href="#" class="footer-link"><picture><source srcset="{{asset('new/img/youtube-footer.svg')}}" type="image/webp"><img src="{{asset('new/img/youtube-footer.svg')}}" alt="youtube channel link"></picture></a></li>
                <li><a href="#" class="footer-link"><picture><source srcset="{{asset('new/img/twttr-footer.svg')}}" type="image/webp"><img src="{{asset('new/img/twttr-footer.svg')}}" alt="twitter link"></picture></a></li>
                <li><a href="#" class="footer-link"><picture><source srcset="{{asset('new/img/facebook-footer.svg')}}" type="image/webp"><img src="{{asset('new/img/facebook-footer.svg')}}" alt="facebook link"></picture></a></li>
            </ul>
        </div>
    </div>
</footer>
