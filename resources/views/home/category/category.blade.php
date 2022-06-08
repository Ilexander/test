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
                                <button onclick="addCategory()" class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-category-in">
                                    <span>Add New Category</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Creator</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr id="category{{$category->id}}">
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$category->user_id}}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$category->name}}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$category->description}}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          @if($category->image_url)
                                            <img class="footer_r" height="50" width="50" src="{{asset('storage/'.$category->image_url)}}" alt="">
                                          @endif
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                          {{$category->sort}}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder">
                                            <button type="button" class="btn {{$category->status ? 'btn-success' : 'btn-danger'}}"></button>
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
                                        <a class="dropdown-item add-new" data-bs-toggle="modal" data-bs-target="#modals-category-in" href="#" onclick="editCategory({{$category->id}})">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="removeCategory({{$category->id}})">
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
            <div class="modal modal-slide-in new-user-modal fade" id="modals-category-in">
                <div class="modal-dialog">
                    <form id="categoryCreateForm" class="modal-content pt-0" action="{{route('category.create', ['language' => Config::get('language.current')])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="categoryFormLabel">Add Category</h5>
                        </div>
                        <div id="categoryFormMethod"></div>
                        <div id="categoryFormCategoryId"></div>

                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                <input
                                        type="text"
                                        class="form-control dt-full-name"
                                        id="categoryFormName"
                                        placeholder="Category Name"
                                        name="name"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Description</label>
                                <input
                                        type="text"
                                        id="categoryFormDescription"
                                        class="form-control dt-email"
                                        placeholder="Category Description"
                                        name="description"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-uname">Image</label>
                                <input
                                        type="file"
                                        id="basic-icon-default-uname"
                                        class="form-control dt-uname"
                                        name="image"
                                />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Sort</label>
                                <input
                                        type="number"
                                        id="categoryFormSort"
                                        class="form-control dt-email"
                                        min="1"
                                        name="sort"
                                />
                            </div>
                            <div class="mb-1">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" value="0" name="status" />
                                    <input class="form-check-input" name="status" type="checkbox" value="1" id="categoryFormActive" checked />
                                    <label class="form-check-label" for="inlineCheckbox1">Is active</label>
                                </div>
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
        function addCategory()
        {
            $('#categoryFormLabel').html('Add Category');
            $('#categoryFormMethod').html('');
            $('#categoryFormCategoryId').html('');
            $('#categoryCreateForm').attr('action', '{{route('category.create', ['language' => Config::get('language.current')])}}');
            $('#categoryFormName').val('');
            $('#categoryFormDescription').val('');
            $('#categoryFormSort').val('');
            $('#categoryFormActive').prop("checked", true);
        }

        function removeCategory(categoryId)
        {
            $.ajax({
                type: "DELETE",
                url: "{{route('category.delete', ['language' => Config::get('language.current')])}}",
                data: {
                    id : categoryId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                if (data.status === true) {
                    $('#category'+categoryId).hide();
                }
            });
        }

        function editCategory(categoryId)
        {
            $('#categoryFormLabel').html('Edit Category');
            $('#categoryFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
            $('#categoryFormCategoryId').html('<input type="hidden" name="id" value="'+categoryId+'" />');
            $('#categoryCreateForm').attr('action', '{{route('category.update', ['language' => Config::get('language.current')])}}');

            $.ajax({
                type: "GET",
                url: "{{route('category.info', ['language' => Config::get('language.current')])}}",
                data: {
                    id : categoryId,
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                $('#categoryFormName').val(data.data.name);
                $('#categoryFormDescription').val(data.data.description);
                $('#categoryFormSort').val(data.data.sort);
                $('#categoryFormActive').prop("checked", data.data.status);
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
