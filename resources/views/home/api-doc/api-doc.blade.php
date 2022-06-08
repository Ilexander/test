@extends('panel/master')

@section('title', 'Api')

@section('content')
  <style>
      .response-body {
          -ms-flex: 1 1 auto;
          flex: 1 1 auto;
          margin: 0;
          padding: 1.5rem 1.5rem;
          position: relative;
      }
  </style>
  <section class="app-user-list">
    <div class="row">
      <div class="dt-buttons d-inline-flex mt-50">
        <button onclick="addApiDoc()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-api-doc">
          <span>Add Api Doc</span>
        </button>
      </div>
      @foreach($apiDocs as $apiDoc)
        <div class="col-md-8" id="apiDoc{{$apiDoc->id}}">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                {{$apiDoc->title}}
              </h3>
              <div class="dt-buttons d-inline-flex mt-50">
                <button onclick="editApiDoc({{$apiDoc->id}})" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-api-doc">
                  <i data-feather="edit-2" class="me-50"></i>
                </button>
              </div>
              <div class="dt-buttons d-inline-flex mt-50">
                <button onclick="removeApiDoc({{$apiDoc->id}})" class="dt-button add-new btn btn-danger" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                  <i data-feather="trash" class="font-medium-2"></i>
                </button>
              </div>
              <div class="card-options">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body collapse show">
              <div class="x_content">
                <p class="note">{{$apiDoc->description}}</p>

                <table class="table table-hover table-bordered projects">
                  <tbody>
                  @foreach($apiDoc->params as $param)
                    <tr>
                      <td>{{$param->parameter}}</td>
                      <td>{{$param->description}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <div class="card-footer">
                  <div class="row">
                    @if($apiDoc->response)
                      Example response:
                      <div class="response-body">
                          <pre>
                            {{json_decode($apiDoc->response)}}
                          </pre>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-api-doc">
      <div class="modal-dialog modal-lg" style="width: 40rem">
        <form id="apiDocCreateForm" class="modal-content pt-0" action="{{route('api-doc.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
          @csrf
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="apiDocFormLabel">Add Api Doc</h5>
          </div>
          <div id="apiDocFormMethod"></div>
          <div id="apiDocFormApiDocId"></div>

          <div class="modal-body flex-grow-1">
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-fullname">Title</label>
              <input
                      type="text"
                      class="form-control dt-full-name"
                      id="apiDocFormTitle"
                      placeholder="Title"
                      name="title"
              />
            </div>

            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-email">Description</label>
              <input
                      type="text"
                      id="apiDocFormDescription"
                      class="form-control dt-email"
                      placeholder="Description"
                      name="description"
              />
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-company">Request Params</label>
              <div id="apiDocRequestParams">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Parameter</th>
                    <th>Description</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody id="apiDocRequestParamsBody">

                  </tbody>
                </table>

              </div>
              <button type="button" class="btn btn-primary me-1" onclick="addRequestParam()">+</button>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-contact">Response</label>
              <textarea
                      data-length="120"
                      class="form-control char-textarea"
                      id="apiDocFormResponse"
                      rows="5"
                      name="response"
                      placeholder="
                    {
                        'status': 'success',
                        'order': 32
                      }"></textarea>
            </div>
            <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->

  </section>

  <script>
      function addRequestParam()
      {
          const id = Math.floor((Math.random() * 10000) + 1)

          const fields = "<tr id='requestParam"+id+"'>" +
              "<td><input type='text' name='requestParams["+id+"][parameter]' size=15 placeholder='new parameter'></td>" +
              "<td><input type='text' name='requestParams["+id+"][description]' size=15 placeholder='new description'></td>" +
              "<td><button onclick='removeRequestParam("+id+")' class='dt-button add-new btn btn-danger' tabindex='0' aria-controls='DataTables_Table_0' type='button'>" +
              "<i class='bi bi-trash'></i>" +
              "</button></td>" +
              "</tr>";

          $('#apiDocRequestParamsBody').append(fields)
      }

      function removeRequestParam(requestParamId)
      {
          $('#requestParam'+requestParamId).remove()
      }

      function removeApiDoc(apiDocId)
      {
          $.ajax({
              type: "DELETE",
              url: "{{route('api-doc.delete', ['language' => Config::get('language.current')])}}",
              data: {
                  id : apiDocId,
                  _token : "{{csrf_token()}}"
              }
          }).done(function(data) {
              if (data.status === true) {
                  $('#apiDoc'+apiDocId).hide();
              }
          });
      }

      function addApiDoc()
      {
          $('#apiDocFormLabel').html('Add Api Doc');
          $('#apiDocFormMethod').html('');
          $('#apiDocFormApiDocId').html('');
          $('#apiDocCreateForm').attr('action', '{{route('api-doc.create', ['language' => Config::get('language.current')])}}');
          $('#apiDocFormTitle').val('');
          $('#apiDocFormDescription').val('');
          $('#apiDocRequestParamsBody').html('')
          $('#apiDocFormResponse').val('');
      }

      function editApiDoc(apiDocId)
      {
          $('#apiDocFormLabel').html('Edit Api Doc');
          $('#apiDocFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
          $('#apiDocFormApiDocId').html('<input type="hidden" name="id" value="'+apiDocId+'" />');
          $('#apiDocCreateForm').attr('action', '{{route('api-doc.update', ['language' => Config::get('language.current')])}}');

          $.ajax({
              type: "GET",
              url: "{{route('api-doc.info', ['language' => Config::get('language.current')])}}",
              data: {
                  id : apiDocId
              }
          }).done(function(data) {
              $('#apiDocFormTitle').val(data.data.title);
              $('#apiDocFormDescription').val(data.data.description);
              // $('#apiDocRequestParams').html('');
              $('#apiDocFormResponse').val(jQuery.parseJSON( data.data.response));

              var fields = "";

              $.each(data.data.params, function( index, value ) {

                  fields += "<tr id='requestParam"+value.id+"'>" +
                      "<td>" +
                      "<input type='text' name='requestParams["+value.id+"][parameter]' size=15 placeholder='new parameter' value='"+value.parameter+"'>" +
                      "</td>" +
                      "<td>" +
                      "<input type='text' name='requestParams["+value.id+"][description]' size=15 placeholder='new description' value='"+value.description+"'>" +
                      "</td>" +
                      "<td><button onclick='removeRequestParam("+value.id+")' class='dt-button add-new btn btn-danger' tabindex='0' aria-controls='DataTables_Table_0' type='button'>" +
                      "<i class='bi bi-trash'></i>" +
                      "</button></td>" +
                      "</tr>";


              });

              $('#apiDocRequestParamsBody').html(fields)
          });
      }
  </script>
@endsection
