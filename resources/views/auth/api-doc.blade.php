<!DOCTYPE html>
<html lang="{{strtolower(Config::get('app.locale'))}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Follow Sale - API Documentation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <x-page-orientation/>
    <link rel="stylesheet" href="{{asset('admin/sass/secondary.min.css')}}">
</head>
<body>
<div class="preloader">
    <picture><source srcset="{{asset('new/img/logo.svg')}}" type="image/webp"><img src="{{asset('new/img/logo.svg')}}"></picture>
</div>
<div class="api-image">

</div>

<div class="popup">
    <div class="popup-close">
        <div class="popup-cross"></div>
    </div>
    <x-user-register/>
</div>
@include('auth.header')

<div class="api-content">
    <div class="api-wrapper">
        <div class="api-drop-down api-drop-down-active">
            <div class="api-header-block">
                <div class="api-header-text">API Documentation</div>
                <div class="api-toggler api-toggler-active"></div>
            </div>
            <div class="api-note">Note: Please read the API intructions carefully. Its your solo responsability what you add by our API.</div>
            <div class="api-item api-item-small api-item-descr">
                <div class="api-column api-column-small">HTTP Method</div>
                <div class="api-column">POST</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">Response format</div>
                <div class="api-column">JSON</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">API URL</div>
                <div class="api-column">https://follow.sale/api/v1</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">API Key</div>
                <div class="api-column">-</div>
            </div>
            <div class="api-btn">
                <button class="api-download">
                    <a
                        href="{{route('user.dashboard', ['language' => Config::get('app.locale')])}}/example.txt"
                        download="proposed_file_name"
                        style="text-decoration: none; color: #ed017f"
                    >
                        Download PHP code example
                    </a>

                </button>
            </div>
        </div>
        <div class="api-drop-down api-drop-down-active">
            <div class="api-header-block">
                <div class="api-header-text">Place new order</div>
                <div class="api-toggler"></div>
            </div>
            <div class="api-item api-item-small api-item-dd">
                <div class="api-column api-column-small">Default</div>
                <div class="api-toggler-dd"></div>
            </div>
            <div class="api-item api-item-small api-item-descr">
                <div class="api-column api-column-small">Parameter</div>
                <div class="api-column">Description</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">key</div>
                <div class="api-column">Your API key</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">action</div>
                <div class="api-column">add</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">service</div>
                <div class="api-column">Service ID</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">link</div>
                <div class="api-column">Link to page</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">quantity</div>
                <div class="api-column">Needed quantity</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">runs (optional)</div>
                <div class="api-column">Runs to deliver</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">interval (optional)</div>
                <div class="api-column">Interval in minutes</div>
            </div>
            <div class="api-example">
                <div class="api-example-text">
                    Example response:
                </div>
                <div class="api-example-img"></div>
            </div>
        </div>
        <div class="api-drop-down api-drop-down-active">
            <div class="api-header-block">
                <div class="api-header-text">Multiple orders status</div>
                <div class="api-toggler"></div>
            </div>
            <div class="api-item api-item-small api-item-dd">
                <div class="api-column api-column-small">Default</div>
                <div class="api-toggler-dd"></div>
            </div>
            <div class="api-item api-item-small api-item-descr">
                <div class="api-column api-column-small">Parameter</div>
                <div class="api-column">Description</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">key</div>
                <div class="api-column">Your API key</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">action</div>
                <div class="api-column">status</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">orders</div>
                <div class="api-column">Order IDs separated by comma (array data)</div>
            </div>
            <div class="api-example">
                <div class="api-example-text">
                    Example response:
                </div>
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
        <div class="api-drop-down api-drop-down-active">
            <div class="api-header-block">
                <div class="api-header-text">Services Lists</div>
                <div class="api-toggler"></div>
            </div>
            <div class="api-item api-item-small api-item-dd">
                <div class="api-column api-column-small">Default</div>
                <div class="api-toggler-dd"></div>
            </div>
            <div class="api-item api-item-small api-item-descr">
                <div class="api-column api-column-small">Parameter</div>
                <div class="api-column">Description</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">key</div>
                <div class="api-column">Your API key</div>
            </div>
            <div class="api-item api-item-small">
                <div class="api-column api-column-small">action</div>
                <div class="api-column">services</div>
            </div>
            <div class="api-example">
                <div class="api-example-text">
                    Example response:
                </div>
                <div class="api-block__code ps-2 pe-2 ps-sm-4 pe-sm-4">
            <pre class="api-block__code--body p-3">
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
    </div>
</div>

@include('auth.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('new/main.js')}}"></script>
</body>
</html>
