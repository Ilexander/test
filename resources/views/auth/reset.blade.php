<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <x-page-orientation/>
    <link rel="stylesheet" href="{{asset('admin/sass/secondary.min.css')}}">
</head>
<body>

    <div class="popup" style="display: block">
        <form method="POST" action="{{route("auth.password.restore",['language' => Config::get('app.locale')])}}" class="popup-form popup-form-reset">
            @csrf
            <div class="popup-header">Resetting your password</div>
            <input type="hidden" value="{{$token}}" name="token">

            <div class="mb-1" style="color: white">
                <label class="form-label" for="register-email">Enter your new password</label>
                <input class="form-control" id="newpassword" type="password" name="newpassword"  aria-describedby="register-password"/>
            </div>

            <div class="mb-1" style="color: white">
                <label class="form-label" for="register-username">Confirm your new password</label>
                <input class="form-control" id="cnewpassword" type="password" name="cnewpassword" aria-describedby="register-password" />
            </div>

            <button class="" type="submit">Change your password</button>
            <!--Change route to login page-->
{{--            <a href="#">--}}
{{--                <button class="" type="submit">Change your password</button>--}}
{{--            </a>--}}
        </form>
    </div>


    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".popup-submit-btn").on("click", (e) => {
            e.preventDefault();
            // validateReg(".popup-form");
        });

        let validateReg = (formValidated) => {
            $(formValidated).validate({
                errorClass: "popup-input-error",
                validClass: "popup-input-valid",
                rules: {
                        newpassword: {
                            minlength: 8,
                            checkRegExp: true,
                        },
                        cnewpassword: {
                            minlength: 8,
                            equalTo: '[name="newpassword"]',
                            checkRegExp: true,
                        }
                }
            });
        }

        $.validator.addMethod('checkRegExp', function (value) {
            return /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9!@#$%^&*]{8,})$/.test(value);
        }, 'The password must contain at least one capital letter and one digit');

        validateReg(".popup-form");
    </script>
</body>
</html>
