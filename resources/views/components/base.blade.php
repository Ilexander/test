<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('admin/css/style.min.css')}}" rel="stylesheet">
</head>
<body>
    <script>
        if(localStorage.getItem('theme') == 'dark') {
            document.querySelector('body').classList.add('_dark-theme');
        }
    </script>
    <div class="wrapper d-flex">
        <x-nav-bar/>
        <section class="statistics section ps-3 pt-lg-3 pt-5 mt-4 mt-lg-0 pb-5 pe-1 pe-lg-3">
            <x-header/>
        </section>
    </div>
</body>
</html>