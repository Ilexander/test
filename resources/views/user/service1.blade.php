@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

<div class="add-service">
  <form method="POST" action="#" id="serviceCreateForm">
    @csrf
    <div class="add-service-header-block">
      <div class="add-service-header" id="serviceFormLabel">{{ __('locale.service.form.edit_service') }}</div>
      <div class="add-service-close">
        <div class="cross"></div>
      </div>
      <div id="serviceFormMethod"></div>
      <div id="serviceFormServiceId"></div>
    </div>
    <hr>
    <div class="input-group mt-2">
      <label for="pkgname" style="width: 100%">{{ __('locale.service.form.package_name') }}</label>
      <input type="text" name="name" class="form-control" id="pkgname" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mt-2">
      <label for="pkgcat" style="width: 100%">{{ __('locale.service.form.choose_a_category') }}</label>
      <select class="form-select" id="pkgcat" name="category_id">
        @foreach($categories as $category)
        <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="input-group mt-2">
      <div class="input-group-text">
        <label for="api" style="padding-right: 6px">{{ __('locale.service.form.api') }}</label>
        <input class="form-check-input" type="radio" value="api" id="api" name="add_type" onclick="showServiceProviders()">
      </div>
      <div class="input-group-text ">
        <label for="manual" style="padding-right: 6px">{{ __('locale.service.form.manual') }}</label>
        <input class="form-check-input" type="radio" value="manual" id="manual" name="add_type">
      </div>
    </div>
    <div class="input-group mt-2" id="api-selected">
      <label for="api-provider" style="width: 100%">{{ __('locale.service.form.api_provider_name') }}</label>
      <select class="form-select" id="api-provider" name="api_provider_id" style="width:100%">
        <option selected disabled>{{ __('locale.service.form.choose_an_api_provider') }}</option>
        @foreach($providers as $provider)
        <option value="{{$provider->id}}">{{$provider->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="input-group mt-2" id="api-service-selected" style="width: 100%; display: none">
      <div class="mb-1 providers-group">
        <label class="form-label" for="basic-icon-default-fullname">{{ __('locale.service.form.list_of_api_services') }}</label>
        <select style="width: 100%" class="select2 form-select form-control" id="serviceFormApiProviderServices" name="api_service_id">
        </select>
      </div>
      <div class="mb-1">
        <label class="form-label" for="basic-icon-default-fullname">{{ __('locale.service.form.original_price') }}</label>
        <input type="number" step="0.0001" class="form-control dt-full-name" id="serviceFormOriginalPrice" placeholder="Service Original Price" name="original_price" />
      </div>
    </div>
    <div class="input-group mt-2 d-flex justify-content-between active" id="manual-selected">
      <div style="width: 45%">
        <label for="service-type">{{ __('locale.service.form.service_type.service_type') }}</label>
        <select class="form-select" name="manual_service_id" id="service-type">
          <option value="default" selected>{{ __('locale.service.form.service_type.default') }}</option>
          <option value="subscriptions">{{ __('locale.service.form.service_type.subscriptions') }}</option>
          <option value="ccoments">{{ __('locale.service.form.service_type.custom_comments') }}</option>
          <option value="ccoments-pkg">{{ __('locale.service.form.service_type.custom_comments_package') }}</option>
          <option value="hashtags">{{ __('locale.service.form.service_type.mentions_with_hashtags') }}</option>
          <option value="clists">{{ __('locale.service.form.service_type.mentions_custom_lists') }}</option>
          <option value="hashtags-m">{{ __('locale.service.form.service_type.mentions_hashtag') }}</option>
          <option value="iser-f">{{ __('locale.service.form.service_type.mentions_user_followers') }}</option>
          <option value="mkillers">{{ __('locale.service.form.service_type.mentions_media_killers') }}</option>
          <option value="pkg">{{ __('locale.service.form.service_type.package') }}</option>
          <option value="clikes">{{ __('locale.service.form.service_type.comment_likes') }}</option>
        </select>
      </div>
      <div style="width: 45%">
        <label for="drip-feed">{{ __('locale.service.form.drip_feed') }}</label>
        <select class="form-select" id="drip-feed">
          <option value="deactive" selected>{{ __('locale.service.form.deactive') }}</option>
          <option value="active">{{ __('locale.service.form.active') }}</option>
        </select>
      </div>
    </div>
    <div class="d-flex justify-content-between mt-2">
      <div class="input-group" style="width: 30%">
        <label for="minamt" style="width: 100%">{{ __('locale.service.form.minimum_amount') }}</label>
        <input class="form-control" type="number" id="minamt" name="min" readonly placeholder="50">
      </div>
      <div class="input-group" style="width: 30%">
        <label for="maxamt" style="width: 100%">{{ __('locale.service.form.maximum_amount') }}</label>
        <input class="form-control" type="number" id="maxamt" name="max" readonly placeholder="20000">
      </div>
      <div class="input-group" style="width: 30%">
        <label for="rate" style="width: 100%">{{ __('locale.service.form.rate_per_1000') }}</label>
        <input class="form-control" type="number" id="rate" name="price" placeholder="0.80">
      </div>
    </div>
    <div class="input-group mt-2">
      <label for="status" style="width: 100%">Status{{ __('locale.service.form.status') }}</label>
      <select class="form-select" id="status" name="status">
        <option value="true" selected>{{ __('locale.service.form.active') }}</option>
        <option value="false">{{ __('locale.service.form.deactive') }}</option>
      </select>
    </div>
    <div class="tarea-header mt-2">{{ __('locale.service.form.description') }}</div>
    <div class="form-floating mt-2">
      <textarea class="form-control" name="desc" id="descr"></textarea>
    </div>
    <input type="hidden" class="form-control dt-full-name" id="serviceFormType" placeholder="Service Type" name="type" />
    <div class="add-service-buttons mt-2">
      <button type="button" class="btn btn-info me-3 mt-2">{{ __('locale.service.form.add_new_service_via_api') }}</button>
      <button type="submit" class="btn btn-success me-3 mt-2">{{ __('locale.service.form.submit') }}</button>
      <div class="btn btn-danger me-3 mt-2" onclick="clearForm()">
        {{ __('locale.service.form.cancel') }}
      </div>
    </div>
  </form>
</div>
<div class="services-sort">
  <div class="services-sort-header">Sort by</div>
  <div class="services__wrapper">
    @foreach($categories as $category)
    <a class="services-sort-{{strtolower($category->name)}}" href="#{{$category->name}}">
      <div class="icon-{{strtolower($category->name)}}"></div>
      <div class="icon-text">{{$category->name}}</div>
    </a>
    @endforeach
  </div>
</div>
@if(! \Illuminate\Support\Facades\Auth::user()->isAdmin())
@foreach($categories as $category)
<div class="services__projects mt-3" id="{{$category->name}}">
  <div class="services__projects--body _section-block">
    <div class="services__projects--header _section-block-header">
      <h2 class="services__projects--title _title ps-4 pt-2 pb-2 ms-3">
        <span class="services__projects--icon me-3 _icon-followers"></span>
        {{$category->name}}
      </h2>
    </div>
    @if($category->services->count() > 0)
    <div class="services__projects--block project-block pt-4">
      <div class="services__projects--body _scrollbar-styles">
        <div class="services__projects--info project-block__info ps-3 pe-3">
          <div class="project-block__param _id">
            {{ __('locale.service.user_table.id') }}
          </div>
          <div class="project-block__param _name ps-4 pe-4">
            {{ __('locale.service.user_table.name') }}
          </div>
          <div class="project-block__param _rate ms-4 me-4">
            {{ __('locale.service.user_table.rate_per_1000') }}
          </div>
          <div class="project-block__param _min-max ms-4 me-4">
            {{ __('locale.service.user_table.min_max_order') }}
          </div>
          <div class="project-block__param _descr ms-4 me-4">
            {{ __('locale.service.user_table.description') }}
          </div>
        </div>


        <ul class="list" style="display: none;">
          @foreach($services as $service)
          @if($service->category_id === $category->id)
          <li class="list__item">
            <h3 class="list__title">{{$service->name}}</h3>
            <p class="list__text list__id">Id: <span>{{$service->id}}</span></p>
            <p class="list__text">Rate per 1000($): <span>{{$service->price}}</span></p>
            <p class="list__text">Min: <span>{{$service->min}}</span></p>
            <p class="list__text">Max: <span>{{$service->max}}</span></p>
            <div class="project-block__item--detail ms-4 me-4 col-2">
              <a href="#project-popup-{{$service->id}}" class="project-block__item--btn _btn _btn-popup">
                {{ __('locale.service.user_table.details') }}
              </a>
            </div>
            <!--onclick="showDetails({{$service->id}})" -->
          </li>
          @endif
          @endforeach
          <tr>
          </tr>
        </ul>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <ul class="services__projects--list project-block__list">
          @foreach($services as $service)
          @if($service->category_id === $category->id)
          <li class="statistics__projects--item project-block__item p-3 pt-2 pb-2">
            <div class="project-block__item--body row align-items-center">
              <div class="project-block__item--id col-2">
                {{$service->id}}
              </div>
              <div class="project-block__item--name ps-3 pe-4 col">
                {{$service->name}}
              </div>
              <div class="project-block__item--value value-price _rate ms-4 me-4 col-1">
                ${{$service->price}}
              </div>
              <div class="project-block__item--value _min-max ms-4 me-4 col-1">
                ${{$service->min}} / ${{$service->max}}
              </div>
              <div class="project-block__item--detail ms-4 me-4 col-2">
                <a href="#project-popup-{{$service->id}}" class="project-block__item--btn _btn _btn-popup">
                  {{ __('locale.service.user_table.details') }}
                </a>
              </div>
            </div>
          </li>
          <div class="project-block__popup _popup" id="project-popup-{{$service->id}}">
            <div class="_popup-wrapper">
              <div class="project-block__popup--bg _popup-bg"></div>
              <div class="project-block__popup--body _popup-body">
                <button type="button" class="project-block__popup--close-btn _popup-close-btn">
                  ✕
                </button>
                <h2 class="project-block__popup--title _title text-center _popup-title">
                  {{$service->name}}
                </h2>
                <div class="project-block__popup--content">
                  <ul>
                    <li>
                      NOT BOT | Instagram likes
                    </li>
                    <li> Always stable</li>
                    <li>Max: 300k</li>
                    <li>Speed: 500-4000/h</li>
                    <li>Extra delivery: 10%</li>
                    <li><b>INSTANT</b> Delivery</li>
                    <li>All have avatar</li>
                    <li>All have min 2 posts</li>
                  </ul>
                  <div class="popup__wrapper">
                    <button class="popup__btn popup__order">Make order</button>
                    <button class="popup__btn popup__close">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </ul>
      </div>
    </div>
    @endif
  </div>
</div>
@endforeach
@endif

@if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
<div class="category__block mt-3">
  <div class="category__block--body _section-block">
    <div class="category__block__header _section-block-header p-2 ps-md-4">
      <div class="category__block__header--row row justify-content-between">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="error" style="color: firebrick">{{$error}}</div>
        @endforeach
        @endif
        <h2 class="category__block--title _title col-auto ps-4">
          {{ __('locale.service.list') }}
          <div onclick="addNewService()" class="category__block--add" style="display: inline-block; color:blue; text-decoration:none; margin-left: 10px; font-size:20px;">+ {{ __('locale.service.add_new') }} </div>
        </h2>
        <div class="category__block--action action-block col-auto">
          <div class="action-block__body _sub-parent">
            <button type="button" class="action-block__btn _btn _alt _sub-open">
              <span class="action-block__btn--icon _icon-burger"></span>
              {{ __('locale.service.action.action') }}
              <span class="action-block__btn--icon _icon-arrow"></span>
            </button>
            <ul class="action-block__sub-list ps-0 pt-2 pb-2 m-0 _sub-list">
              <li class="action-block__sub-list--li" onclick="deleteItem()">
                <button type="button" class="action-block__sub-list--btn _link">
                  <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.00176 11.9844H9.99824L10.3291 4.98438H3.6709L4.00176 11.9844Z" fill="#EB5757" fill-opacity="0.15" />
                    <path d="M11.8125 4H10.0625V2.90625C10.0625 2.42363 9.67012 2.03125 9.1875 2.03125H4.8125C4.32988 2.03125 3.9375 2.42363 3.9375 2.90625V4H2.1875C1.94551 4 1.75 4.19551 1.75 4.4375V4.875C1.75 4.93516 1.79922 4.98438 1.85938 4.98438H2.68516L3.02285 12.1348C3.04473 12.601 3.43027 12.9688 3.89648 12.9688H10.1035C10.5711 12.9688 10.9553 12.6023 10.9771 12.1348L11.3148 4.98438H12.1406C12.2008 4.98438 12.25 4.93516 12.25 4.875V4.4375C12.25 4.19551 12.0545 4 11.8125 4ZM4.92188 3.01562H9.07812V4H4.92188V3.01562ZM9.99824 11.9844H4.00176L3.6709 4.98438H10.3291L9.99824 11.9844Z" fill="#EB5757" />
                  </svg>
                  {{ __('locale.service.action.delete') }}
                </button>
              </li>
              <li class="action-block__sub-list--li" onclick="deleteDeactivatedItem()">
                <button type="button" class="action-block__sub-list--btn _link">
                  <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.00176 11.9844H9.99824L10.3291 4.98438H3.6709L4.00176 11.9844Z" fill="#EB5757" fill-opacity="0.15" />
                    <path d="M11.8125 4H10.0625V2.90625C10.0625 2.42363 9.67012 2.03125 9.1875 2.03125H4.8125C4.32988 2.03125 3.9375 2.42363 3.9375 2.90625V4H2.1875C1.94551 4 1.75 4.19551 1.75 4.4375V4.875C1.75 4.93516 1.79922 4.98438 1.85938 4.98438H2.68516L3.02285 12.1348C3.04473 12.601 3.43027 12.9688 3.89648 12.9688H10.1035C10.5711 12.9688 10.9553 12.6023 10.9771 12.1348L11.3148 4.98438H12.1406C12.2008 4.98438 12.25 4.93516 12.25 4.875V4.4375C12.25 4.19551 12.0545 4 11.8125 4ZM4.92188 3.01562H9.07812V4H4.92188V3.01562ZM9.99824 11.9844H4.00176L3.6709 4.98438H10.3291L9.99824 11.9844Z" fill="#EB5757" />
                  </svg>
                  {{ __('locale.service.action.all_deactivated_categories') }}
                </button>
              </li>
              <li class="action-block__sub-list--li" onclick="setItemStatus(false)">
                <button type="button" class="action-block__sub-list--btn _link">
                  <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.83995 9.67383H5.64522C5.70948 9.67383 5.771 9.64512 5.81338 9.5959L7.0001 8.18086L8.18681 9.5959C8.22782 9.64512 8.28935 9.67383 8.35497 9.67383H9.16024C9.25321 9.67383 9.30379 9.56582 9.24364 9.49473L7.57158 7.5L9.24501 5.50527C9.30516 5.43418 9.25458 5.32617 9.16161 5.32617H8.35634C8.29208 5.32617 8.23056 5.35488 8.18818 5.4041L7.0001 6.81914L5.81338 5.4041C5.77237 5.35488 5.71085 5.32617 5.64522 5.32617H4.83995C4.74698 5.32617 4.6964 5.43418 4.75655 5.50527L6.42862 7.5L4.75655 9.49473C4.74308 9.51057 4.73443 9.52995 4.73165 9.55057C4.72886 9.57118 4.73204 9.59216 4.74082 9.61102C4.7496 9.62988 4.76361 9.64582 4.78118 9.65695C4.79875 9.66809 4.81915 9.67394 4.83995 9.67383Z" fill="#EB5757" />
                    <path d="M12.0312 2.03125H1.96875C1.72676 2.03125 1.53125 2.22676 1.53125 2.46875V12.5312C1.53125 12.7732 1.72676 12.9688 1.96875 12.9688H12.0312C12.2732 12.9688 12.4688 12.7732 12.4688 12.5312V2.46875C12.4688 2.22676 12.2732 2.03125 12.0312 2.03125ZM11.4844 11.9844H2.51562V3.01562H11.4844V11.9844Z" fill="#EB5757" />
                  </svg>
                  {{ __('locale.service.action.deactive') }}
                </button>
              </li>
              <li class="action-block__sub-list--li" onclick="setItemStatus(true)">
                <button type="button" class="action-block__sub-list--btn _link">
                  <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.91667 1.25H3.08333C1.79467 1.25 0.75 2.29467 0.75 3.58333V9.41667C0.75 10.7053 1.79467 11.75 3.08333 11.75H8.91667C10.2053 11.75 11.25 10.7053 11.25 9.41667V3.58333C11.25 2.29467 10.2053 1.25 8.91667 1.25Z" stroke="#219653" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4.25 6.49992L5.5625 7.66659L7.75 5.33325" stroke="#219653" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  {{ __('locale.service.action.active') }}
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <form action="#" class="category__block--wrapper _scrollbar-styles overflow-x-auto">
      <table class="category__block--table category__table _table">
        <colgroup>
          <col class="category__table--col-1">
          <col class="category__table--col-2">
          <col class="category__table--col-3">
          <col class="category__table--col-4">
          <col class="category__table--col-5">
          <col class="category__table--col-6">
          <col class="category__table--col-7">
        </colgroup>
        <thead>
          <tr>
            <th class="">
              <div class="category__table--checkbox ps-3 _table-parent-check-all-checkbox">
                <input type="checkbox" name="category-checkbox-all" id="category-all" class="category__table--checkbox-input _hidden-checkbox _form-checkbox">
                <label for="category-all" class="category__table--label _form-label-checkbox _min mt-3 mb-2 _table-check-all-checkbox"></label>
              </div>
            </th>
            <th class="">
              <div class="service-header-cell">{{ __('locale.service.table.no') }}</div>
            </th>
            <th class="">
              <div class="service-header-cell">{{ __('locale.service.table.name') }}</div>
            </th>
            <th class="">
              <div class="service-header-cell">{{ __('locale.service.table.description') }}</div>
            </th>
            <th class="">
              <div class="service-header-cell">{{ __('locale.service.table.sort') }}</div>
            </th>
            <th class="">
              <div class="service-header-cell">{{ __('locale.service.table.status') }}</div>
            </th>
            <th class=" text-center">
              <div class="service-header-cell">{{ __('locale.service.table.action') }}</div>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($services as $service)
          <tr id="service-{{$service->id}}" class="category-item">
            <td class="p-3 pb-4 pt-4">
              <div class="category__table--checkbox ps-3 mb-2">
                <input type="checkbox" name="category-checkbox-{{$service->id}}" id="category-{{$service->id}}" value="{{$service->id}}" class="category__table--checkbox-input _hidden-checkbox _form-checkbox">
                <label for="category-{{$service->id}}" class="category__table--label _form-label-checkbox _min"></label>
              </div>
            </td>
            <td class="pb-4 pt-4 fw-bold category-item-id">
              {{$service->id}}
            </td>
            <td class="pb-4 pt-4 category-item-name">
              <div class="service-big">{{$service->name}}</div>
            </td>
            <td class="pb-4 pt-4 category-item-descr">
              <div class="service-big">{{$service->desc}}</div>
            </td>
            <td class="pb-4 pt-4 category-item-sort">
              <div class="service-small">1</div>
            </td>
            <td class="pb-4 pt-4 category-item-status">
              <span class="category__table--status p-2 _status-{{$service->status}} service-small">
                @if($service->status)
                ✔️
                @else
                ❌
                @endif

              </span>
            </td>
            <td class="pb-4 pt-4 text-center _sub-parent _edit-cell">
              <a href="#" class="category__table--link _link">
                <span class="category__table--link-icon _icon-details _sub-open"></span>
              </a>
              <ul class="users__action--sub-list _sub-list">
                <li class="users__action--sub-item">
                  <a href="#" style="color: black; text-decoration: none" onclick="editService({{$service->id}})" {{--                                                class="category__block--add"--}} class="users__action--sub-link _link-edit">
                    <span class="users__action--sub-icon _icon-edit-alt"></span>
                    {{ __('locale.service.table.edit') }}
                  </a>
                </li>
                <li class="users__action--sub-item">
                  <a href="#" class="users__action--sub-link _link _link-del">
                    <span class="users__action--sub-icon _icon-trash"></span>
                    {{ __('locale.service.table.delete') }}
                  </a>
                </li>
              </ul>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </form>
  </div>
</div>
@endif
@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
  function clearForm() {
    $('#pkgname').val('');
    $('#descr').val('');
    $('#rate').val('');
    $('#serviceFormOriginalPrice').val('');
    $('#minamt').val('');
    $('#maxamt').val('');

    $('#api-selected').hide();
    $('#api-service-selected').hide();
  }

  function showServiceProviders() {
    $('#api-selected').show();
  }

  function editService(serviceId) {
    $('#serviceFormLabel').html('{{ __('
      locale.service.form.edit_service ') }}');
    $('#serviceFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
    $('#serviceFormServiceId').html('<input type="hidden" name="id" value="' + serviceId + '" />');
    $('#serviceCreateForm').attr('action', '{{route('
      admin.service.update ', ['
      language ' => Config::get('
      language.current ')])}}');

    $.ajax({
      type: "GET",
      url: "{{route('admin.service.info', ['language' => Config::get('language.current')])}}",
      data: {
        id: serviceId,
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {

      console.log(data);

      $('#pkgname').val(data.data.name);
      $('#descr').val(data.data.desc);
      $('#rate').val(data.data.price);
      $('#serviceFormOriginalPrice').val(data.data.original_price);
      $('#minamt').val(data.data.min);
      $('#maxamt').val(data.data.max);


      $('#pkgcat option').each(function() {
        if ($(this).val() == data.data.category_id) {
          $("#pkgcat").val($(this).val()).trigger('change');
        }
      });

      $('#status option').each(function() {
        if ($(this).val() === Boolean(Number(data.data.status)).toString()) {
          $("#status").val($(this).val()).trigger('change');
        }
      });

      if (data.data.add_type === "manual") {
        $('#api-service-selected').hide();
        $('#api-selected').hide();
        apiSelected.classList.add("active");
      }

      if (data.data.add_type === "api") {
        $("#api").prop('checked', true);
        $('#api-service-selected').show();
        $('#api-selected').show();
      }

      $('#api-provider option').each(function() {
        if ($(this).val() == data.data.api_provider_id) {
          $("#api-provider").val($(this).val()).trigger('change');
        }
      });

      setProviderServiceSelector(data.data.api_provider_id, data.data.api_service_id);

    });
  }


  function setProviderServiceSelector(ApiProviderId, ServiceId) {
    $.ajax({
      type: "GET",
      url: "{{route('admin.api-provider.services', ['language' => Config::get('language.current')])}}",
      data: {
        id: ApiProviderId,
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {

      var result = '';

      if (typeof data.data.data !== 'undefined') {
        result = data.data.data;
      } else {
        result = data.data;
      }

      var services = '';
      var i = 0;

      $.each(result, function(index, value) {

        services += '<option ' +
          'value="' + value.service + '" ' +
          'data-min="' + value.min + '" ' +
          'data-max="' + value.max + '" ' +
          'data-rate="' + value.rate + '" ' +
          'data-type="' + value.type + '" ';

        if (value.service == ServiceId) {
          services += ' selected ';
        }

        services += '>' + value.name + '</option>';

        if (i === 0) {
          $('#serviceFormMin').val(value.min);
          $('#serviceFormMax').val(value.max);
          $('#serviceFormOriginalPrice').val(value.rate);
          $('#serviceFormType').val(value.type);

          i++;
        }
      });

      $('#serviceFormApiProviderServices').html(services);
      // $('#orderCategoryService').show();

    });
  }

  function addNewService() {
    $('#serviceFormLabel').html('{{ __('
      locale.service.form.add_service ') }}');
    $('#serviceFormMethod').html('');
    $('#serviceFormServiceId').html('');
    $('#serviceCreateForm').attr('action', '{{route('
      admin.service.create ', ['
      language ' => Config::get('
      language.current ')])}}');
    $('#pkgname').val('');
    $('#descr').val('');
    $('#rate').val('');
    $('#serviceFormOriginalPrice').val('');
    $('#minamt').val('');
    $('#maxamt').val('');

    $('#api-service-selected').hide();


    $('#pkgcat option').each(function() {
      $("#serviceFormCategoryId").val($(this).val()).trigger('change');
      return false;
    });

    $('#api-provider option').each(function() {
      $("#serviceFormApiProviderId").val($(this).val()).trigger('change');
      return false;
    });
  }

  function deleteDeactivatedItem() {
    var serviceIds = [];

    $('._form-checkbox').each(function() {
      if (this.checked && $(this).val() !== "on") {
        serviceIds.push($(this).val());
      }
    });

    $.ajax({
      type: "DELETE",
      url: "{{route('admin.service.delete', ['language' => Config::get('language.current')])}}",
      data: {
        ids: serviceIds,
        status: false,
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {
      if (data.status === true) {
        if (data.status === true) {
          window.location.href = "{{route('admin.service.all', ['language' => Config::get('language.current')])}}"
        }
      }
    });
  }

  function deleteItem() {
    var serviceIds = [];

    $('._form-checkbox').each(function() {
      if (this.checked && $(this).val() !== "on") {
        serviceIds.push($(this).val());
      }
    });

    $.ajax({
      type: "DELETE",
      url: "{{route('admin.service.delete', ['language' => Config::get('language.current')])}}",
      data: {
        ids: serviceIds,
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {
      if (data.status === true) {
        $.each(serviceIds, function(index, value) {
          $('#service-' + value).hide();
        })

      }
    });
  }

  function addDelete() {
    var linksDel = document.querySelectorAll("._link-del");
    for (var j = 0; j < linksDel.length; j++) {
      linksDel[j].addEventListener("click", function(e) {
        deleteItem();
        this.closest(".category-item").remove();

        var mass = [];
        mass = this.closest(".category-item").id.split('-');

        $.ajax({
          type: "DELETE",
          url: "{{route('admin.service.delete', ['language' => Config::get('language.current')])}}",
          data: {
            id: mass[1],
            _token: "{{csrf_token()}}"
          }
        }).done(function(data) {

        });
      })
    }
  }

  function setItemStatus(status) {
    var serviceIds = [];

    $('._form-checkbox').each(function() {
      if (this.checked && $(this).val() !== "on") {
        serviceIds.push($(this).val());
      }
    });

    $.ajax({
      type: "POST",
      url: "{{route('admin.service.change-status', ['language' => Config::get('language.current')])}}",
      data: {
        ids: serviceIds,
        status: status,
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {
      if (data.status === true) {
        window.location.href = "{{route('admin.service.all', ['language' => Config::get('language.current')])}}"
      }
    });
  }

  $(document).ready(function() {
    function editService(serviceId) {
      $('#serviceFormLabel').html('{{ __('
        locale.service.form.edit_service ') }}');
      $('#serviceFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
      $('#serviceFormServiceId').html('<input type="hidden" name="id" value="' + serviceId + '" />');
      $('#serviceCreateForm').attr('action', '{{route('
        admin.service.update ', ['
        language ' => Config::get('
        language.current ')])}}');

      $.ajax({
        type: "GET",
        url: "{{route('admin.service.info', ['language' => Config::get('language.current')])}}",
        data: {
          id: serviceId,
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {

        $('#pkgname').val(data.data.name);
        $('#descr').val(data.data.desc);
        $('#rate').val(data.data.price);
        $('#serviceFormOriginalPrice').val(data.data.original_price);
        $('#minamt').val(data.data.min);
        $('#maxamt').val(data.data.max);


        $('#pkgcat option').each(function() {
          if ($(this).val() == data.data.category_id) {
            $("#pkgcat").val($(this).val()).trigger('change');
          }
        });

        $('#status option').each(function() {
          if ($(this).val() === Boolean(Number(data.data.status)).toString()) {
            $("#status").val($(this).val()).trigger('change');
          }
        });

        if (data.data.add_type === "manual") {
          $('#api-service-selected').hide();
          $('#api-selected').hide();
          apiSelected.classList.add("active");
        }

        if (data.data.add_type === "api") {
          $("#api").prop('checked', true);
          $('#api-service-selected').show();
          $('#api-selected').show();
        }

        $('#api-provider option').each(function() {
          if ($(this).val() == data.data.api_provider_id) {
            $("#api-provider").val($(this).val()).trigger('change');
          }
        });

        setProviderServiceSelector(data.data.api_provider_id, data.data.api_service_id);

      });
    }

    function setProviderServiceSelector(ApiProviderId, ServiceId) {
      $.ajax({
        type: "GET",
        url: "{{route('admin.api-provider.services', ['language' => Config::get('language.current')])}}",
        data: {
          id: ApiProviderId,
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {

        var result = '';

        if (typeof data.data.data !== 'undefined') {
          result = data.data.data;
        } else {
          result = data.data;
        }

        var services = '';
        var i = 0;

        $.each(result, function(index, value) {
          services += '<option ' +
            'value="' + value.service + '" ' +
            'data-min="' + value.min + '" ' +
            'data-max="' + value.max + '" ' +
            'data-rate="' + value.rate + '" ' +
            'data-type="' + value.type + '" ';

          if (value.service == ServiceId) {
            services += ' selected ';
          }

          services += '>' + value.name + '</option>';

          if (i === 0 && ServiceId === 0) {
            $('#serviceFormMin').val(value.min);
            $('#serviceFormMax').val(value.max);
            $('#serviceFormOriginalPrice').val(value.rate);
            $('#serviceFormType').val(value.type);

            i++;
          }
        });

        $('#serviceFormApiProviderServices').html(services);

      });
    };

    $('#serviceFormApiProviderServices').on('change', function() {
      $('#minamt').val($(this).find(':selected').data('min'));
      $('#maxamt').val($(this).find(':selected').data('max'));
      $('#serviceFormOriginalPrice').val($(this).find(':selected').data('rate'));
      $('#serviceFormType').val($(this).find(':selected').data('type'));
    });

    $('#api-provider').on('change', function() {
      $.ajax({
        type: "GET",
        url: "{{route('admin.api-provider.services', ['language' => Config::get('language.current')])}}",
        data: {
          id: $(this).val(),
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {
        var result = '';

        if (typeof data.data.data !== 'undefined') {
          result = data.data.data;
        } else {
          result = data.data;
        }

        var services = '';
        var i = 0;

        $.each(result, function(index, value) {
          services += '<option ' +
            'value="' + value.service + '" ' +
            'data-min="' + value.min + '" ' +
            'data-max="' + value.max + '" ' +
            'data-rate="' + value.rate + '" ' +
            'data-type="' + value.type + '" ';

          services += '>' + value.name + '</option>';

          if (i === 0) {
            $('#minamt').val(value.min);
            $('#maxamt').val(value.max);
            $('#serviceFormOriginalPrice').val(value.rate);
            $('#serviceFormType').val(value.type);

            i++;
          }
        });

        $('#serviceFormApiProviderServices').html(services);
      });
    });


    function addNewService() {
      $('#serviceFormLabel').html('{{ __('
        locale.service.form.add_service ') }}');
      $('#serviceFormMethod').html('');
      $('#serviceFormServiceId').html('');
      $('#serviceCreateForm').attr('action', '{{route('
        admin.service.create ', ['
        language ' => Config::get('
        language.current ')])}}');
      $('#pkgname').val('');
      $('#descr').val('');
      $('#rate').val('');
      $('#serviceFormOriginalPrice').val('');
      $('#minamt').val('');
      $('#maxamt').val('');

      $('#pkgcat option').each(function() {
        $("#serviceFormCategoryId").val($(this).val()).trigger('change');
        return false;
      });

      $('#api-provider option').each(function() {
        $("#serviceFormApiProviderId").val($(this).val()).trigger('change');
        return false;
      });
    }

    function setItemStatus(status) {
      var serviceIds = [];

      $('._form-checkbox').each(function() {
        if (this.checked && $(this).val() !== "on") {
          serviceIds.push($(this).val());
        }
      });

      $.ajax({
        type: "POST",
        url: "{{route('admin.service.change-status', ['language' => Config::get('language.current')])}}",
        data: {
          ids: serviceIds,
          status: status,
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {
        if (data.status === true) {
          window.location.href = "{{route('admin.service.all', ['language' => Config::get('language.current')])}}"
        }
      });
    }

    function deleteDeactivatedItem() {
      var serviceIds = [];

      $('._form-checkbox').each(function() {
        if (this.checked && $(this).val() !== "on") {
          serviceIds.push($(this).val());
        }
      });

      $.ajax({
        type: "DELETE",
        url: "{{route('admin.service.delete', ['language' => Config::get('language.current')])}}",
        data: {
          ids: serviceIds,
          status: false,
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {
        if (data.status === true) {
          if (data.status === true) {
            window.location.href = "{{route('admin.service.all', ['language' => Config::get('language.current')])}}"
          }
        }
      });
    }

    function deleteItem() {
      var serviceIds = [];

      $('._form-checkbox').each(function() {
        if (this.checked && $(this).val() !== "on") {
          serviceIds.push($(this).val());
        }
      });

      $.ajax({
        type: "DELETE",
        url: "{{route('admin.service.delete', ['language' => Config::get('language.current')])}}",
        data: {
          ids: serviceIds,
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {
        if (data.status === true) {
          $.each(serviceIds, function(index, value) {
            $('#service-' + value).hide();
          })

        }
      });
    }


    if ($("body").css("height") < (100 + "vh") && window.innerWidth < 768) {
      var aside = document.querySelector('aside');
      aside.style.maxHeight = 100 + "vh";
      aside.style.overflowY = "scroll";

    }

    function putOverlay() {
      var overlay = document.createElement("div");
      overlay.classList.add("madeup-overlay")
      var ovStyles = {
        "height": "100vh",
        "width": "100%",
        "background-color": "rgba(0, 0, 0, .7)",
        "z-index": 5,
        "position": "fixed",
        "top": 0,
        "left": 0,
        "display": "none",
      }
      Object.assign(overlay.style, ovStyles);
      document.querySelector('body').appendChild(overlay);
      $(overlay).fadeIn();
    }

    function addEdit() {
      var linksEdit = document.querySelectorAll("._link-edit"),
        linkAdd = document.querySelector(".category__block--add"),
        formHeader = document.querySelector(".add-service-header"),
        addForm = document.querySelector(".add-service"),
        formCloser = document.querySelector(".add-service-close"),
        resetBtn = document.querySelector(".btn-danger");

      for (var i = 0; i < linksEdit.length; i++) {
        linksEdit[i].addEventListener("click", function(e) {
          let linksParent = this.closest('tr'),
            linksParentId = linksParent.getAttribute("id");
          e.preventDefault();
          formHeader.innerText = "Edit category";

          putOverlay();
          addForm.classList.add("active");
          const hideForm = () => {
            overlay.remove();
            addForm.classList.remove("active");
          }

          const hideByOutside = (e) => {
            if (!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-edit")) && !(e.target.classList.contains("category__block--add"))) {
              hideForm();
              e.target.removeEventListener("click", hideByOutside)
            }
          }

          const hideByKey = (e) => {
            if (e.keyCode === 27) {
              hideForm();
              e.target.removeEventListener("click", hideByKey)
            }
          }

          var overlay = document.querySelector(".madeup-overlay");

          // editService(linksParentId);

          formCloser.addEventListener("click", hideForm);
          document.addEventListener("click", hideByOutside);
          document.addEventListener("keydown", hideByKey);
          resetBtn.addEvenListener("click", hideForm);
        });
      }
      if (linkAdd) {
        linkAdd.addEventListener("click", function() {
          putOverlay();

          addForm.classList.add("active");

          var overlay = document.querySelector(".madeup-overlay");
          const hideForm = () => {
            overlay.remove();
            addForm.classList.remove("active");
          }

          const hideByOutside = (e) => {
            if (!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-edit")) && !(e.target.classList.contains("category__block--add"))) {
              hideForm();
              e.target.removeEventListener("click", hideByOutside)
            }
          }

          const hideByKey = (e) => {
            if (e.keyCode === 27) {
              hideForm();
              e.target.removeEventListener("click", hideByKey)
            }
          }

          formCloser.addEventListener("click", hideForm);
          document.addEventListener("click", hideByOutside);
          document.addEventListener("keydown", hideByKey);
        });
      }
    }

    var apiCheckbox = document.querySelector('#api');
    var apiSelected = document.querySelector('#api-selected');
    var manualCheckbox = document.querySelector('#manual');
    var manualSelected = document.querySelector("#manual-selected");

    apiCheckbox.addEventListener("click", function() {
      $('#api-service-selected').show();
      apiSelected.classList.add("active");
      manualSelected.classList.remove("active");
    });
    manualCheckbox.addEventListener("click", function() {
      $('#api-service-selected').hide();
      manualSelected.classList.add("active");
      apiSelected.classList.remove("active");
    })

    function addDelete() {
      var linksDel = document.querySelectorAll("._link-del");
      for (var j = 0; j < linksDel.length; j++) {
        linksDel[j].addEventListener("click", function(e) {
          deleteItem();
          this.closest(".category-item").remove();

          var mass = [];
          mass = this.closest(".category-item").id.split('-');

          $.ajax({
            type: "DELETE",
            url: "{{route('admin.service.delete', ['language' => Config::get('language.current')])}}",
            data: {
              id: mass[1],
              _token: "{{csrf_token()}}"
            }
          }).done(function(data) {

          });
        })
      }
    }

    const closeBtns = document.querySelectorAll(".popup__close");

    for (let i = 0; i < closeBtns.length; i++) {
      closeBtns[i].addEventListener("mousedown", function() {
        $($(this).closest(".project-block__popup")).fadeOut();
        $("body, html").css({
          "overflow": "visible",
          "height": "auto"
        })
      })
    }
    addDelete();
    addEdit();
  })
</script>