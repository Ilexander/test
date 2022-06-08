<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('admin/css/style.min.css')}}">
</head>

<body>
  <script>
    if (localStorage.getItem('theme') == 'dark') {
      document.querySelector('body').classList.add('_dark-theme');
    }
  </script>
  <div class="tokeId" id="{{csrf_token()}}" ></div>
  <div class="wrapper d-flex">
    <x-nav-bar />
    <section class="new-order section ps-3 pt-lg-3 pt-5 mt-4 mt-lg-0 pb-5 pe-1 pe-lg-3">
      <x-header />
      <div class="new-order__block _section-block mt-4 _tab-section">
        <div class="new-order__block--header _section-block-header p-4 pt-2 pb-2">
          <div class="new-order__block--header-body d-flex justify-content-between align-items-center">
            <h2 class="new-order__title _title ps-2 ps-sm-4">
              New order
            </h2>
            <div class="new-order__tab-nav">
              <ul class="new-order__tab-nav--list _tab-list row justify-content-end ps-0">
                <li class="new-order__tab-nav--item col-auto">
                  <a href="#single-order" class="new-order__tab-nav--link _tab-link _link _active">
                    Single order
                  </a>
                </li>
                <li class="new-order__tab-nav--item col-auto">
                  <a href="#mass-order" class="new-order__tab-nav--link _tab-link _link">
                    Mass order
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="new-order__tab-list ps-0 _tab-wrapper">
          <li class="new-order__tab-item _tab-block _active _fade-in" id="single-order">
            <form action="{{route('user.order.create', ['language' => Config::get('language.current')])}}" class="new-order__form p-2 p-sm-4 pb-3 pt-4" method="POST">
              @csrf
              <div id="singleOrderErrors">
              </div>
              <input type="hidden" name="order_type" value="{{\App\Models\Order::ORDER_TYPE_SINGLE}}">
              <div class="new-order__form--body row justify-content-between">
                <div class="new-order__form--block ps-3 pe-3 col-12 col-md-6">
                  <h3 class="new-order__form--min-title _title _min">
                    Add new
                  </h3>
                  <label class="new-order__form--label pt-3 _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      Category
                    </span>
                    <div class="category__select">
                      <button class="category__button" type="button">Choose a category</button>
                      <ul class="category__list"></ul>
                    </div>
                      <input type="hidden" id="newOrderFormCategoryId" name="category_id">
                    <span class="new-order__form--label-body _form-elem-wrapper" style="display: none;">
                      <span class="new-order__form--icon _form-icon _icon-arrow"></span>
                      <select disabled name="category_id" class="new-order__form--select _form-select" id="orderFormCategoryId">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>

                    </span>
                      @if($errors->has('category_id'))
                          <div class="error" style="color: firebrick">
                              {{$errors->first('category_id')}}
                          </div>
                      @endif
                  </label>
                  <label class="new-order__form--label pt-3 _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      Order service
                    </span>
                    <div class="order__select">
                      <button class="order__button" type="button" disabled>Choose a service</button>
                      <ul class="order__list"></ul>
                    </div>
                      <input type="hidden" id="newOrderFormServiceId" name="service_id">
                    <span class="new-order__form--label-body _form-elem-wrapper" style="display: none;">
                      <span class="new-order__form--icon _form-icon _icon-arrow"></span>
                      <select name="service_id" class="new-order__form--select _form-select" id="orderFormServiceId">
                      </select>

                    </span>
                      @if($errors->has('service_id'))
                          <div class="error" style="color: firebrick">
                              {{$errors->first('service_id')}}
                          </div>
                      @endif
                  </label>
                  <label class="new-order__form--label pt-3 _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      Link
                    </span>
                    <span class="new-order__form--label-body _form-elem-wrapper">
                      <span class="new-order__form--icon _form-icon _icon-close _clear-input-btn"></span>
                      <input id="orderLinkLikes" type="text" name="orderFormLinkLikes" value="" class="new-order__form--input _form-input input__check" >
