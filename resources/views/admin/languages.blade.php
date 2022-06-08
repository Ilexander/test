@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
            <div class="add-service">
                <form
                    action="{{route('admin.language.create', ['language' => Config::get('language.current')])}}"
                    id="languageCreateForm"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div id="languageFormMethod"></div>
                    <div id="languageFormLanguageId"></div>
                    <!-- <input type="hidden" name="oleg[]" value="first">
                    <input type="hidden" name="oleg[]" value="second">
                    <input type="hidden" name="oleg[]" value="one more">
                    <input type="hidden" name="oleg[]" value="hello"> -->
                    <div class="add-service-header-block">
                        <div class="add-service-header" id="languageFormLabel">Add Language</div>
                        <div class="add-service-close">
                            <div class="cross"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="input-group mt-2">
                        <label for="name" style="width: 100%">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mt-2">
                        <label for="name" style="width: 100%">Alias</label>
                        <input type="text" class="form-control" id="alt" name="alt" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mt-2">
                        <label for="sortnum" style="width: 100%">Image</label>
                        <input type="file" class="form-control" name="image" id="image" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mt-2" style="display: block">
                        <button type="button" class="btn btn-info add-country" style="display: block; border-radius: 4px !important">Add country</button>
                        <ul class="supported-countries">
                            <div class="supported-countries-header">Supported countries:</div>
                            <div id="issetLanguageCountries"></div>
                        </ul>
                    </div>
                    <div class="input-group mt-2">
                        <div class="layout-position">Layout position</div>
                        <div class="input-holder" style="width: 100%">
                            <label for="ltr">LTR</label>
                            <input type="radio" id="ltr" name="view" value="ltr">
                        </div>
                        <div class="input-holder" style="width: 100%">
                            <label for="rtl">RTL</label>
                            <input type="radio" id="rtl" name="view" value="rtl">
                        </div>
                    </div>
                    <div class="input-group mt-2">
                        <label for="status" style="width: 100%">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="true" selected>Active</option>
                            <option value="false">Deactive</option>
                        </select>
                    </div>
                    <div class="add-service-buttons mt-2">
                        <button type="submit" class="btn btn-success me-3 mt-2">Submit</button>
                        <button type="reset" class="btn btn-danger me-3 mt-2">Cancel</button>
                    </div>
                </form>
            </div>

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
                                List
                                <div class="category__block--add" style="display: inline-block; color:blue; text-decoration:none; margin-left: 10px; font-size:20px;" onclick="addLanguage()">+ Add new </div>
                            </h2>
                            <div class="category__block--action action-block col-auto">
                                <div class="action-block__body _sub-parent">
                                    <button type="button" class="action-block__btn _btn _alt _sub-open">
                                        <span class="action-block__btn--icon _icon-burger"></span>
                                        Action
                                        <span class="action-block__btn--icon _icon-arrow"></span>
                                    </button>
                                    <ul class="action-block__sub-list ps-0 pt-2 pb-2 m-0 _sub-list">
                                        <li class="action-block__sub-list--li" onclick="deleteItem()">
                                            <button type="button" class="action-block__sub-list--btn _link">
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.00176 11.9844H9.99824L10.3291 4.98438H3.6709L4.00176 11.9844Z" fill="#EB5757" fill-opacity="0.15"/>
                                                    <path d="M11.8125 4H10.0625V2.90625C10.0625 2.42363 9.67012 2.03125 9.1875 2.03125H4.8125C4.32988 2.03125 3.9375 2.42363 3.9375 2.90625V4H2.1875C1.94551 4 1.75 4.19551 1.75 4.4375V4.875C1.75 4.93516 1.79922 4.98438 1.85938 4.98438H2.68516L3.02285 12.1348C3.04473 12.601 3.43027 12.9688 3.89648 12.9688H10.1035C10.5711 12.9688 10.9553 12.6023 10.9771 12.1348L11.3148 4.98438H12.1406C12.2008 4.98438 12.25 4.93516 12.25 4.875V4.4375C12.25 4.19551 12.0545 4 11.8125 4ZM4.92188 3.01562H9.07812V4H4.92188V3.01562ZM9.99824 11.9844H4.00176L3.6709 4.98438H10.3291L9.99824 11.9844Z" fill="#EB5757"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </li>
                                        <li class="action-block__sub-list--li" onclick="deleteDeactivatedItem()">
                                            <button type="button" class="action-block__sub-list--btn _link">
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.00176 11.9844H9.99824L10.3291 4.98438H3.6709L4.00176 11.9844Z" fill="#EB5757" fill-opacity="0.15"/>
                                                    <path d="M11.8125 4H10.0625V2.90625C10.0625 2.42363 9.67012 2.03125 9.1875 2.03125H4.8125C4.32988 2.03125 3.9375 2.42363 3.9375 2.90625V4H2.1875C1.94551 4 1.75 4.19551 1.75 4.4375V4.875C1.75 4.93516 1.79922 4.98438 1.85938 4.98438H2.68516L3.02285 12.1348C3.04473 12.601 3.43027 12.9688 3.89648 12.9688H10.1035C10.5711 12.9688 10.9553 12.6023 10.9771 12.1348L11.3148 4.98438H12.1406C12.2008 4.98438 12.25 4.93516 12.25 4.875V4.4375C12.25 4.19551 12.0545 4 11.8125 4ZM4.92188 3.01562H9.07812V4H4.92188V3.01562ZM9.99824 11.9844H4.00176L3.6709 4.98438H10.3291L9.99824 11.9844Z" fill="#EB5757"/>
                                                </svg>
                                                All deactivated categories
                                            </button>
                                        </li>
                                        <li class="action-block__sub-list--li" onclick="setItemStatus(false)">
                                            <button type="button" class="action-block__sub-list--btn _link">
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.83995 9.67383H5.64522C5.70948 9.67383 5.771 9.64512 5.81338 9.5959L7.0001 8.18086L8.18681 9.5959C8.22782 9.64512 8.28935 9.67383 8.35497 9.67383H9.16024C9.25321 9.67383 9.30379 9.56582 9.24364 9.49473L7.57158 7.5L9.24501 5.50527C9.30516 5.43418 9.25458 5.32617 9.16161 5.32617H8.35634C8.29208 5.32617 8.23056 5.35488 8.18818 5.4041L7.0001 6.81914L5.81338 5.4041C5.77237 5.35488 5.71085 5.32617 5.64522 5.32617H4.83995C4.74698 5.32617 4.6964 5.43418 4.75655 5.50527L6.42862 7.5L4.75655 9.49473C4.74308 9.51057 4.73443 9.52995 4.73165 9.55057C4.72886 9.57118 4.73204 9.59216 4.74082 9.61102C4.7496 9.62988 4.76361 9.64582 4.78118 9.65695C4.79875 9.66809 4.81915 9.67394 4.83995 9.67383Z" fill="#EB5757"/>
                                                    <path d="M12.0312 2.03125H1.96875C1.72676 2.03125 1.53125 2.22676 1.53125 2.46875V12.5312C1.53125 12.7732 1.72676 12.9688 1.96875 12.9688H12.0312C12.2732 12.9688 12.4688 12.7732 12.4688 12.5312V2.46875C12.4688 2.22676 12.2732 2.03125 12.0312 2.03125ZM11.4844 11.9844H2.51562V3.01562H11.4844V11.9844Z" fill="#EB5757"/>
                                                </svg>
                                                Deatice
                                            </button>
                                        </li>
                                        <li class="action-block__sub-list--li" onclick="setItemStatus(true)">
                                            <button type="button" class="action-block__sub-list--btn _link">
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.91667 1.25H3.08333C1.79467 1.25 0.75 2.29467 0.75 3.58333V9.41667C0.75 10.7053 1.79467 11.75 3.08333 11.75H8.91667C10.2053 11.75 11.25 10.7053 11.25 9.41667V3.58333C11.25 2.29467 10.2053 1.25 8.91667 1.25Z" stroke="#219653" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M4.25 6.49992L5.5625 7.66659L7.75 5.33325" stroke="#219653" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Active
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
                                <td class="p-3 pb-1">
                                    <div class="category__table--checkbox ps-3 _table-parent-check-all-checkbox">
                                        <input type="checkbox" name="category-checkbox-all" id="category-all" class="category__table--checkbox-input _hidden-checkbox _form-checkbox">
                                        <label for="category-all" class="category__table--label _form-label-checkbox _min mt-3 mb-2 _table-check-all-checkbox"></label>
                                    </div>
                                </td>
                                <td class="p-3 pb-1">
                                    No.
                                </td>
                                <td class="p-3 pb-1">
                                    Name
                                </td>
                                <td class="p-3 pb-1">
                                    Image
                                </td>
                                <td class="p-3 pb-1">
                                    Alias
                                </td>
                                <td class="p-3 pb-1">
                                    Supported countries
                                </td>
                                <td class="p-3 pb-1">
                                    Status
                                </td>
                                <td class="p-3 pb-1">
                                    Action
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <!--foreach-->
                            @foreach($languages as $language)
                                <tr id="category-item-{{$language->id}}" class="category-item">
                                    <td class="p-3 pb-4 pt-4">
                                        <div class="category__table--checkbox ps-3 mb-1">
                                            <input
                                                type="checkbox"
                                                name="category-checkbox-{{$language->id}}"
                                                id="category-{{$language->id}}"
                                                value="{{$language->id}}"
                                                class="category__table--checkbox-input _hidden-checkbox _form-checkbox"
                                            >
                                            <label for="category-{{$language->id}}" class="category__table--label _form-label-checkbox _min"></label>
                                        </div>
                                    </td>
                                    <td class="p-3 pb-4 pt-4 fw-bold category-item-id">
                                        {{$language->id}}
                                    </td>
                                    <td class="p-3 pb-4 pt-4 category-item-name">
                                        {{$language->name}}
                                    </td>
                                    <td class="p-3 pb-4 pt-4 category-item-image">
                                        <img src="{{$language->image_url}}" width="50" height="50">
                                    </td>
                                    <td class="p-3 pb-4 pt-4 category-item-alias">
                                        {{$language->alt}}
                                    </td>
                                    <td class="p-3 pb-4 pt-4 category-item-supported">
                                        {{$language->supported_countries}}
                                    </td>
                                    <td class="p-3 pb-4 pt-4 category-item-status">
                                    <span class="category__table--status p-2 _status-{{$language->status}}">
                                        {{$language->status ? '✔️' : '❌'}}
                                    </span>
                                    </td>
                                    <td class="p-3 pb-4 pt-4 text-center _sub-parent">
                                        <a href="#" class="category__table--link _link">
                                            <span class="category__table--link-icon _sub-open _icon-details"></span>
                                        </a>
                                        <ul class="users__action--sub-list _sub-list">
                                            <li class="users__action--sub-item category__block--add" onclick="editLanguage({{$language->id}})">
                                                <a
                                                    href="#"
                                                    class="users__action--sub-link _link-edit"
                                                    style="color: black; text-decoration: none"
                                                >
                                                    <span class="users__action--sub-icon _icon-edit-alt"></span>
                                                    Edit
                                                </a>
                                            </li>
                                            <li class="users__action--sub-item" onclick="removeLanguage({{$language->id}})">
                                                <a href="#" class="users__action--sub-link _link _link-del">
                                                    <span class="users__action--sub-icon _icon-trash"></span>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            <!--endforeach-->
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            <script>
                function addLanguage()
                {
                    $('#languageFormLabel').html('Add Language');
                    $('#languageFormMethod').html('');
                    $('#languageFormLanguageId').html('');
                    $('#languageCreateForm').attr('action', '{{route('admin.language.create', ['language' => Config::get('language.current')])}}');
                    $('#name').val('');
                    $('#image').val('');
                    $('#supported').val('');
                    $('#alt').val('');
                    $('#status option').each(function (){
                        $("#status").val($(this).val()).trigger('change');
                        return true;
                    });
                    $('#issetLanguageCountries').html('');
                }

                function editLanguage(languageId)
                {
                    $('#languageFormLabel').html('Edit Language');
                    $('#languageFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
                    $('#languageFormLanguageId').html('<input type="hidden" name="id" value="'+languageId+'" />');
                    $('#languageCreateForm').attr('action', '{{route('admin.language.update', ['language' => Config::get('language.current')])}}');

                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.language.info', ['language' => Config::get('language.current')])}}",
                        data: {
                            id : languageId
                        }
                    }).done(function(data) {

                        setLanguageCountries(JSON.parse(data.data.supported_countries));


                        $('#alt').val(data.data.alt);
                        $('#'+data.data.view).attr('checked','checked');
                        $('#status option').each(function (){
                            if ($(this).val() === Boolean(Number(data.data.status)).toString()) {
                                $("#status").val($(this).val()).trigger('change');
                            }
                        });
                    });
                }

                function setLanguageCountries(languageCounties)
                {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.language.countries-list', ['language' => Config::get('language.current')])}}",
                        data: {
                            _token : "{{csrf_token()}}"
                        }
                    }).done(function(data) {

                        var countryIdx = 200;

                        var selector = '';
                        $.each(languageCounties, function( keyIsset, valueIsset ) {

                            selector += '<select name="supported_countries[]" id="supported'+countryIdx+'" class="form-select">' +
                                '<option value="" disabled>Select countries</option>';

                            $.each(data.countries, function( key, value ) {
                                if (valueIsset === key) {
                                    selector += '<option value="'+key+'" selected>'+value+'</option>'
                                } else {
                                    selector += '<option value="'+key+'">'+value+'</option>'
                                }
                            });

                            selector += '</select>';

                            countryIdx++;
                        });

                        $('#issetLanguageCountries').html(selector);
                    });
                }

                function removeLanguage(languageId)
                {

                }

                function setItemStatus(status)
                {
                    var serviceIds = [];

                    $('._form-checkbox').each(function () {
                        if (this.checked && $(this).val() !== "on") {
                            serviceIds.push($(this).val());
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.language.change-status', ['language' => Config::get('language.current')])}}",
                        data: {
                            ids : serviceIds,
                            status : status,
                            _token : "{{csrf_token()}}"
                        }
                    }).done(function(data) {
                        if (data.status === true) {
                            window.location.href = "{{route('admin.language.all', ['language' => Config::get('language.current')])}}"
                        }
                    });
                }

                function deleteDeactivatedItem() {
                    var serviceIds = [];

                    $('._form-checkbox').each(function () {
                        if (this.checked && $(this).val() !== "on") {
                            serviceIds.push($(this).val());
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        url: "{{route('admin.language.delete', ['language' => Config::get('language.current')])}}",
                        data: {
                            ids : serviceIds,
                            status : false,
                            _token : "{{csrf_token()}}"
                        }
                    }).done(function(data) {
                        if (data.status === true) {
                            if (data.status === true) {
                                window.location.href = "{{route('admin.language.all', ['language' => Config::get('language.current')])}}"
                            }
                        }
                    });
                }


                function deleteItem() {
                    var serviceIds = [];

                    $('._form-checkbox').each(function () {
                        if (this.checked && $(this).val() !== "on") {
                            serviceIds.push($(this).val());
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        url: "{{route('admin.language.delete', ['language' => Config::get('language.current')])}}",
                        data: {
                            ids : serviceIds,
                            _token : "{{csrf_token()}}"
                        }
                    }).done(function(data) {
                        if (data.status === true) {
                            $.each(serviceIds, function (index, value) {
                                $('#category-item-'+value).hide();
                            })

                        }
                    });
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

                function addDelete() {
                    var linksDel = document.querySelectorAll("._link-del");
                    for(var j = 0; j < linksDel.length; j++) {
                        linksDel[j].addEventListener("click", function(e) {
                            this.closest(".category-item").remove();

                            var mass = [];
                            mass = this.closest(".category-item").id.split('-');

                            $.ajax({
                                type: "DELETE",
                                url: "{{route('admin.category.delete', ['language' => Config::get('language.current')])}}",
                                data: {
                                    id : mass[2],
                                    _token : "{{csrf_token()}}"
                                }
                            }).done(function(data) {

                            });

                        })
                    }
                }

                function addEdit() {
                    var linksEdit = document.querySelectorAll("._link-edit"),
                        linkAdd = document.querySelector(".category__block--add"),
                        nameInput = document.querySelector("#name"),
                        sortNumInput = document.querySelector("#sortnum"),
                        statusInput = document.querySelector("#status"),
                        descrTarea = document.querySelector("#descr"),
                        formHeader = document.querySelector(".add-service-header"),
                        addForm = document.querySelector(".add-service"),
                        formCloser = document.querySelector(".add-service-close");

                    for(var i = 0; i < linksEdit.length; i++) {
                        linksEdit[i].addEventListener("click", function(e) {
                            e.preventDefault();
                            formHeader.innerText = "Edit category";
                            var parent = this.closest(".category-item"),
                                existingName = parent.querySelector(".category-item-name").innerText,
                                // existingSort = parent.querySelector(".category-item-sort").innerText,
                                existingStatus = parent.querySelector(".category-item-status").innerText;
                            // existingDescr = parent.querySelector(".category-item-descr").innerText;
                            nameInput.value = existingName;
                            // sortNumInput.value = existingSort;
                            statusInput.value = existingStatus;
                            // descrTarea.value = existingDescr;

                            putOverlay();
                            addForm.classList.add("active");
                            const hideForm = () => {
                                overlay.remove();
                                addForm.classList.remove("active");
                            }

                            const hideByOutside = (e) => {
                                if(!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-edit")) && !(e.target.classList.contains("category__block--add")) && !(e.target.classList.contains('lang-delete'))){
                                    hideForm();
                                    e.target.removeEventListener("click", hideByOutside)
                                }
                            }

                            const hideByKey = (e) => {
                                if(e.keyCode === 27) {
                                    hideForm();
                                    e.target.removeEventListener("click", hideByKey)
                                }
                            }

                            var overlay = document.querySelector(".madeup-overlay");

                            formCloser.addEventListener("click", hideForm);
                            document.addEventListener("click", hideByOutside);
                            document.addEventListener("keydown", hideByKey);
                        });
                    }
                    linkAdd.addEventListener("click", function() {
                        putOverlay();

                        addForm.classList.add("active");

                        var overlay = document.querySelector(".madeup-overlay");
                        const hideForm = () => {
                            overlay.remove();
                            addForm.classList.remove("active");
                        }

                        const hideByOutside = (e) => {
                            if(!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-edit")) && !(e.target.classList.contains("category__block--add")) && !(e.target.classList.contains('lang-delete'))) {
                                hideForm();
                                e.target.removeEventListener("click", hideByOutside)
                            }
                        }

                        const hideByKey = (e) => {
                            if(e.keyCode === 27) {
                                hideForm();
                                e.target.removeEventListener("click", hideByKey)
                            }
                        }

                        formCloser.addEventListener("click", hideForm);
                        document.addEventListener("click", hideByOutside);
                        document.addEventListener("keydown", hideByKey);
                    })
                }

                function addPreview() {
                    let previewField = document.querySelector(".supported-preview"),
                        supportedSelect = document.querySelector("#supported");
                    supportedSelect.addEventListener("change", () => {
                        let lang = document.createElement("div"),
                            langsAdded = document.querySelectorAll(".preview-item");
                        for(let i = 0; i < langsAdded.length - 1; i++) {
                            if(langsAdded[i].innerText === supportedSelect.value) {
                                return;
                            }
                        }
                        lang.classList.add("preview-item");
                        lang.innerText = supportedSelect.value;
                        previewField.appendChild(lang);
                    });
                }

                // addPreview();
                addDelete();
                addEdit();

                let addCountryBtn = document.querySelector('.add-country'),
                    countriesList = document.querySelector(".supported-countries"),
                    countryIdx = 0,
                    selectedValues = {};

                addCountryBtn.addEventListener("click", () => {
                    let selects = document.querySelectorAll(".select-supported");
                    for(let j = 0; j < selects.length - 1; j++) {
                        if(selects[j].style.display !== "none") {
                            return;
                        }
                    }
                    let countrySelector = document.createElement("div");
                    countrySelector.classList.add("select-supported", "mt-2");
                    countrySelector.style.display = "block !important";
                    countrySelector.innerHTML = `
                        <select name="supported_countries[]" id="supported${countryIdx}" class="form-select">
                            <option value="" selected disabled>Select countries</option>
                            @foreach($countries as $key => $country)
                                <option value="{{$key}}">{{$country}}</option>
                            @endforeach
                        </select>
                    `;
                    addCountryBtn.after(countrySelector);

                    countrySelector.addEventListener("change", () => {
                        let select = countrySelector.querySelector("select"),
                            deleteBtn = document.createElement("span"),
                            country = document.createElement("li");
                        deleteBtn.innerText = "🗑️",
                        deleteBtn.classList.add("lang-delete");

                        for(let existingValue of Object.values(selectedValues)) {
                            if(existingValue === select.options[select.selectedIndex].value) {
                                return;
                            }
                        }

                        country.innerText = select.options[select.selectedIndex].value;
                        country.appendChild(deleteBtn);

                        countriesList.appendChild(country);
                        countrySelector.style.display = "none";
                        countryIdx++;

                        deleteBtn.addEventListener("click", (e) => {
                            let target = e.target;
                            target.parentElement.remove();
                            countryIdx++;
                        });
                    });
                });
            </script>
 @stop
