<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Модальное окно на чистом CSS</title>
    <style>
        body {
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            color: #292b2c;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        /* свойства модального окна по умолчанию */
        .modal {
            position: fixed;
            /* фиксированное положение */
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            /* цвет фона */
            z-index: 1050;
            opacity: 0;
            /* по умолчанию модальное окно прозрачно */
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            /* анимация перехода */
            pointer-events: none;
            /* элемент невидим для событий мыши */
        }

        /* при отображении модального окно */
        .modal:target {
            opacity: 1;
            pointer-events: auto;
            overflow-y: auto;
        }

        /* ширина модального окна и его отступы от экрана */
        .modal-dialog {
            position: relative;
            width: auto;
            margin: 10px;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 30px auto;
            }
        }

        /* свойства для блока, содержащего контент модального окна */
        .modal-content {
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem;
            outline: 0;
        }

        @media (min-width: 768px) {
            .modal-content {
                -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
                box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
            }
        }

        /* свойства для заголовка модального окна */
        .modal-header {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #eceeef;
        }

        .modal-title {
            margin-top: 0;
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 1.25rem;
            font-weight: 500;
        }

        /* свойства для кнопки "Закрыть" */
        .close {
            float: right;
            font-family: sans-serif;
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
            text-decoration: none;
        }

        /* свойства для кнопки "Закрыть" при нахождении её в фокусе или наведении */
        .close:focus,
        .close:hover {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            opacity: .75;
        }

        /* свойства для блока, содержащего основное содержимое окна */
        .modal-body {
            position: relative;
            -webkit-box-flex: 1;
            -webkit-flex: 1 1 auto;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 15px;
            overflow: auto;
        }

        h1 {
            font-size: 1.25rem;
            font-weight: 500;
        }

        p {
            font-weight: 500;
        }

        /* text-field */
        .text-field {
            margin-bottom: 1rem;
        }

        .text-field__label {
            display: block;
            margin-bottom: 0.25rem;
        }

        .text-field__input {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #bdbdbd;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .text-field__input::placeholder {
            color: #212529;
            opacity: 0.4;
        }

        .text-field__input:focus {
            color: #212529;
            background-color: #fff;
            border-color: #bdbdbd;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(158, 158, 158, 0.25);
        }

        .text-field__input:disabled,
        .text-field__input[readonly] {
            background-color: #f5f5f5;
            opacity: 1;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

<h1 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Добро пожаловать</h1>
<div class="container">
    <div style="text-align: center;">
        <a href="#openModal">Поехали</a>
    </div>
    <div id="openModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Настроить подключение к базе данных</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">

                    <label class="text-field__label" for="db_host">Хост базы данных</label>
                    <input class="text-field__input" type="text" name="db_host" id="db_host" placeholder="Host">

                    <label class="text-field__label" for="db_port">Порт базы данных</label>
                    <input class="text-field__input" type="text" name="db_port" id="db_port" placeholder="Port">

                    <label class="text-field__label" for="db_database">Название базы данных</label>
                    <input class="text-field__input" type="text" name="db_database" id="db_database" placeholder="Database">

                    <label class="text-field__label" for="db_username">Имя пользователя базы данных</label>
                    <input class="text-field__input" type="text" name="db_username" id="db_username" placeholder="Username">

                    <label class="text-field__label" for="db_password">Пароль пользователя базы данных</label>
                    <input class="text-field__input" type="text" name="db_password" id="db_password" placeholder="Password">

                    <br>
                    <a href="#addAdmin">Поехали</a>
                </div>
            </div>
        </div>
    </div>

    <div id="addAdmin" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Добавление админа</h3>
                    <a href="#closeAdmin" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">

                    <label class="text-field__label" for="email">Электронная почта</label>
                    <input class="text-field__input" type="text" name="email" id="email" placeholder="Email">

                    <label class="text-field__label" for="password">Пароль пользователя</label>
                    <input class="text-field__input" type="text" name="password" id="password" placeholder="Password">

                    <label class="text-field__label" for="first_name">Имя пользователя</label>
                    <input class="text-field__input" type="text" name="first_name" id="first_name" placeholder="Host">

                    <label class="text-field__label" for="last_name">Фамилия пользователя</label>
                    <input class="text-field__input" type="text" name="last_name" id="last_name" placeholder="Host">

                    <label class="text-field__label" for="timezone">Временной пояс</label>
                    <select class="select2 form-select" id="timezone" name="timezone">
                        @foreach($timezoneList as $name => $timezone)
                            <option value="{{$name}}">({{$timezone['diff_from_gtm']}}) {{$name}}</option>
                        @endforeach
                    </select>


{{--                    <input type="file" name="image_file"><br/>--}}



                    <br>

                    <button onclick="finish()"> Готово </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function finish()
    {
        // console.log('finish install');
        // console.log($('#db_host').val());
        // console.log($('#db_port').val());
        // console.log($('#db_database').val());
        // console.log($('#db_username').val());
        // console.log($('#db_password').val());
        // console.log($('#email').val());
        // console.log($('#password').val());
        // console.log($('#first_name').val());
        // console.log($('#last_name').val());
        // console.log($('#timezone').val());

        $.ajax({
            type: "POST",
            url: "{{route('database.setting')}}",
            data: {
                db_host : $('#db_host').val(),
                db_port : $('#db_port').val(),
                db_database : $('#db_database').val(),
                db_username : $('#db_username').val(),
                db_password : $('#db_password').val(),
                email : $('#email').val(),
                password : $('#password').val(),
                first_name : $('#first_name').val(),
                last_name : $('#last_name').val(),
                timezone : $('#timezone').val(),
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {
            console.log(data);
        });

    }

    document.addEventListener("DOMContentLoaded", function () {
        var scrollbar = document.body.clientWidth - window.innerWidth + 'px';
        console.log(scrollbar);
        document.querySelector('[href="#openModal"]').addEventListener('click', function () {
            document.body.style.overflow = 'hidden';
            document.querySelector('#openModal').style.marginLeft = scrollbar;
        });

        document.querySelector('[href="#close"]').addEventListener('click', function () {
            document.body.style.overflow = 'visible';
            document.querySelector('#openModal').style.marginLeft = '0px';
        });

        document.querySelector('[href="#addAdmin"]').addEventListener('click', function () {
            document.body.style.overflow = 'hidden';
            document.querySelector('#addAdmin').style.marginLeft = scrollbar;

            document.querySelector('#openModal').style.marginLeft = '0px';
        });

        document.querySelector('[href="#closeAdmin"]').addEventListener('click', function () {
            document.body.style.overflow = 'visible';
            document.querySelector('#addAdmin').style.marginLeft = '0px';
        });
    });


</script>

</body>

</html>

















{{--Системные требования:--}}
{{--<br/>--}}
{{--версия php 8.0--}}
{{--<br/>--}}
{{--nginx server 1.20.2--}}
{{--<br/>--}}
{{--база данных mysql--}}

{{--<br/>--}}
{{--<br/>--}}
{{--<br/>--}}
{{--Настройки баны данных--}}
{{--<form>--}}
{{--    Хост базы данных<br/>--}}
{{--    <input type="text" name="db_host" placeholder="Хост базы данных"><br/>--}}
{{--    Порт базы данных<br/>--}}
{{--    <input type="text" name="db_port" placeholder="Порт базы данных"><br/>--}}
{{--    Название базы данных<br/>--}}
{{--    <input type="text" name="db_database" placeholder="Название базы данных"><br/>--}}
{{--    Имя пользователя базы данных<br/>--}}
{{--    <input type="text" name="db_username" placeholder="Имя пользователя базы данных"><br/>--}}
{{--    Пароль пользователя базы данных<br/>--}}
{{--    <input type="text" name="db_password" placeholder="Пароль пользователя базы данных"><br/>--}}
{{--</form>--}}


{{--<form>--}}

{{--    <input type="text" name="email" placeholder="email"><br/>--}}
{{--    <input type="text" name="password" placeholder="password"><br/>--}}
{{--    <input type="text" name="first_name" placeholder="First Name"><br/>--}}
{{--    <input type="text" name="last_name" placeholder="Last Name"><br/>--}}
{{--    <input type="text" name="timezone" placeholder="timezone"><br/>--}}
{{--    <input type="text" name="more_information" placeholder="More Information"><br/>--}}
{{--    <input type="text" name="desc" placeholder="desc"><br/>--}}
{{--    <input type="text" name="password" placeholder="password"><br/>--}}
{{--    <input type="file" name="image_file"><br/>--}}


{{--</form>--}}
