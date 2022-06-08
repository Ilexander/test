@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="profile__row mt-3">
        <div class="profile__row--body row">
          <div class="profile__wrapper">
              <div class="profile__column col-12 col-xl-6 profile__column--second" style="margin-bottom:  20px;">
                  <div class="profile__block">
                      <div class="profile__block--body _section-block">
                          <div class="profile__block--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                              <div class="profile__block--row _section-panel-active">
                                  <h2 class="profile__block--title _title">
                                      Basic information
                                  </h2>
                                  <div class="profile__block--panel _section-panel">
                                      <div class="_section-panel-body pe-4 me-1">
                                          <p class="_section-panel-link _hide-block-btn me-5 _link">
                                              <span class="_section-panel-icon _icon-arrow _rotate90"></span>
                                          </p>
                                          <p class="_section-panel-link _remove-block-btn ms-3 _link">
                                              <span class="_section-panel-icon _icon-close"></span>
                                          </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <form action="{{route('user.profile.update', ['language' => Config::get('language.current')])}}" method="POST" class="profile__block--form profile__form">
                              @csrf
                              @if ($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <div class="error" style="color: firebrick">{{$error}}</div>
                                  @endforeach
                              @endif
                              <input type="hidden" name="id" value="{{$user->id}}">
                              <div class="profile__form--body ps-2 pe-2 pe-sm-4 ps-sm-4">
                                  <div class="profile__form--row">
                                      <div class="profile__form--row-body row">
                                          <label class="profile__form--label pt-3 _form-label col-12 col-sm-6">
                                          <span class="profile__form--placeholder _form-placeholder">
                                              First name
                                          </span>
                                              <span class="profile__form--label-body _form-elem-wrapper">
                                              <span class="profile__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                              <input type="text" value="{{mb_substr($user->first_name, 0, 100)}}" name="first_name" class="profile__form--input _form-input">
                                          </span>
                                          </label>
                                          <label class="profile__form--label pt-3 _form-label col-12 col-sm-6">
                                          <span class="profile__form--placeholder _form-placeholder">
                                              Last name
                                          </span>
                                              <span class="profile__form--label-body _form-elem-wrapper">
                                              <span class="profile__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                              <input type="text" value="{{mb_substr($user->last_name, 0, 100)}}" name="last_name" class="profile__form--input _form-input">
                                          </span>
                                          </label>
                                      </div>
                                  </div>
                                  <label class="profile__form--label pt-3 _form-label">
                                  <span class="profile__form--placeholder _form-placeholder">
                                      Email
                                  </span>
                                      <span class="profile__form--label-body _form-elem-wrapper">
                                      <span class="profile__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                      <input type="email" name="email" value="{{mb_substr($user->email, 0, 100)}}" class="profile__form--input _form-input">
                                  </span>
                                  </label>
                                  <div class="profile__form--row">
                                      <div class="profile__form--row-body row" style="align-items: end">
                                          <label class="profile__form--label pt-4 _form-label col-12 col-sm-6">
                                          <button class="btn change-pass" type="button" style="width:40%; font-size: 12px;">Change password</button>
                                          <span class="profile__form--placeholder _form-placeholder _form-label-closed" data-profilepass="true">
                                              Password
                                          </span>
                                              <span class="profile__form--label-body _form-elem-wrapper">
                                              <span class="profile__form--icon _form-icon _icon-close _clear-input-btn _form-clear-closed" data-profilepass="true"></span>
                                              <input type="password" name="change_password" class="profile__form--input _form-input _form-input-password" data-profilepass="true" disabled>
                                          </span>
                                          </label>
                                          <label class="profile__form--label pt-4 _form-label col-12 col-sm-6">
                                          <span class="profile__form--placeholder _form-placeholder _form-label-closed" data-profilepass="true">
                                              Confirm Password
                                          </span>
                                              <span class="profile__form--label-body _form-elem-wrapper">
                                              <span class="profile__form--icon _form-icon _icon-close _clear-input-btn _form-clear-closed" data-profilepass="true"></span>
                                              <input type="password" name="change_password_confirmation" class="profile__form--input _form-input _form-input-password" data-profilepass="true" disabled>
                                          </span>
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="profile__form--footer d-flex justify-content-end _section-block-footer p-4 pb-4">
                                  <button class="profile__form--submit _btn _large-btn" type="submit">
                                      Save
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="profile__column col-12 col-xl-6 profile__column--second">
                  <div class="users-inside__block--body _section-block">
                      <div class="users-inside__block--header _section-block-header ps-4 pe-2 pb-1 pt-1">
                          <div class="users-inside__block--row _section-panel-active">
                              <h2 class="users-inside__block--title _title ps-2">
                                  More information
                              </h2>
                              <div class="users-inside__block--panel _section-panel">
                                  <div class="_section-panel-body pe-4 me-1">
                                      <a href="#" class="_section-panel-link _hide-block-btn me-5 _link">

                                      </a>
                                      <a href="#" class="_section-panel-link _remove-block-btn ms-3 _link">

                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <form
                          action="{{route('user.profile.update', ['language' => Config::get('language.current'), 'user' => $user->id])}}"
                          class="users-inside__block--form users-inside__form"
                          method="POST"
                      >
                          @csrf
                          {{--                        <input type="hidden" name="_method" value="PUT" />--}}
                          <input type="hidden" name="id" value="{{$user->id}}" />
                          <div class="users-inside__form--body p-3 ps-4 pe-4">
                              <div class="users-inside__form--row row ps-2 pe-2">
                                  <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                  <span class="users-inside__form--placeholder _form-placeholder">
                                      Website
                                  </span>
                                      <span class="users-inside__form--label-body _form-elem-wrapper">
                                      <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                      <input
                                          type="text"
                                          name="more_information[website]"
                                          value="{{$user_more_information['website'] ?? ''}}"
                                          placeholder="" class="users-inside__form--input _form-input"
                                      >
                                  </span>
                                  </label>
                                  <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                  <span class="users-inside__form--placeholder _form-placeholder">
                                      Phone
                                  </span>
                                      <span class="users-inside__form--label-body _form-elem-wrapper">
                                      <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                      <input
                                          type="tel"
                                          name="more_information[phone]"
                                          placeholder=""
                                          value="{{$user_more_information['phone'] ?? ''}}"
                                          class="users-inside__form--input _form-input"
                                      >
                                  </span>
                                  </label>
                              </div>
                              <label class="users-inside__form--label pt-3 ps-2 pe-2 _form-label">
                              <span class="users-inside__form--placeholder _form-placeholder">
                                  Skype
                              </span>
                                  <span class="users-inside__form--label-body _form-elem-wrapper">
                                  <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                  <input
                                      type="text"
                                      name="more_information[skype]"
                                      value="{{$user_more_information['skype'] ?? ''}}"
                                      placeholder="" class="users-inside__form--input _form-input"
                                  >
                              </span>
                              </label>
                              <div class="users-inside__form--row row ps-2 pe-2">
                                  <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                  <span class="users-inside__form--placeholder _form-placeholder">
                                      Address
                                  </span>
                                      <span class="users-inside__form--label-body _form-elem-wrapper">
                                      <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                      <input
                                          type="text"
                                          name="more_information[address]"
                                          placeholder=""
                                          value="{{$user_more_information['address'] ?? ''}}"
                                          class="users-inside__form--input _form-input"
                                      >
                                  </span>
                                  </label>
                                  <label class="users-inside__form--label pt-3 _form-label col-12 col-sm-6">
                                  <span class="users-inside__form--placeholder _form-placeholder">
                                      WhatsApp Number
                                  </span>
                                      <span class="users-inside__form--label-body _form-elem-wrapper">
                                      <span class="users-inside__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                      <input
                                          type="text"
                                          name="more_information[whatsapp_number]"
                                          value="{{$user_more_information['whatsapp_number'] ?? ''}}"
                                          placeholder="" class="users-inside__form--input _form-input"
                                      >
                                  </span>
                                  </label>
                                  <div class="users-inside__form--note col-12 col-sm-6 pt-2 _pink _fs-12">
                                      Note: If you don't want add more information then leave these informations fields empty!
                                  </div>
                              </div>
                          </div>
                          <div class="users-inside__form--footer _section-block-footer ps-4 pe-4 pt-4 pb-3 d-flex justify-content-end">
                              <button class="users-inside__form--submit _btn _large-btn">
                                  Save
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
              <div class="profile__column col-12 col-xl-6 mt-xl-0">
                  <div class="profile__block">
                      <div class="profile__block--body _section-block">
                          <div class="profile__block--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                              <div class="profile__block--row _section-panel-active">
                                  <h2 class="profile__block--title _title">
                                      Your profile info
                                  </h2>
                                  <div class="profile__block--panel _section-panel">
                                      <div class="_section-panel-body pe-4 me-1">
                                          <p class="_section-panel-link _hide-block-btn me-5 _link">
                                              <span class="_section-panel-icon _icon-arrow _rotate90"></span>
                                          </p>
                                          <p class="_section-panel-link _remove-block-btn ms-3 _link">
                                              <span class="_section-panel-icon _icon-close"></span>
                                          </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="profile__block--row p-2 p-sm-4 pt-3 pb-2">
                              <div class="profile__block--row-body row align-items-center justify-content-sm-start justify-content-center">
                                  <div class="profile__avatar col-auto col-sm-auto me-4 col-lg-2">
                                      <div class="profile__avatar--image">
                                          <p class="profile__avatar--body">
                                              <img
                                                  src="{{(!$user->image_file || $user->image_file == '') ? asset('admin/img/user/avatar.png') : $user->image_file}}"
                                                  width="96" height="96" alt="" class="profile__avatar--img">
                                              <span class="profile__avatar--text">
                                              edit
                                          </span>
                                          </p>
                                      </div>
                                  </div>

                                  <div class="profile__info col-auto mt-4 mb-4">
                                      <h1 class="profile__info--name mb-0">
                                          {{mb_substr($user->first_name, 0, 100)}} {{mb_substr($user->last_name, 0, 100)}}
                                      </h1>
                                      <span class="profile__info--email">
                                          {{mb_substr($user->email, 0, 100)}}
                                  </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="profile__block">
                      <div class="profile__block--body _section-block">
                          <div class="profile__block--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                              <div class="profile__block--row _section-panel-active">
                                  <h2 class="profile__block--title _title">
                                      Your API key
                                  </h2>
                                  <div class="profile__block--panel _section-panel">
                                      <div class="_section-panel-body pe-4 me-1">
                                          <p class="_section-panel-link _hide-block-btn me-5 _link">
                                              <span class="_section-panel-icon _icon-arrow _rotate90"></span>
                                          </p>
                                          <p class="_section-panel-link _remove-block-btn ms-3 _link">
                                              <span class="_section-panel-icon _icon-close"></span>
                                          </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="profile__api-key--body p-2 p-sm-4">
                              <label class="profile__api-key--label pt-3 _form-label">
                              <span class="profile__api-key--placeholder _form-placeholder">
                                  Key
                              </span>
                                  <span class="profile__api-key--label-body _form-elem-wrapper">
                                  <span class="profile__api-key--icon _form-icon _icon-close _clear-input-btn"></span>
                                  <input type="text" name="api-key" value="y6gbqAsQK6hLXhNETvIV5bPEf8nBPvQo" placeholder="Placeholder" class="profile__api-key--input _form-input">
                              </span>
                              </label>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
    </div>

    <script>

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "block";
            (function fade() {
                var val = parseFloat(el.style.opacity);
                if (!((val += .1) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        };

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= .1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        };

        //themes
        if(localStorage.getItem('theme') == 'dark') {
            document.querySelector('body').classList.add('_dark-theme');
        }

        //prevent this link from doing anything
        let deadLink = document.querySelector(".profile__avatar--body");
        deadLink.addEventListener("click", function(e) {
            e.preventDefault();
        });

        //avatar form toggle
        let avatarImg = document.querySelector(".profile__avatar--image");
        avatarImg.addEventListener("click", function() {
            var avatarFormItems = document.querySelectorAll(".avatar-form");
            if(avatarFormItems.length >= 1) return;
            var avatarForm = document.createElement('div');
            avatarForm.classList.add("avatar-form");
            avatarForm.innerHTML = `<div class="profile__form-avatar">
               <form method="POST" enctype="multipart/form-data" action="{{route('user.profile.update', ['language' => Config::get('language.current')])}}" class="profile__set-avatar">
                   @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="set-avatar-header">Choose profile picture:</div>
                    <div class="input-group mb-3">
                        <input type="file" name="avatar" class="form-control set-avatar-input" id="set-avatar">
                        <button class="btn btn-outline-secondary set-avatar-upload" type="submit">Upload</button>
                    </div>
                </form>
            </div>`;
            var imgSection = document.querySelectorAll(".profile__block--body._section-block");
            imgSection[1].appendChild(avatarForm);
            fadeIn(avatarForm);

        })

        const toggleOpen = (e) => {

            let target = e.target,
                contentBlock = target.closest(".profile__block--body");

            if(contentBlock.classList.contains("disabled")) {
                contentBlock.classList.remove("disabled");
            } else {
                contentBlock.classList.add("disabled");
            }

        }

        const closeBlock = (e) => {

            let target = e.target,
                neighborInput;

            try {
                neighborInput = target.closest(".profile__form--label-body").querySelector(".profile__form--input");
            } catch (error) {
                neighborInput = "";
            }
            if(neighborInput) {
                neighborInput.value = "";
                neighborInput.setAttribute("value", "");
            } else {
                let contentBlock = target.closest(".profile__block--body"),
                    allInputs = contentBlock.querySelectorAll(".profile__form--input");
                for(let i = 0; i < allInputs.length - 1; i++) {
                    allInputs[i].value = "";
                }
            }
        }

        let togglers = document.querySelectorAll("._icon-arrow");
        for(let i = 0; i < togglers.length; i++) {
            togglers[i].addEventListener("click", toggleOpen);
        }

        let closers = document.querySelectorAll("._icon-close");
        for(let i = 0; i < closers.length; i++) {
            closers[i].addEventListener("click", closeBlock);
        }

        let passwordInputs = document.querySelectorAll("[data-profilepass]"),
            changePassBtn = document.querySelector(".change-pass");
        changePassBtn.addEventListener("click", () => {
            for(let i = 0; i < passwordInputs.length; i++) {
                passwordInputs[i].removeAttribute("disabled");
                passwordInputs[i].style.display = "block";
            }
        });

    </script>
@stop