<!-- 
                      <input style="display: none" id="orderLinkFollowers" type="text" name="orderFormLinkFollowers" value="" class="new-order__form--input _form-input input__check" pattern="(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am|instagr.com)(?!\/p\/)(\/\w+)"> -->
                      <p class="order__error" style="display: none; color: red;">Incorrect link</p>
                         @if($errors->has('link'))
                            <div class="error" style="color: firebrick">
                                {{$errors->first('link')}}
                            </div>
                        @endif
                    </span>
                  </label>
                  <label class="new-order__form--label pt-3 _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      Quantity
                    </span>
                    <span class="new-order__form--label-body _form-elem-wrapper">
                      <span class="new-order__form--icon _form-icon _icon-close _clear-input-btn"></span>
                      <input id="orderFormQuantity" type="number" name="orderFormQuantity" placeholder="min 50" class="new-order__form--input _form-input">
                        @if($errors->has('quantity'))
                            <div class="error" style="color: firebrick">
                                {{$errors->first('quantity')}}
                            </div>
                        @endif
                    </span>
                  </label>
                </div>
                <div class="new-order__form--block ps-3 pe-3 pt-md-0 pt-5 col-12 col-md-6">
                  <h3 class="new-order__form--min-title _title _min">
                    Order resume
                  </h3>
                  <label class="new-order__form--label pt-3 _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      Service name
                    </span>
                    <span class="new-order__form--label-body _form-elem-wrapper">
                      <span class="new-order__form--icon _form-icon  _clear-input-btn"></span>
                      <input type="text" name="service_name" placeholder="min 50" class="new-order__form--input _form-input" id="orderFormServiceName" readonly>
                    </span>
                  </label>
                  <div class="new-order__form--row pt-3 row">
                    <label class="new-order__form--label _form-min-label col-12 mb-3 col-sm-6 col-xl-4">
                      <span class="new-order__form--placeholder _form-placeholder">
                        Minimum Amount
                      </span>
                      <span class="new-order__form--label-body _form-elem-wrapper">
                        <span class="new-order__form--icon _form-icon  _clear-input-btn"></span>
                        <input type="number" name="min-amount" class="new-order__form--input _form-input" id="orderFormServiceMinimumAmount" readonly>
                      </span>
                    </label>
                    <label class="new-order__form--label _form-min-label col-12 mb-3 col-sm-6 col-xl-4">
                      <span class="new-order__form--placeholder _form-placeholder">
                        Maximum Amount
                      </span>
                      <span class="new-order__form--label-body _form-elem-wrapper">
                        <span class="new-order__form--icon _form-icon  _clear-input-btn"></span>
                        <input type="number" name="max-amount" class="new-order__form--input _form-input" id="orderFormServiceMaximumAmount" readonly>
                      </span>
                    </label>
                    <label class="new-order__form--label _form-min-label col-12 mb-3 col-sm-6 col-xl-4">
                      <span class="new-order__form--placeholder _form-placeholder">
                        Price per 1000
                      </span>
                      <span class="new-order__form--label-body _form-elem-wrapper">
                        <span class="new-order__form--icon _form-icon  _clear-input-btn"></span>
                        <input type="number" name="min-amount" class="new-order__form--input _form-input" id="orderFormServicePricePer" readonly>
                      </span>
                    </label>
                  </div>
                  <label class="new-order__form--label _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      Description
                    </span>
                    <span class="new-order__form--label-body _form-elem-wrapper _textarea-wrapper">
                      <span class="new-order__form--icon _form-icon  _clear-input-btn"></span>
                      <textarea name="description" rows="4" id="orderFormServiceDescription" class="new-order__form--textarea _form-textarea" readonly></textarea>
                    </span>
                  </label>
                </div>
                <div class="new-order__form--footer new-order__footer pt-4 mt-5 col-12 _section-block-footer">
                  <div class="new-order__footer--body row justify-content-between align-items-center">
                    <div class="new-order__footer--block d-flex col-12 col-lg-8 align-items-center ps-3">
                      <div class="new-order__footer--total-charge me-4">
                        Total charge:
                        <span class="new-order__footer--total-charge-value" id="orderFormTotalCharge">$50</span>
                      </div>
                      <div class="new-order__footer--checkbox pt-lg-0 pt-4">
                        <input type="checkbox" name="confirmed-check" id="single-order-confirmed" class="new-order__footer--checkbox-input _hidden-checkbox _form-checkbox">
                        <label for="single-order-confirmed" class="new-order__footer--label _form-label-checkbox">
                          Yes, I have confirmed the order!
                        </label>
                      </div>
                    </div>
                    <div class="new-order__footer--block d-flex col-12 col-lg-4 pt-lg-0 pt-4 justify-content-end pe-2 pe-sm-3">
                      <button class="order__footer--submit _btn _large-btn" type="submit">
                        Place order
                      </button>
                    </div>
                  </div>
                    @if($errors->has('confirmed-check'))
                        <div class="error" style="color: firebrick">
                            {{$errors->first('confirmed-check')}}
                        </div>
                    @endif
                </div>
              </div>
            </form>
          </li>
          <li class="new-order__tab-item _tab-block" id="mass-order">
            <form action="{{route('user.order.create', ['language' => Config::get('language.current')])}}" class="new-mass-order__form p-2 p-sm-3" method="POST">
              <input type="hidden" name="order_type" value="{{\App\Models\Order::ORDER_TYPE_MASS}}">
              @csrf
              <div class="new-order__form--body row justify-content-between">

                <div class="new-order__form--block ps-3 pe-3 ps-sm-4 pe-sm-4 col-12 col-md-12">
                  <label class="new-order__form--label pt-3 _form-label">
                    <span class="new-order__form--placeholder _form-placeholder">
                      One order per line in format
                    </span>
                    <span class="new-order__form--label-body _form-elem-wrapper _textarea-wrapper">
                      <span class="new-order__form--icon _form-icon _icon-close _clear-input-btn"></span>
                      <textarea name="mass_order" rows="9" placeholder="service_id|quantity|link" class="new-order__form--textarea _form-textarea"></textarea>
                    </span>
                  </label>
                </div>
                <div class="new-order__form--note ps-3 pe-3 ps-sm-4 pe-sm-4 pt-2 pb-2 col-12">
                  <span class="new-order__form--note-title">
                    Note:
                  </span>
                  <div class="new-order__form--note-message">
                    <p>
                      Here you can place your orders easy! Please make sure you check all the prices and delivery times before you place a order!
                      <span class="new-order__form--note-accent">
                        After a order submited it cannot be canceled.
                      </span>
                    </p>
                  </div>
                </div>
                <div class="new-order__form--footer new-order__footer pt-4 col-12 _section-block-footer">
                  <div class="new-order__footer--body row align-items-center">
                    <div class="new-order__footer--block d-flex align-items-center pb-3 pb-lg-0 ps-4 col-12 col-lg-6">
                      <div class="new-order__footer--checkbox">
                        <input type="checkbox" name="confirmed-check" id="mass-order-confirmed" class="new-order__footer--checkbox-input _hidden-checkbox _form-checkbox">
                        <label for="mass-order-confirmed" class="new-order__footer--label _form-label-checkbox">
                          Yes, I have confirmed the order!
                        </label>
                      </div>
                    </div>
                    <div class="new-order__footer--block col-12 col-lg-6 ps-2 pe-2 ps-md-4 pe-md-4 d-flex justify-content-end">
                      <button class="order__footer--submit _btn _large-btn" type="submit">
                        Place order
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </li>
        </ul>
      </div>

    </section>
  </div>
  <script src="{{asset('admin/js/libs.min.js')}}"></script>
  <script src="{{asset('admin/js/main.min.js')}}"></script>
  <script>

    $('.category__list li').on('click', function () {
        $('#newOrderFormCategoryId').val($(this).val())

        $('#orderLinkLikes').val('');
        $('#orderLinkFollowers').val('');

    })

    function setOrderNewServiceId(selectedServiceId)
    {
        $('#newOrderFormServiceId').val(selectedServiceId)
    }

    $('#orderFormQuantity').keyup(function(e) {
      setTimeout(function() {
        $('#orderFormTotalCharge').html(
            ( $('#orderFormQuantity').val() * $('#orderFormServicePricePer').val() / 1000) + '$'
        )
      }, 10);
    });

    $('#orderFormCategoryId').on('change', function() {
      $('#orderCategoryService').hide();

      $('#orderFormServiceName').val('');
      $('#orderFormServiceMinimumAmount').val('');
      $('#orderFormServiceMaximumAmount').val('');
      $('#orderFormServicePricePer').val('');
      $('#orderFormServiceDescription').val('');

      $.ajax({
        type: "GET",
        url: "{{route('service.list', ['language' => Config::get('language.current')])}}",
        data: {
          "category_id": $(this).val(),
        }
      }).done(function(data) {

        if ($("#orderFormCategoryId option:selected").text() === 'Likes') {
          $('#orderLinkLikes').show();
          $("#orderLinkLikes").prop('disabled', false);
          $('#orderLinkFollowers').hide();
          $("#orderLinkFollowers").prop('disabled', true);
        }

        if ($("#orderFormCategoryId option:selected").text() === 'Followers') {
          $('#orderLinkLikes').hide();
          $("#orderLinkLikes").prop('disabled', true);
          $('#orderLinkFollowers').show();
          $("#orderLinkFollowers").prop('disabled', false);
        }

        var services = '<option value="0">Choose a service</option>';
        $.each(data.data, function(index, value) {
          services += '<option class="test" value="' + value.id + '">' + value.name + '</option>';
        });

        $("#orderFormServiceId").prop('disabled', false);
        $('#orderFormServiceId').html(services);
        $('#orderCategoryService').show();

      });
    });

    $('#orderFormServiceId').on('change', function() {

      $('#orderFormServiceName').val('');
      $('#orderFormServiceMinimumAmount').val('');
      $('#orderFormServiceMaximumAmount').val('');
      $('#orderFormServicePricePer').val('');
      $('#orderFormServiceDescription').val('');

      if ($(this).val() > 0) {
        $.ajax({
          type: "GET",
          url: "{{route('service.info', ['language' => Config::get('language.current')])}}",
          data: {
            id: $(this).val(),
            _token: "{{csrf_token()}}"
          }
        }).done(function(data) {

          $('#orderFormServiceName').val(data.data.name);
          $('#orderFormServiceMinimumAmount').val(data.data.min);
          $('#orderFormServiceMaximumAmount').val(data.data.max);
          $('#orderFormServicePricePer').val(data.data.price);
          $('#orderFormServiceDescription').val(data.data.desc);

        });
      }

    });
  </script>
</body>

</html>
