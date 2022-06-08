@extends('panel/master')

@section('title', 'Permissions')

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
                                <button onclick="addRole()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-role-in">
                                    <span>Add New Role</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr id="role{{$role->id}}">
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$role->name}}
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
                                        <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-role-in" href="#" onclick="editRole({{$role->id}})">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="removeRole({{$role->id}})">
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
            <div class="modal modal-slide-in new-user-modal fade" id="modals-role-in">
                <div class="modal-dialog">
                    <form id="roleCreateForm" class="modal-content pt-0" action="{{route('role.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="roleFormLabel">Add Role</h5>
                        </div>
                        <div id="roleFormMethod"></div>
                        <div id="roleFormRoleId"></div>

                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                <input
                                        type="text"
                                        class="form-control dt-full-name"
                                        id="roleFormName"
                                        placeholder="Role Name"
                                        name="name"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-company">Permission</label>
                                <div id="rolePermission"></div>
                                <button type="button" class="btn btn-primary me-1" onclick="addPermissionToRole()">+</button>
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
        function addPermissionToRole()
        {
            $.ajax({
                type: "GET",
                url: "{{route('permission.all', ['language' => Config::get('language.current')])}}",
                data: {
                    {{--_token : "{{csrf_token()}}"--}}
                }
            }).done(function(data) {
                var id = Math.floor((Math.random() * 10000) + 1);
                var permissions = '<div id="selector'+id+'" class="col-sm-12"><div class="col-sm-9" style="float: left;"><select name="permission[]" class="select2 form-select">';
                $.each(data.data, function( index, value ) {
                    permissions += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                permissions += '</select></div>' +
                    '<div class="col-sm-3" style="float: left;"><button type="button" onclick="removePermissionToRole('+id+')" class="btn btn-danger">x</button></div>' +
                    '</div>';

                $('#rolePermission').append(permissions);
            });
        }

        function removePermissionToRole(id)
        {
            $('#selector'+id).remove();
        }

        function addRole()
        {
            $('#roleFormLabel').html('Add Role');
            $('#roleFormMethod').html('');
            $('#roleFormRoleId').html('');
            $('#roleCreateForm').attr('action', '{{route('role.create', ['language' => Config::get('language.current')])}}');
            $('#roleFormName').val('');
        }

        function removeRole(roleId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{route('role.delete', ['language' => Config::get('language.current')])}}",
                data: {
                    id : roleId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    $('#role'+roleId).hide();
                }
            });
        }

        function editRole(roleId)
        {
            var permissions = '';
            $.ajax({
                type: "GET",
                url: "{{route('permission.all', ['language' => Config::get('language.current')])}}",
                data: {
                    {{--_token : "{{csrf_token()}}"--}}
                }
            }).done(function(data) {
                permissions = data.data;
            });

            $('#roleFormLabel').html('Edit Role');
            $('#roleFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
            $('#roleFormRoleId').html('<input type="hidden" name="id" value="'+roleId+'" />');
            $('#roleCreateForm').attr('action', '{{route('role.update', ['language' => Config::get('language.current')])}}');

            $.ajax({
                type: "GET",
                url: "{{route('role.info', ['language' => Config::get('language.current')])}}",
                data: {
                    id : roleId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                $('#roleFormName').val(data.data.name);

                $.each(data.data.permissions, function( index, value ) {
                    var selector = '<div id="selector'+value.id+'" class="col-sm-12"><div class="col-sm-9" style="float: left;"><select name="permission[]" class="select2 form-select">';
                    $.each(permissions, function( key, permission ) {
                        if (value.id === permission.id) {
                            selector += '<option selected value="'+permission.id+'">'+permission.name+'</option>';
                        } else {
                            selector += '<option value="'+permission.id+'">'+permission.name+'</option>';
                        }
                    });
                    selector += '</select></div>'+
                        '<div class="col-sm-3" style="float: left;"><button type="button" onclick="removePermissionToRole('+value.id+')" class="btn btn-danger">x</button></div>' +
                        '</div>';

                    $('#rolePermission').append(selector);
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