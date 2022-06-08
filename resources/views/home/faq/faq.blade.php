@extends('panel/master')

@section('title', 'Categories')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')

  <style>
      .tabs {
          font-size: 0;
      }

      .tabs>input[type="radio"] {
          display: none;
      }

      .tabs>div {
          /* скрыть контент по умолчанию */
          display: none;
          border: 1px solid #e0e0e0;
          padding: 10px 15px;
          font-size: 16px;
      }

      @foreach($languages as $language)
        #tab-btn-{{$language->id}}:checked~#content-{{$language->id}} {
          display: block;
        }
      @endforeach

      .tabs>label {
          display: inline-block;
          text-align: center;
          vertical-align: middle;
          user-select: none;
          background-color: #f5f5f5;
          border: 1px solid #e0e0e0;
          padding: 2px 8px;
          font-size: 16px;
          line-height: 1.5;
          transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
          cursor: pointer;
          position: relative;
          top: 1px;
      }

      .tabs>label:not(:first-of-type) {
          border-left: none;
      }

      .tabs>input[type="radio"]:checked+label {
          background-color: #fff;
          border-bottom: 1px solid #fff;
      }
  </style>

  <!-- users list start -->
  <section class="app-user-list">
    <!-- list and filter start -->
    <div class="card">
      <div class="card-body border-bottom">
        {{--        <h4 class="card-title">Search & Filter</h4>--}}
        {{--        <div class="row">--}}
        {{--          <div class="col-md-4 user_role"></div>--}}
        {{--          <div class="col-md-4 user_plan"></div>--}}
        {{--          <div class="col-md-4 user_status"></div>--}}
        {{--        </div>--}}
      </div>
      <div class="card-datatable table-responsive pt-0">
        <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
          <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
            <div class="dataTables_length" id="DataTables_Table_0_length">
              {{--              <label>Show--}}
              {{--                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">--}}
              {{--                  <option value="10">10</option>--}}
              {{--                  <option value="25">25</option>--}}
              {{--                  <option value="50">50</option>--}}
              {{--                  <option value="100">100</option>--}}
              {{--                </select>--}}
              {{--                entries--}}
              {{--              </label>--}}
            </div>
          </div>
          <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
            <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
              <div class="me-1">
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                  {{--                  <label>Search:--}}
                  {{--                    <input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">--}}
                  {{--                  </label>--}}
                </div>
              </div>
              <div class="dt-buttons d-inline-flex mt-50">
                <button onclick="addFaq()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-faq-in">
                  <span>Add F.A.Q</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>No.</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($faqs as $faq)
            <tr id="faq{{$faq->id}}">
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$faq->id}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$faq->question}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-left align-items-center">
                  <div class="d-flex flex-column">
                    <span class="fw-bolder">
                      {{$faq->answer}}
                    </span>
                  </div>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-faq-in" href="#" onclick="editFaq({{$faq->id}})">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#" onclick="removeFaq({{$faq->id}})">
                      <i data-feather="trash" class="font-medium-2"></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- Modal to add new user starts-->
      <div class="modal modal-slide-in new-user-modal fade" id="modals-faq-in">
        <div class="modal-dialog">
          <form id="faqCreateForm" class="modal-content pt-0" action="{{route('faq.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="faqFormLabel">Add F.A.Q.</h5>
            </div>
            <div id="faqFormMethod"></div>
            <div id="faqFormFaqId"></div>

            <div class="modal-body flex-grow-1">
              <div class="tabs">
                @foreach($languages as $language)
                  <input type="radio" name="tab-btn" id="tab-btn-{{$language->id}}" value="" checked>
                  <label for="tab-btn-{{$language->id}}">{{$language->name}}</label>
                @endforeach

                @foreach($languages as $language)
                    <div id="content-{{$language->id}}">
                      <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Question</label>
                        <input
                                type="text"
                                class="form-control dt-full-name"
                                id="faqFormQuestion{{$language->name}}"
                                placeholder="{{$language->name}} Question"
                                name="{{$language->name}}[question]"
                        />
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-email">Answer</label>
                        <input
                                type="text"
                                id="faqFormAnswer{{$language->name}}"
                                class="form-control dt-email"
                                placeholder="{{$language->name}} Answer"
                                name="{{$language->name}}[answer]"
                        />
                      </div>
                    </div>
                @endforeach
              </div>

              <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Modal to add new user Ends-->
    </div>
    <!-- list and filter end -->
  </section>
  <!-- users list ends -->
@endsection

@section('vendor-script')
  <script>
      function addFaq()
      {
          $('#faqFormLabel').html('Add F.A.Q.');
          $('#faqFormMethod').html('');
          $('#faqFormFaqId').html('');
          $('#faqCreateForm').attr('action', '{{route('faq.create', ['language' => Config::get('language.current')])}}');

          $('#faqFormQuestionEnglish').val('');
          $('#faqFormAnswerEnglish').val('');

          var languages = '';

          $.ajax({
              type: "GET",
              url: "{{route('language.list', ['language' => Config::get('language.current')])}}",
              data: {
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              languages = data.data;
          });

          $.each(languages, function( index, language ) {
              $('#faqFormQuestion'+language.name).val('');
              $('#faqFormAnswer'+language.name).val('');
          });
      }

      function removeFaq(faqId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('faq.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : faqId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#faq'+faqId).hide();
              }
          });
      }

      function editFaq(faqId)
      {
          $('#faqFormLabel').html('Edit Blog');
          $('#faqFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#faqFormFaqId').html('<input type="hidden" name="id" value="'+faqId+'" />');
          $('#faqCreateForm').attr('action', '{{route('faq.update', ['language' => Config::get('language.current')])}}');

          var languages = '';

          $.ajax({
              type: "GET",
              url: "{{route('language.list', ['language' => Config::get('language.current')])}}",
              data: {
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              languages = data.data;
          });

          $.ajax({
              type: "GET",
              url: "{{route('faq.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : faqId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              $('#faqFormQuestionEnglish').val(data.data.question);
              $('#faqFormAnswerEnglish').val(data.data.answer);


              $.each(data.data.translation, function( post, translation ) {
                  $.each(languages, function( index, language ) {
                      if (translation.language_id === language.id) {
                          $('#faqFormQuestion'+language.name).val(translation.title);
                          $('#faqFormAnswer'+language.name).val(translation.context);
                      }
                  });
              });
          });
      }
  </script>
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
@endsection