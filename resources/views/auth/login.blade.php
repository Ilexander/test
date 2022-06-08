<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Follow Sale - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
{{--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css"
        rel="stylesheet"
    />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.min.js"
    ></script>
    <x-page-orientation/>
</head>
<body class="home-page">
<div class="preloader">
    <picture><source srcset="{{asset('new/img/logo.svg')}}" type="image/webp"><img src="{{asset('new/img/logo.svg')}}"></picture>
</div>

<div class="input-field">

</div>

<div class="popup">
    <div class="popup-close">
        <div class="popup-cross"></div>
    </div>
    <x-user-register/>
</div>

<div class="popup-forgot" style="display: none;">
    <div class="popup-close" id="popup-forgot-close">
        <div class="popup-cross"></div>
    </div>

    <div class="popup-wrapper" id="wrapper-forgot">
        <div class="popup-header">Please write down your email</div>
        <div class="popup-subheader">The password reset letter will be sent there immediately.</div>
        <form action="{{route('auth.password.reset',['language' => Config::get('app.locale')])}}" method="POST" class="popup-form" style="padding-bottom: 2rem" id="form-forgot">
            @csrf
            <div class="popup-input popup-input-animated mt-5 mb-3">
                <label for="emailReset" class="popup-label">Email</label>
                <input type="email" class="form-control popup-input-field" id="emailReset" name="emailReset" autocomplete="new-password">
            </div>
            <input type="hidden" id="route-forgot" value="{{route('auth.password.reset',['language' => Config::get('app.locale')])}}" data-token="{{csrf_token()}}">
            <div class="form-group row" style="width: 100%" style="justify-content: center;">
                            <div class="col-md-6"> {!!htmlFormSnippet()!!} </div>
                        </div>
            <input type="submit" value="Send request" class="signup-btn">
            <button class="popup-submit-btn">Send request</button>
        </form>
    </div>
</div>


@include('auth.header')
<main>
    <section class="about">
        <div class="container about-wrapper">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <h2 class="about-header" id="login">
                        {{
                            isset($translation['title_name'])
                            ? $translation['title_name']->context
                            : ($login_settings['title_name']['field_value'] ?? 'Buy TopFollow.app
                        Instagram Followers and Likes here!')
                        }}
                    </h2>
                    <ul class="features">
                        <li class="features-item">
                            {{
                                isset($translation['choose_first_block_name'])
                                ? $translation['choose_first_block_name']->context
                                : ($login_settings['choose_first_block_name']['field_value'] ?? 'Unbelievable Prices')
                            }}
                        </li>
                        <li class="features-item">
                            {{
                                isset($translation['choose_second_block_name'])
                                ? $translation['choose_second_block_name']->context
                                : ($login_settings['choose_second_block_name']['field_value'] ?? 'Delivering Within a Minutes')
                            }}
                        </li>
                        <li class="features-item">
                            {{
                                isset($translation['choose_third_block_name'])
                                ? $translation['choose_third_block_name']->context
                                : ($login_settings['choose_third_block_name']['field_value'] ?? 'Support Only 24/7')
                            }}
                        </li>
                    </ul>
                </div>
                <div class="offset-sm-1 col-sm-10 offset-md-0 col-md-8 col-lg-4 offset-lg-1 about-form">
                    <form action="{{route('auth.auth',['language' => Config::get('app.locale')])}}" class="form" method="POST">
                        @csrf
                        @if($is_autologin)
                            <input type="hidden" name="autologin" value="{{$is_autologin}}">
                        @endif

                        <div class="popup-input popup-input-animated mb-3 mt-5 ">
                            <label for="emailAuth" class="popup-label">Email</label>
                            <input
                            type="email"
                            class="form-control popup-input-field input-auth"
                            id="{{!$is_autologin ? "emailAuth" : "autoEmail"}}"
                            name="emailAuth"
                            autocomplete="email"
                            value="{{$is_autologin ? $email : ""}}"
                            >
                            <p class="error">This field is not filled in correctly</p>
                        </div>
                        <div class="popup-input popup-input-animated mb-3">
                            <label for="passwordAuth" class="popup-label">Password</label>
                            <input
                                type="password"
                                class="form-control popup-input-field input-auth"
                                id="{{!$is_autologin ? "passwordAuth" : "autoPass"}}"
                                name="passwordAuth"
                                autocomplete="new-password"
                                value="{{$is_autologin ? $password : ""}}"
                            >
                            <p class="error">The email auth field is required.</p>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <div class="col-md-6"> {!!htmlFormSnippet()!!} </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="about-holder">
                                <input type="checkbox" name="remember" id="remember" class="about-checkbox">
                                <label for="remember" class="about-remember">Remember me</label>
                            </div>
                            <a href="#" class="about-forgot" data-forgot="true">Forgot password?</a>
                        </div>
                        <div class="d-flex">
                            <div class="btn btn-signup btn-signup-white" data-register="true">Sign up</div>
                            <button class="btn btn-login" id="loginButton" data-login="true">Login</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="social" data-aos="fade-up">
        <div class="container">
            <div class="social-wrapper">
                <div class="social-item" id="yt">
                    <picture><source srcset="{{asset('new/img/youtube-icon.svg')}}" type="image/webp"><img src="{{asset('new/img/youtube-icon.svg')}}" alt="youtube"></picture>
                </div>
                <div class="social-item" id="fb">
                    <picture><source srcset="{{asset('new/img/facebook-icon.svg')}}" type="image/webp"><img src="{{asset('new/img/facebook-icon.svg')}}" alt="facebook"></picture>
                </div>
                <div class="social-item" id="sp">
                    <picture><source srcset="{{asset('new/img/spotify-icon.svg')}}" type="image/webp"><img src="{{asset('new/img/spotify-icon.svg')}}" alt="spotify"></picture>
                </div>
                <div class="social-item" id="tw">
                    <picture><source srcset="{{asset('new/img/twttr-icon.svg')}}" type="image/webp"><img src="{{asset('new/img/twttr-icon.svg')}}" alt="twitter"></picture>
                </div>
                <div class="social-item" id="ig">
                    <picture><source srcset="{{asset('new/img/insta-icon.svg')}}" type="image/webp"><img src="{{asset('new/img/insta-icon.svg')}}" alt="instagram"></picture>
                </div>
                <div class="social-item" id="ld">
                    <picture><source srcset="{{asset('new/img/linkedin-icon.svg')}}" type="image/webp"><img src="{{asset('new/img/linkedin-icon.svg')}}" alt="linkedin"></picture>
                </div>
            </div>
        </div>
    </section>
        <section class="hiw">
        <div class="deco-item" id="yellow"></div>
        <div class="deco-item" id="red"></div>
        <div class="deco-item" id="pink"></div>
        <div class="deco-item" id="purple"></div>
        <div class="container">
            <div class="hiw-header">How it works?</div>
            <div class="hiw-main-header">
                {{
                     isset($translation['how_works_name'])
                     ? $translation['how_works_name']->context
                     : ($login_settings['how_works_name']['field_value'] ?? 'By following the processes below you can make any order you want')
                }}
            </div>
            <div class="hiw-cards-wrapper">
                <div class="hiw-card" data-aos="flip-right">
                    <div class="hiw-card-number">1</div>
                    <div class="hiw-card-header">
                        {{
                             isset($translation['how_works_first_step_name'])
                             ? $translation['how_works_first_step_name']->context
                             : ($login_settings['how_works_first_step_name']['field_value'] ?? 'Register & log in')
                        }}
                    </div>
                    <div class="hiw-card-text">
                        {{
                             isset($translation['how_works_first_step_text'])
                             ? $translation['how_works_first_step_text']->context
                             : ($login_settings['how_works_first_step_text']['field_value'] ?? 'Creating an account is the first step, then you need to log in.')
                        }}
                    </div>
                </div>
                <div class="hiw-line hiw-line-reversed" id="first"></div>
                <div class="hiw-card" data-aos="flip-up">
                    <div class="hiw-card-number">2</div>
                    <div class="hiw-card-header">
                        {{
                             isset($translation['how_works_second_step_name'])
                             ? $translation['how_works_second_step_name']->context
                             : ($login_settings['how_works_second_step_name']['field_value'] ?? 'Add funds')
                        }}
                    </div>
                    <div class="hiw-card-text">
                        {{
                             isset($translation['how_works_second_step_text'])
                             ? $translation['how_works_second_step_text']->context
                             : ($login_settings['how_works_second_step_text']['field_value'] ?? 'Next, pick a payment method and add funds to your account.')
                        }}
                    </div>
                </div>
                <div class="hiw-line" id="middle"></div>
                <div class="hiw-card" data-aos="flip-down">
                    <div class="hiw-card-number">3</div>
                    <div class="hiw-card-header">
                        {{
                             isset($translation['how_works_third_step_name'])
                             ? $translation['how_works_third_step_name']->context
                             : ($login_settings['how_works_third_step_name']['field_value'] ?? 'Select a service')
                        }}
                    </div>
                    <div class="hiw-card-text">
                        {{
                             isset($translation['how_works_third_step_text'])
                             ? $translation['how_works_third_step_text']->context
                             : ($login_settings['how_works_third_step_text']['field_value'] ?? 'Select the services you want and get ready to receive more publicity.')
                        }}
                    </div>
                </div>
                <div class="hiw-line hiw-line-reversed" id="last"></div>
                <div class="hiw-card" data-aos="flip-left">
                    <div class="hiw-card-number">4</div>
                    <div class="hiw-card-header">
                        {{
                             isset($translation['how_works_fourth_step_name'])
                             ? $translation['how_works_fourth_step_name']->context
                             : ($login_settings['how_works_fourth_step_name']['field_value'] ?? 'Enjoy superb results')
                        }}
                    </div>
                    <div class="hiw-card-text">
                        {{
                             isset($translation['how_works_fourth_step_text'])
                             ? $translation['how_works_fourth_step_text']->context
                             : ($login_settings['how_works_fourth_step_text']['field_value'] ?? 'You can enjoy incredible results when your order is complete.')
                        }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="promotion">
        <div class="container">
            <div class="promotion-subheader" data-aos="fade-up">Why choose us?</div>
            <div class="promotion-header" data-aos="fade-up">
                {{
                    isset($translation['choose_title'])
                    ? $translation['choose_title']->context
                    : ($login_settings['choose_title']['field_value'] ?? 'We Make Your Promotion Easier')
                }}
            </div>
            <div class="promotion-advantages" data-aos="fade-up">
                <div class="advantage">
                    <div class="advantage-image">
                        <picture><source srcset="{{asset('new/img/calls.png')}}" type="image/webp"><img src="{{asset('new/img/advantage-support.svg')}}"></picture>
                    </div>
                    <div class="advantage-header">
                        {{
                            isset($translation['choose_first_block_name'])
                            ? $translation['choose_first_block_name']->context
                            : ($login_settings['choose_first_block_name']['field_value'] ?? 'Support 24/7')
                        }}

                    </div>
                    <div class="advantage-text">
                        {{
                            isset($translation['choose_first_block_text'])
                            ? $translation['choose_first_block_text']->context
                            : ($login_settings['choose_first_block_text']['field_value'] ?? 'We are proud to have the most reliable or fastest support in the SMM World Panel, replying to your tickets 24/7.')
                        }}
                    </div>
                </div>
                <div class="advantage">
                    <div class="advantage-image">
                        <picture><source srcset="{{asset('new/img/man-with-phone.png')}}" type="image/webp"><img src="{{asset('new/img/advantage-deliver.svg')}}"></picture>
                    </div>
                    <div class="advantage-header">
                        {{
                            isset($translation['choose_second_block_name'])
                            ? $translation['choose_second_block_name']->context
                            : ($login_settings['choose_second_block_name']['field_value'] ?? 'Delivering within minutes')
                        }}

                    </div>
                    <div class="advantage-text">
                        {{
                            isset($translation['choose_second_block_text'])
                            ? $translation['choose_second_block_text']->context
                            : ($login_settings['choose_second_block_text']['field_value'] ?? 'Our delivery is automated, and it takes minutes if not seconds to fulfil orders.')
                        }}
                    </div>
                </div>
                <div class="advantage">
                    <div class="advantage-image">
                        <picture><source srcset="{{asset('new/img/two-girls.png')}}" type="image/webp"><img src="{{asset('new/img/advantage-prices.svg')}}"></picture>
                    </div>
                    <div class="advantage-header">
                        {{
                            isset($translation['choose_third_block_name'])
                            ? $translation['choose_third_block_name']->context
                            : ($login_settings['choose_third_block_name']['field_value'] ?? 'Unbelievable Prices')
                        }}
                    </div>
                    <div class="advantage-text">
                        {{
                            isset($translation['choose_third_block_text'])
                            ? $translation['choose_third_block_text']->context
                            : ($login_settings['choose_third_block_text']['field_value'] ?? 'Our prices most reasonable in the market, starting from at $0.001.')
                        }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="offer">
        <div class="container">
            <div class="offer-wrapper">
                <div class="palettes" data-aos="fade-right">
                    <div class="palettes-item palettes-item-couple"></div>
                    <div class="palettes-item">
                        <div class="cube-lg cube-lg-purple"></div>
                        <div class="cube-sm cube-sm-tr"></div>
                    </div>
                    <div class="palettes-item">
                        <div class="cube-lg cube-lg-cyan"></div>
                        <div class="cube-sm cube-sm-bl"></div>
                    </div>
                    <div class="palettes-item palettes-item-employees"></div>
                </div>
                <div class="offer-text" data-aos="fade-left">
                    <div class="offer-header">
                        {{
                             isset($translation['how_works_our_offer_name'])
                             ? $translation['how_works_our_offer_name']->context
                             : ($login_settings['how_works_our_offer_name']['field_value'] ?? 'What We Offer For Your Success Brand')
                        }}
                    </div>
                    <div class="offer-paragraph">
                        {!!
                             isset($translation['how_works_our_offer_desc'])
                             ? $translation['how_works_our_offer_desc']->context
                             : ($login_settings['how_works_our_offer_desc']['field_value'] ?? "We are active for support only 24 hours a day and seven times a week with all of your demands and services around the day. Don't go anywhere else.")
                        !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feedback">
        <div class="container">
            <div class="feedback-header" data-aos="fade-up">
                {{
                    isset($translation['reviews_name'])
                    ? $translation['reviews_name']->context
                    : ($login_settings['reviews_name']['field_value'] ?? 'What People Say About Us?')
                }}
            </div>
            <div class="feedback-subheader" data-aos="fade-up">
                {{
                    isset($translation['reviews_desc'])
                    ? $translation['reviews_desc']->context
                    : ($login_settings['reviews_desc']['field_value'] ?? 'Our service has an extensive customer roster built on years’ worth of trust. Read what our buyers think about our range of service.')
                }}
            </div>
            <div class="slider">
                <div class="slider-arrows">
                    <div class="slider-prev"><i class="fas fa-long-arrow-alt-left"></i></div>
                    <div class="slider-next"><i class="fas fa-long-arrow-alt-right"></i></div>
                </div>
                <div class="slider-track">
                    <div class="slider-slide">
                        <div class="feedback-user" data-aos="zoom-in-right">
                            <div class="feedback-avatar">
                                <picture><source srcset="{{asset('new/img/user-john-smith.svg')}}" type="image/webp"><img src="{{asset('new/img/user-john-smith.svg')}}" alt="John Smith photo"></picture>
                            </div>
                            <div class="feedback-quotemark">"</div>
                            <div class="feedback-rect"></div>
                        </div>
                        <div class="feedback-text" data-aos="zoom-in-left">
                            <div class="feedback-message">After trying several websites who claim to have 'fast delivery', I'm glad I finally found this service. They literally started delivering 5 seconds after my payment!</div>
                            <div class="feedback-author">John Smith - Youtuber</div>
                        </div>
                    </div>
                    <div class="slider-slide">
                        <div class="feedback-user" data-aos="zoom-in-right">
                            <div class="feedback-avatar">
                                <picture><source srcset="{{asset('new/img/user-john-smith.svg')}}" type="image/webp"><img src="{{asset('new/img/user-john-smith.svg')}}" alt="John Smith photo"></picture>
                            </div>
                            <div class="feedback-quotemark">"</div>
                            <div class="feedback-rect"></div>
                        </div>
                        <div class="feedback-text">
                            <div class="feedback-message">After trying several websites who claim to have 'fast delivery', I'm glad I finally found this service. They literally started delivering 5 seconds after my payment!</div>
                            <div class="feedback-author">John Smith - Youtuber</div>
                        </div>
                    </div>
                    <div class="slider-slide">
                        <div class="feedback-user" data-aos="zoom-in-right">
                            <div class="feedback-avatar">
                                <picture><source srcset="{{asset('new/img/user-john-smith.svg')}}" type="image/webp"><img src="{{asset('new/img/user-john-smith.svg')}}" alt="John Smith photo"></picture>
                            </div>
                            <div class="feedback-quotemark">"</div>
                            <div class="feedback-rect"></div>
                        </div>
                        <div class="feedback-text">
                            <div class="feedback-message">After trying several websites who claim to have 'fast delivery', I'm glad I finally found this service. They literally started delivering 5 seconds after my payment!</div>
                            <div class="feedback-author">John Smith - Youtuber</div>
                        </div>
                    </div>
                    <div class="slider-slide">
                        <div class="feedback-user" data-aos="zoom-in-right">
                            <div class="feedback-avatar">
                                <picture><source srcset="{{asset('new/img/user-john-smith.svg')}}" type="image/webp"><img src="{{asset('new/img/user-john-smith.svg')}}" alt="John Smith photo"></picture>
                            </div>
                            <div class="feedback-quotemark">"</div>
                            <div class="feedback-rect"></div>
                        </div>
                        <div class="feedback-text">
                            <div class="feedback-message">After trying several websites who claim to have 'fast delivery', I'm glad I finally found this service. They literally started delivering 5 seconds after my payment!</div>
                            <div class="feedback-author">John Smith - Youtuber</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="faq">
        <div class="faq-wrapper">
            <div class="faq-rect"></div>
            <div class="faq-circle faq-circle-blue"></div>
            <div class="faq-circle faq-circle-pink"></div>
            <div class="faq-header" data-aos="fade-up">
                {{
                    isset($translation['faq_name'])
                    ? $translation['faq_name']->context
                    : ($login_settings['faq_name']['field_value'] ?? 'FAQs')
                }}
            </div>
            <div class="faq-subheader" data-aos="fade-up">
                {{
                    isset($translation['faq_desc'])
                    ? $translation['faq_desc']->context
                    : ($login_settings['faq_desc']['field_value'] ?? 'We answered some of the most frequently asked questions on our panel.')
                }}
            </div>


            @foreach($faqs as $faq)

                @php
                    $hasTranslate = false;
                @endphp

                @foreach($faq->translation as $translation)

                    @if(strtolower($translation->language->alt) === Config::get('language.current'))
                        <div class="faq-qna">
                            <div class="faq-question">
                                <div class="faq-question-text">{{$translation->title}}</div>
                                <div class="faq-toggler"></div>
                            </div>
                            <div class="faq-answer">{{$translation->context}}</div>
                        </div>
                        @php
                            $hasTranslate = true;
                        @endphp
                    @endif
                @endforeach

                @if(!$hasTranslate)
                    <div class="faq-qna">
                        <div class="faq-question">
                            <div class="faq-question-text">{{$faq->question}}</div>
                            <div class="faq-toggler"></div>
                        </div>
                        <div class="faq-answer">{{$faq->answer}}</div>
                    </div>
                @endif

            @endforeach
        </div>
    </section>
    <section class="newsletter">
        <div class="newsletter-hearts"></div>
        <div class="newsletter-people"></div>
        <div class="container">
            <form
                action="{{route('auth.subscribe',['language' => Config::get('app.locale')])}}"
                class="newsletter-form"
                data-aos="fade-up"
                id="emailNewsletterForm"
                method="POST"
            >
                @csrf
                <div class="newsletter-header" data-aos="fade-up">
                    {{
                        isset($translation['newsletter_name'])
                        ? $translation['newsletter_name']->context
                        : ($login_settings['newsletter_name']['field_value'] ?? 'Newsletter')
                     }}
                </div>
                <div class="newsletter-subheader" data-aos="fade-up">
                    {{
                        isset($translation['newsletter_desc'])
                        ? $translation['newsletter_desc']->context
                        : ($login_settings['newsletter_desc']['field_value'] ?? 'Fill in the ridiculously small form below to receive our ridiculously cool newsletter!')
                     }}
                </div>
                <input class="newsletter-input" data-aos="fade-up" type="email" name="emailNewsletter" id="emailNewsletter" placeholder="Email" required>
                <p class="emailNewsError" style="color: red; text-align: center; display: none;">Email is not valid!</p>
                <div class="newsletter-button-holder" data-aos="fade-up">
                    <button type="submit" class="newsletter-submit">Subscribe now</button>
                </div>
            </form>
        </div>
    </section>
</main>
@include('auth.footer')
<script>
    @if($is_autologin)
        autoLogin();
    @endif

    function autoLogin()
    {
        document.getElementById('loginButton').click()
    }

    $(document).ready(function() {

        var select2 = $('#timezone').select2();

        select2.on("select2:open", () => {
            clearAllOptions();
            setOptions();
        });

        select2.on("select2:close", () => {
            var selected = $('#timezone').find(':selected');

            clearAllOptions();

            var newOption = new Option(selected.text(), selected.val(), true, true);

            $('#timezone').append(newOption).trigger('change');
        });

        select2.on("select2:select", () => {

        });

    });

    function clearAllOptions()
    {
        $('#timezone').html('');

        var newOption = new Option('Select Timezone', 'select2-timezone-container', true, true);

        $('#timezone').append(newOption).trigger('change');
    }

    function setOptions()
    {
        $.ajax({
            type: "GET",
            url: "{{route('auth.time-zones', ['language' => Config::get('language.current')])}}",
            data: {

            }
        }).done(function(data) {
            $.each(data.result, function( key, value ) {
                var newOption = new Option('('+value.diff_from_gtm+') ' + key, key, true, true);
                $('#timezone').append(newOption).trigger('change');
            });
        });

        {{--<option--}}
        {{--    data-value="{{$timezone['offset']}}"--}}
        {{--    value="{{$name}}">--}}
        {{--({{$timezone['diff_from_gtm']}}) {{$name}}--}}
        {{--</option>--}}

    }

    checkTimeZone();


    function checkTimeZone()
    {
        const date = new Date();
        const offset = date.getTimezoneOffset();
        var currentTime = offset / 60 * (-1);

        $("#timezone > option").each(function() {

            var time = $(this).data('value');

            if (typeof time !== 'undefined') {
                var data = time.split(':');
                data = parseInt(data[0]);

                if (currentTime === data) {

                    $("#timezone").val(this.value).change();

                    return false;
                }
            }
        });
    }

</script>
<script src="https://www.google.com/recaptcha/api.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('new/main.js')}}"></script>
</body>
</html>
