@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    <div class="api__article mt-3">
        <div class="api__article--body _section-block">
            <div class="api__article--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                <div class="api__article--row _section-panel-active">
                    <h2 class="api__article--title _title">
                        {{ __('locale.api.api_documentation') }}
                    </h2>
                    <div class="api__article--panel _section-panel">
                        <div class="_section-panel-body pe-4 me-1">
                            <a href="#" class="_section-panel-link _hide-block-btn me-5 _link">
                                <span class="_section-panel-icon _icon-arrow _rotate90"></span>
                            </a>
                            <a href="#" class="_section-panel-link _remove-block-btn ms-3 _link">
                                <span class="_section-panel-icon _icon-close"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="api__article--block api-block p-2 p-sm-4 pb-1">
            <span class="api-block__title pb-2">
                {{ __('locale.api.note') }}
            </span>
                <div class="api-block__table">
                    <div class="api-block__table--block _header-active">
                        <div class="api-block__table--item">
                            HTTP Method
                        </div>
                        <div class="api-block__table--item">
                            POST
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            Response format
                        </div>
                        <div class="api-block__table--item">
                            JSON
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            API URL
                        </div>
                        <div class="api-block__table--item">
                            https://follow.sale/api/v1
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            API Key
                        </div>
                        <div class="api-block__table--item">
                            y6gbqAsQK6hLXhNETvIV5bPEf8nBPvQo
                        </div>
                    </div>
                </div>
            </div>
            <div class="api-block__footer p-2 p-sm-4 pb-3">
                <a href="https://{{request()->getHttpHost()}}/public/example.txt" download class="api-block__link _btn _large-btn ps-5 pe-5">
                    {{ __('locale.api.button') }}
                </a>
            </div>
        </div>
    </div>
    <div class="api__article mt-3">
        <div class="api__article--body _section-block">
            <div class="api__article--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                <div class="api__article--row _section-panel-active">
                    <h2 class="api__article--title _title">
                        Place new Order
                    </h2>
                    <div class="api__article--panel _section-panel">
                        <div class="_section-panel-body pe-4 me-1">
                            <a href="#" class="_section-panel-link _hide-block-btn me-5 _link">
                                <span class="_section-panel-icon _icon-arrow _rotate90"></span>
                            </a>
                            <a href="#" class="_section-panel-link _remove-block-btn ms-3 _link">
                                <span class="_section-panel-icon _icon-close"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="api__article--block api-block p-2 p-sm-4 pb-1">
                <form action="#" class="api-block__form pb-2">
                    <label class="api-block__label _form-label">
                    <span class="api-block__label--body _form-elem-wrapper">
                        <span class="api-block__label--icon _form-icon _icon-arrow"></span>
                        <select name="api-select" class="api-block__select _form-select">
                            <option value="api-select-1" checked>Default</option>
                            <option value="api-select-1">api-select-1</option>
                            <option value="api-select-2">api-select-2</option>
                            <option value="api-select-3">api-select-3</option>
                        </select>
                    </span>

                    </label>
                </form>
                <div class="api-block__table">
                    <div class="api-block__table--block _header-block">
                        <div class="api-block__table--item">
                            Parameter
                        </div>
                        <div class="api-block__table--item">
                            Description
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            key
                        </div>
                        <div class="api-block__table--item">
                            Your API key
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            action
                        </div>
                        <div class="api-block__table--item">
                            add
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            service
                        </div>
                        <div class="api-block__table--item">
                            Service ID
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            link
                        </div>
                        <div class="api-block__table--item">
                            Link to page
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            quantity
                        </div>
                        <div class="api-block__table--item">
                            Needed quantity
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            runs (optional)
                        </div>
                        <div class="api-block__table--item">
                            Runs to deliver
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            interval (optional)
                        </div>
                        <div class="api-block__table--item">
                            Interval in minutes
                        </div>
                    </div>
                </div>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example request:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
                            <pre class="api-block__code--body p-3">
{

    https://{{
                    request()->getHost().
                    '/api/v1?key='.
                    Auth::user()->api_key.
                    '&action=add&service='.\App\Models\Service::query()->first()->id.
                    '&link=some_your_link&quantity=200'
                }}
}
            </pre>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example response:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
            <pre class="api-block__code--body p-3">
{
    "status": "success",
    "order": 32
}
            </pre>
            </div>
        </div>
    </div>
    <div class="api__article mt-3">
        <div class="api__article--body _section-block">
            <div class="api__article--header _section-block-header">
                <h2 class="api__article--title _title ps-2 ps-sm-4 pt-2 pb-2">
                    Multiple orders status
                </h2>
            </div>
            <div class="api__article--block api-block p-2 p-sm-4 pb-1">
                <div class="api-block__table">
                    <div class="api-block__table--block _header-block">
                        <div class="api-block__table--item">
                            Parameter
                        </div>
                        <div class="api-block__table--item">
                            Description
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            key
                        </div>
                        <div class="api-block__table--item">
                            Your API key
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            action
                        </div>
                        <div class="api-block__table--item">
                            status
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            orders
                        </div>
                        <div class="api-block__table--item">
                            Order IDs separated by comma (array data)
                        </div>
                    </div>
                </div>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example request:
            </span>

            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
                <pre class="api-block__code--body p-3">
{
    https://{{
        request()->getHost().
        '/api/v1?key='.
        Auth::user()->api_key.
        '&action=status&orders=389721,389722'
    }}
}
                </pre>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example response:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
            <pre class="api-block__code--body p-3">
{
    "12": {
        "order": "12",
        "status": "processing",
        "charge": "1.2600",
        "start_count": "0",
        "remains": "0"
    },
    "2": "Incorrect order ID",
    "13": {
        "order": "13",
        "status": "pending",
        "charge": "0.6300",
        "start_count": "0",
        "remains": "0"
    }
}
</pre>
            </div>
        </div>
    </div>
    <div class="api__article mt-3">
        <div class="api__article--body _section-block">
            <div class="api__article--header _section-block-header">
                <h2 class="api__article--title _title ps-2 ps-sm-4 pt-2 pb-2">
                    Services Lists
                </h2>
            </div>
            <div class="api__article--block api-block p-2 p-sm-4 pb-1">
                <div class="api-block__table">
                    <div class="api-block__table--block _header-block">
                        <div class="api-block__table--item">
                            Parameter
                        </div>
                        <div class="api-block__table--item">
                            Description
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            key
                        </div>
                        <div class="api-block__table--item">
                            Your API key
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            action
                        </div>
                        <div class="api-block__table--item">
                            services
                        </div>
                    </div>
                </div>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example request:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
                <pre class="api-block__code--body p-3" style="white-space: pre-wrap;">
{
  https://{{
      request()->getHost().
      '/api/v1?key='.
      Auth::user()->api_key.
      '&action=services'
  }}
}
                </pre>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example response:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
            <pre class="api-block__code--body p-3" style="white-space: pre-wrap;">
