@extends('panel/master')

@section('title', 'User List')

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
  <!-- users list start -->
  <section class="app-user-list">
    <div class="row">
      @foreach($departments as $department)
        <div class="col-lg-3 col-sm-6" onclick="editDepartment({{$department->id}}, '{{$department->name}}', {{count($department->users)}})">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <a href="{{route('department.delete', ['language' => Config::get('language.current'), 'id' => $department->id])}}">
                  <i data-feather="trash"></i>
              </a>
              <div>
                <h3 class="fw-bolder mb-75">{{$department->name}}</h3>
                <span>{{count($department->users)}}</span>
              </div>
              <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="user" class="font-medium-2"></i>
            </span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
        <div class="col-lg-3 col-sm-6">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewDepartment">
            Add new
          </button>
        </div>
    </div>

    <script>
      function editDepartment(departmentId, departmentName, countMembers)
      {
          $("#editExistDepartmentValidation").attr('action',"{{route('department.edit', ['language' => Config::get('language.current')])}}?id="+departmentId);
          $("#modalEditDepartmentName").val(departmentName);
          $("#editDepartmentMembers").html('');

          if (countMembers === 0) {
              $("#currentDepartmentMembers").hide();
          } else {
              $("#currentDepartmentMembers").show();
          }

          $.ajax({
              url: "{{route('department.members', ['language' => Config::get('language.current')])}}",
              data: {
                  department_id: departmentId
              },
          }).done(function(data) {
              var user = '';
              data.forEach((element) => {
                  user+= '<tr id="departmentMember'+element.user.id+'"><td>'+element.user.first_name+'</td><td>'+element.user.last_name+'</td>' +
                      '<td><input type="hidden" name="members[]" value="'+element.user.id+'"><button type="button" style="padding: 0 0 0 0; background-color: white;" class="btn" onclick="removeMember('+element.user.id+')">' +
                      'x' +
                      '</button></td></tr>';
              });
              $('#departmentMembers').html(user);
          });


          $('#editExistDepartment').modal('show');
      }

      function removeMember(item)
      {
          $("#departmentMember"+item).remove();
      }
    </script>

  </section>
  <!-- users list ends -->

  @include('home/department/modal-add-new')
  @include('home/department/modal-edit-exist')
@endsection

@section('vendor-script')
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
