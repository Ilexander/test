@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>

    <div class="add-service">
        <form method="POST" action="#" id="faqCreateForm">
            @csrf
            <div class="add-service-header-block">
                <div class="add-service-header" id="faqFormLabel">Edit QA</div>
                <div class="add-service-close">
                    <div class="cross"></div>
                </div>
                <div id="faqFormMethod"></div>
                <div id="faqFormFaqId"></div>
            </div>
            <hr>

            <div class="tab">
                @foreach($languages as $language)
{{--                    {{dd($language->toArray())}}--}}
                    <button type="button" class="tablinks" onclick="openCity(event, {{$language->id}})">
                        {{$language->name}}
                    </button>
                @endforeach
            </div>

            @foreach($languages as $language)
                <div id="{{$language->id}}" class="tabcontent">
                    <div class="input-group mt-2">
                        <label for="question" style="width: 100%">Question {{$language->name}}</label>
                        <input
                            type="text"
                            name="{{$language->name}}[question]"
                            class="form-control"
                            id="faqFormQuestion{{$language->id}}"
                        >
                    </div>
                    <div class="input-group mt-2">
                        <label for="answer" style="width: 100%">Answer {{$language->name}}</label>
                        <input
                            type="text"
                            name="{{$language->name}}[answer]"
                            class="form-control"
                            id="faqFormAnswer{{$language->id}}"
                        >
                    </div>
                </div>
            @endforeach


            <div class="add-service-buttons mt-2">
                <button type="submit" class="btn btn-success me-3 mt-2">Submit</button>
                <button type="reset" class="btn btn-danger me-3 mt-2">Cancel</button>
            </div>
        </form>
    </div>

    <div class="faq__block mt-3">
        <div class="faq__block--body _section-block pb-4">
            <div class="faq__block--header _section-block-header">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="error" style="color: firebrick">{{$error}}</div>
                    @endforeach
                @endif
                <h2 class="faq__block--title _title ps-4 pt-1 pb-1 rtl-text-container">
                    FAQs
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <a
                            onclick="addFaq()"
                            href="#"
                            style="text-decoration:none; font-size:20px;"
                            class="_link-edit"
                        >
                            + Add new
                        </a>
                    @endif
                </h2>
            </div>
            <ul class="faq__block--list faq__list ps-2 pe-2 ps-sm-4 pe-sm-4">
                @foreach($faqs as $faq)

                    @php
                        $hasTranslate = false;
                    @endphp

                    @foreach($faq->translation as $translation)

                        @if(strtolower($translation->language->alt) === Config::get('language.current'))
                            <li class="faq__item _slide-item mt-3 mb-3 " id="faq{{$faq->id}}">
                                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                    <div class="faq-item-textcontainer">
                                        <a
                                            onclick="editFaq({{$faq->id}})"
                                            href="#"
                                            style="text-decoration:none; font-size:20px;"
                                            class="_link-edit"
                                        >
                                            Edit
                                        </a>
                                        <a
                                            onclick="removeFaq({{$faq->id}})"
                                            href="#"
                                            style="text-decoration:none; font-size:20px;"
                                            class="_link-edit"
                                        >
                                            Delete
                                        </a>
                                    </div>
                                @endif

                                <div class="faq__item--body">
                                    <h3 class="faq__item--title _slide-btn _title _min p-4 pe-5">
                                        {{$translation->title}}
                                    </h3>
                                    <div class="faq__item--content _slide-content">
                                        <div class="faq__item--content-body ps-2 pe-4 pb-4 ps-sm-4">
                                            {{$translation->context}}
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @php
                                $hasTranslate = true;
                            @endphp
                        @endif
                    @endforeach

                    @if(!$hasTranslate)
                        <li class="faq__item _slide-item mt-3 mb-3 " id="faq{{$faq->id}}">
                            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                <div class="faq-item-textcontainer">
                                    <a
                                        onclick="editFaq({{$faq->id}})"
                                        href="#"
                                        style="text-decoration:none; font-size:20px;"
                                        class="_link-edit"
                                    >
                                        Edit
                                    </a>
                                    <a
                                        onclick="removeFaq({{$faq->id}})"
                                        href="#"
                                        style="text-decoration:none; font-size:20px;"
                                        class="_link-edit"
                                    >
                                        Delete
                                    </a>
                                </div>
                            @endif

                            <div class="faq__item--body">
                                <h3 class="faq__item--title _slide-btn _title _min p-4 pe-5">
                                    {{$faq->question}}
                                </h3>
                                <div class="faq__item--content _slide-content">
                                    <div class="faq__item--content-body ps-2 pe-4 pb-4 ps-sm-4">
                                        {{$faq->answer}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                @endforeach
            </ul>
        </div>
    </div>

    <script>
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())

            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            function addFaq()
            {
                $('#faqFormMethod').html('');
                $('#faqFormFaqId').html('');
                $('#faqCreateForm').attr('action', '{{route('admin.faq.create', ['language' => Config::get('language.current')])}}');

                $('#faqFormQuestion1').val('');
                $('#faqFormAnswer1').val('');
            }

            function editFaq(faqId)
            {
                $('#faqFormLabel').html('Edit Blog');
                $('#faqFormMethod').html('<input type="hidden" name="_method" value="PUT" />');
                $('#faqFormFaqId').html('<input type="hidden" name="id" value="'+faqId+'" />');
                $('#faqCreateForm').attr('action', '{{route('admin.faq.update', ['language' => Config::get('language.current')])}}');

                $.ajax({
                    type: "GET",
                    url: "{{route('admin.faq.info', ['language' => Config::get('language.current')])}}",
                    data: {
                        id : faqId,
                        _token : "{{csrf_token()}}"
                    }
                }).done(function(data) {

                    $('#faqFormQuestion1').val(data.data.question);
                    $('#faqFormAnswer1').val(data.data.answer);

                    $.each(data.translate, function( index, language ) {
                        $('#faqFormQuestion'+language.language_id).val(language.title)
                        $('#faqFormAnswer'+language.language_id).val(language.context)
                    });
                });
            }

            function removeFaq(faqId)
            {
                $.ajax({
                    type: "DELETE",
                    url: "{{route('admin.faq.delete', ['language' => Config::get('language.current')])}}",
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
        @endif

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
                addForm = document.querySelector(".add-service"),
                formCloser = document.querySelector(".add-service-close");

            for(var i = 0; i < linksEdit.length; i++) {
                linksEdit[i].addEventListener("click", function(e) {
                    e.preventDefault();

                    putOverlay();
                    addForm.classList.add("active");
                    const hideForm = () => {
                        overlay.remove();
                        addForm.classList.remove("active");
                    }

                    const hideByOutside = (e) => {
                        if(!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-edit")) && !(e.target.classList.contains("category__block--add"))){
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
                    if(!(e.target.closest(".add-service")) && !(e.target.classList.contains("_link-edit")) && !(e.target.classList.contains("category__block--add"))) {
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

        addEdit();
    </script>
@stop
