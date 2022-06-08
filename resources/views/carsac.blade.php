<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ucfirst(Request::segment(3))}}</title>
    <link href="{{asset('admin/css/style.min.css')}}" rel="stylesheet">
</head>
<body>
<script>
    if(localStorage.getItem('theme') == 'dark') {
        document.querySelector('body').classList.add('_dark-theme');
    }
</script>
<div class="wrapper d-flex">
    <x-nav-bar :tickets="$tickets" />
    <section class="statistics section ps-3 pt-lg-3 pt-5 mt-4 mt-lg-0 pb-5 pe-1 pe-lg-3">
        <x-header :tickets="$tickets"/>

        @yield('content')
    </section>


</div>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<script src="{{asset('admin/js/libs.min.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<script src="{{asset('admin/js/main.min.js')}}"></script>
</body>
</html>
