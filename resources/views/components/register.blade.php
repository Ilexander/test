{{--<script src="https://www.google.com/recaptcha/api.js?render={{env('RE_CAPTCHA_PUBLIC_KEY')}}"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>

<div class="container">
  <div class="popup-wrapper">

    <form action="{{route('auth.create',['language' => Config::get('app.locale')])}}" class="popup-form" method="POST">
      @csrf
      <div class="popup-header">{{ __('locale.register.sign_up') }}</div>
      <input type="hidden" name="timezone" id="timezoneUser">
      <div class="popup-input popup-input-animated">
        <label for="email" class="popup-label">{{ __('locale.register.email') }}</label>
        <input type="email" value="{{old('email')}}" class="form-control popup-input-field" id="email" name="email">
        <label id="email-error" class="popup-input-error" for="email" style="display: block;">Please enter a valid email address</label>
        <div id="emailError" class="registerErrorClass"></div>
      </div>
      <div class="popup-input popup-input-animated">
        <label for="fName" class="popup-label">{{ __('locale.register.first_name') }}</label>
        <input type="text" class="form-control popup-input-field" id="fName" name="first_name">
        <div id="first_nameError" class="registerErrorClass"></div>
      </div>
      {{-- <div class="popup-input popup-input-animated">--}}
      {{-- <label for="lName" class="popup-label">{{ __('locale.register.last_name') }}</label>--}}
      {{-- <input type="text" class="form-control popup-input-field" id="lName" name="last_name">--}}
      {{-- </div>--}}
      <div class="popup-input popup-input-animated">
        <label for="password" class="popup-label">{{ __('locale.register.password') }}</label>
        <input type="password" class="form-control popup-input-field" id="password" name="password">
        <div id="passwordError" class="registerErrorClass"></div>
      </div>
      <div class="popup-input popup-input-animated">
        <label for="conpassword" class="popup-label">{{ __('locale.register.confirm_password') }}</label>
        <input type="password" class="form-control popup-input-field" id="conpassword" name="password_confirmation">
        <p class="confirm-error" style="display: none;">Passwords do not match</p>
      </div>
      <!-- <select name="timezone" class="timezone-select" id="timezone" style="width: 100%; margin-bottom: 15px;">
        <option>{{ __('locale.register.select_timezone') }}</option>

      </select> -->
      <!-- <div id="timezoneError" class="registerErrorClass"></div> -->
      {{-- <div class="g-recaptcha brochure__form__captcha popup-captcha" data-sitekey="{{env('RE_CAPTCHA_PUBLIC_KEY')}}">
  </div>--}}

  <div class="form-group row" style="width: 100%">

  </div>

  <div id="agreeError" class="registerErrorClass"></div>
  <div class="popup-agree">
    <input type="checkbox" id="agree">
    <label for="agree">{{ __('locale.register.agree') }}
      <a href="{{route('auth.policy',['language' => Config::get('app.locale')])}}" target="_blank">
        {{ __('locale.register.terms_policy') }}

      </a>
    </label>
  </div>
  <div class="popup-submit">
    <input type="button" onclick="registerNewUser()" value="Sign up" class="signup-btn" />
    <button type="button" class="popup-submit-btn">{{ __('locale.register.sign_up') }}</button>
  </div>
  <p class="popup-hasacc">{{ __('locale.register.have_account') }}
    <a href="{{route('auth.login',['language' => Config::get('app.locale')])}}">
      {{ __('locale.register.login') }}
    </a>
  </p>
  </form>
</div>
</div>
<script>
  function registerNewUser() {
    $('.registerErrorClass').html('').show();

    var timezone = moment.tz.guess();
    $('#timezoneUser').val(timezone);

    $.ajax({
      type: "POST",
      url: "{{route('auth.create',['language' => Config::get('app.locale')])}}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        email: $('#email').val(),
        first_name: $('#fName').val(),
        last_name: $('#lName').val(),
        password: $('#password').val(),
        password_confirmation: $('#conpassword').val(),
        timezone: $('#timezoneUser').val(),
        agree: ($('#agree').is(':checked') ? 'on' : 'off'),
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {

      window.location.href = data.redirect_url;

    }).fail(function(data) {
      var result = JSON.parse((data.responseText));

      $.each(result.errors, function(index, value) {
        $('#' + index + 'Error').html('<div style="color: white">' + value[0] + '</div>');
      });

    });

  }
</script>
{{--<script src="{{asset('new/main.js')}}"></script>--}}