[
    {
        "service": "5",
        "name": "Instagram Followers [15K] ",
        "category": "Instagram - Followers [Guaranteed\/Refill] - Less Drops \u2b50",
        "rate": "1.02",
        "min": "500",
        "max": "10000"
        "type": default
        "desc": usernames
        "dripfeed": 1
    },
    {
        "service": "9",
        "name": "Instagram Followers - Max 300k - No refill - 30-40k\/Day",
        "category": "Instagram - Followers [Guaranteed\/Refill] - Less Drops \u2b50",
        "rate": "0.04",
        "min": "500",
        "max": "300000"
        "type": default
        "desc": usernames
        "dripfeed": 1
    },
    {
        "service": "10",
        "name": "Instagram Followers ( 30 days auto refill ) ( Max 350K ) (Indian Majority )",
        "category": "Instagram - Followers [Guaranteed\/Refill] - Less Drops \u2b50",
        "rate": "1.2",
        "min": "100",
        "max": "350000"
        "type": default
        "desc": usernames
        "dripfeed": 1
    }
]
</pre>
            </div>
        </div>
    </div>
    <div class="api__article mt-3">
        <div class="api__article--body _section-block">
            <div class="api__article--header _section-block-header">
                <h2 class="api__article--title _title ps-2 ps-sm-4 pt-2 pb-2">
                    Balance
                </h2>
            </div>
            <div class="api__article--block api-block p-2 p-sm-4 pb-1">
                <div class="api-block__table">
                    <div class="api-block__table--block _header-block">
                        <div class="api-block__table--item">
                            Parameter
                        </div>
                        <div class="api-block__table--item">
                            Description
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            key
                        </div>
                        <div class="api-block__table--item">
                            Your API key
                        </div>
                    </div><div class="api-block__table--block ">
                        <div class="api-block__table--item">
                            action
                        </div>
                        <div class="api-block__table--item">
                            balance
                        </div>
                    </div>
                </div>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example request:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
                <pre class="api-block__code--body p-3">
{
    https://{{
   request()->getHost().
   '/api/v1?key='.
   Auth::user()->api_key.
   '&action=balance'
    }}
}
                </pre>
            </div>
            <span class="api-block__title pt-2 pb-3 ps-2 pe-2 ps-sm-4 pe-sm-4">
                Example response:
            </span>
            <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
            <pre class="api-block__code--body p-3">
{
    "status": "success",
    "balance": "0.03",
    "currency": "USD"
}
</pre>
            </div>
        </div>
    </div>

    <script>
        const toggleOpen = (e) => {

            let target = e.target,
                contentBlock = target.closest(".api__article--body");

            if(contentBlock.classList.contains("disabled")) {
                contentBlock.classList.remove("disabled");
            } else {
                contentBlock.classList.add("disabled");
            }

        }

        const closeBlock = (e) => {

            let target = e.target,
                contentBlock = target.closest(".api__article--body");

            contentBlock.style.display = "none";

        }

        let togglers = document.querySelectorAll("._icon-arrow");
        for(let i = 0; i < togglers.length; i++) {
            togglers[i].addEventListener("click", toggleOpen);
        }

        let closers = document.querySelectorAll("._icon-close");
        for(let i = 0; i < closers.length; i++) {
            closers[i].addEventListener("click", closeBlock);
        }
    </script>
@stop
