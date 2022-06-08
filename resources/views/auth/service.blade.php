<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Follow Sale - Services</title>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <x-page-orientation />
  <link rel="stylesheet" href="{{asset('admin/sass/secondary.min.css')}}">
</head>

<body>
  <div class="overlay"></div>
  <div class="preloader">
    <picture>
      <source srcset="{{asset('new/img/logo.svg')}}" type="image/webp"><img src="{{asset('new/img/logo.svg')}}">
    </picture>
  </div>

  <div class="popup">
    <div class="popup-close">
      <div class="popup-cross"></div>
    </div>
    <x-user-register />
  </div>
  @include('auth.header')
  <x-page-orientation />
  <section class="secondary">
    <div class="api-wrapper">
      <div class="services">
        <div class="services-header">Services</div>
        <div class="services-sort">
          <div class="services-sort-header">Sort by</div>
          <div class="services__wrapper">
            @foreach($categories as $category)
            <a class="services-sort-{{strtolower($category->name)}}" href="#{{$category->id}}">
              <div class="icon-{{strtolower($category->name)}}"></div>
              <div class="icon-text">{{$category->name}}</div>
            </a>
            @endforeach
          </div>
        </div>
      </div>
      @foreach($categories as $category)
      <div class="api-drop-down api-drop-down-active">
        <div class="api-header-block" id="{{$category->id}}">
          <div class="api-header-text">{{$category->name}}</div>
          <div class="api-toggler"></div>
        </div>
        <div class="api-scroller">
          <ul class="api__list" style="display: none;">
            @foreach($services as $service)
            @if($service->category_id === $category->id)
            <li class="api-table-row">
              <h3 class="api-table-name">{{$service->name}}</h3>
              <p class="api-table-id api-table-center">Id: <span>{{$service->id}}</span></p>
              <p class="api-table-center">Rate per 1000($): <span>{{$service->price}}</span></p>
              <p class="api-table-center">Min: <span>{{$service->min}}</span></p>
              <p class="api-table-center">Max: <span>{{$service->max}}</span></p>
              <div class="api-table-btncent">
                <div class="api-btn-details" id="{{$service->id}}" onclick="showDetails({{$service->id}})">Details</div>
              </div>
              <!--onclick="showDetails({{$service->id}})" -->
            </li>
            @endif
            @endforeach
            <tr>
            </tr>
          </ul>
          <table class="api-table" style="width: 100%;">
            <thead>
              <tr class="api-table-row api-table-descr">
                <th class="api-table-id api-table-center">ID</th>
                <th class="api-table-name">Name</th>
                <th class="api-table-center">Rate per 1000($)</th>
                <th class="api-table-center">Min / Max order</th>
                <th class="api-table-center">Description</th>
              </tr>
            </thead>
            <tbody>
              @foreach($services as $service)
              @if($service->category_id === $category->id)
              <tr>
                <td class="api-table-space">space</td>
              </tr>
              <tr class="api-table-row">
                <td class="api-table-id api-table-center">{{$service->id}}</td>
                <td class="api-table-name">{{$service->name}}</td>
                <td class="api-table-center">{{$service->price}}</td>
                <td class="api-table-center">{{$service->min}} / {{$service->max}}</td>
                <td class="api-table-btncent">
                  <div class="api-btn-details" id="{{$service->id}}" onclick="showDetails({{$service->id}})">Details</div>
                </td>
                <!--onclick="showDetails({{$service->id}})" -->
              </tr>
              @endif
              @endforeach
              <tr>
                <td class="api-table-space">space</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  @include('auth.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="{{asset('new/main.js')}}"></script>
  <script>
    // $('.api__list').slick({
    //   prevArrow: `<button type="button" class="slick__arrow slick-prev">&laquo;</button>`,
    //   nextArrow: `<button type="button" class="slick__arrow slick-next">&raquo;</button>`,
    //   dots: true
    // });

    function sort(categoryId) {
      window.location.href = "{{route('auth.services',['language' => Config::get('app.locale')])}}?category_id=" + categoryId
    }

    function showDetails(serviceId) {
      $.ajax({
        type: "GET",
        url: "{{route('service.info',['language' => Config::get('app.locale')])}}",
        data: {
          id: serviceId,
          _token: "{{csrf_token()}}"
        }
      }).done(function(data) {
          var list = data.data.desc.split("if you want a special price - write to tickets");

          list = list[0].split("\r\n");

          var elementsList = '';

          $.each(list, function (index, value) {
              if (value.indexOf('[') > 0) {
                  var elements = value.split("[");

                  if (elements[0].indexOf(']') < 0) {
                      elementsList += '<li>' + elements[0] + '</li>';
                  }

                  elements = elements[1].split("]")

                  $.each(elements[0].split("|"), function (index, value) {
                      if (value !== '' && value != 'undefined') {
                          elementsList += '<li>' + value + '</li>'
                      }
                  })

                  if (elements[1] != null) {
                      elementsList += '<li>' + elements[1] + '</li>'
                  }
              } else {
                  if (value !== '' && value !== '🔔') {
                      elementsList += '<li>' + value + '</li>'
                  }
              }
          })

          var name = data.data.name.replace("|", "<br/>")

          $('#api-popup-header').html(name);
          $('#api-popup-paragraph-descr').html(`<ul>`
              +elementsList+

              `</ul>`);
      });
    }
  </script>
</body>

</html>
