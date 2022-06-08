<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Follow Sale - F.A.Q.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <x-page-orientation/>
    <link rel="stylesheet" href="{{asset('admin/sass/secondary.min.css')}}">
</head>
<body>
<div class="preloader">
    <picture><source srcset="{{asset('new/img/logo.svg')}}" type="image/webp"><img src="{{asset('new/img/logo.svg')}}"></picture>
</div>
<div class="round-blue"></div>
<div class="round-pink"></div>
<div class="grid-deco"></div>
<div class="popup">
    <div class="popup-close">
        <div class="popup-cross"></div>
    </div>
    <x-user-register/>
</div>
@include('auth.header')
<main>
    <section class="secondary">
        <div class="secondary-wrapper">
            <div class="faq-header">FAQs</div>
            <div class="faq-subheader">We answered some of the most frequently asked questions on our panel.</div>
            @foreach($faqs as $faq)
                <div class="faq-qna">
                    <div class="faq-question">
                        <div class="faq-question-text">{{$faq->question}}</div>
                        <div class="faq-toggler"></div>
                    </div>
                    <div class="faq-answer">
                        {{$faq->answer}}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
@include('auth.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('new/main.js')}}"></script>
</body>
</html>
