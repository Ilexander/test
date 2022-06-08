@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
    @if($user->isAdmin())
        <div class="statistics__main-info mt-2">
            <div class="statistics__main-info--list row">
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.balance') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                ${{$user->balance}}
                                {{--                                <span class="statistics__info-min-item--procent">+55%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-1.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                    <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                        <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                            <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_amount_spend') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                ${{$user->getSpentAmount()}}
                                {{--                                <span class="statistics__info-min-item--procent">+5%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-2.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_orders') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$blocksData['orders']}}
                                {{--                                <span class="statistics__info-min-item--procent">+20%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-3.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_tickets') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$blocksData['tickets']}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-4.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_users_balance') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                ${{$blocksData['total_users_balance']}}
                                {{--                                <span class="statistics__info-min-item--procent">+55%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-5.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_providers_balance') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                ${{$blocksData['total_providers_balance']}}
                                {{--                                <span class="statistics__info-min-item--procent">+5%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-6.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_profit_30_days') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$blocksData['monthly_profit']}}
                                {{--                                <span class="statistics__info-min-item--procent">+20%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-7.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_profit_today') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$blocksData['today_profit']}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1-7.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    @if(!$user->isAdmin())
        <div class="statistics__info mt-2">
            <div class="statistics__info--list row">
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_orders') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['total_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-5.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.completed') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['completed_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-6.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.processing') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['processing_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-7.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.in_progress') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['inprogress_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-8.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.pending') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['pending_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-9.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.partial') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['partial_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-10.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.canceled') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['canceled_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-11.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.refunded') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['refunded_orders_count']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-12.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="statistics__chart mt-4">
        @if(!$user->isAdmin())
            <div class="statistics__chart--body _section-elem">
                <h2 class="statistics__chart--title _title mb-4 pb-2 ps-sm-4 pb-sm-4 ps-4 pb-4">
                    {{ __('locale.statistics.recent_orders') }}
                </h2>

                {!! $weeklyChart->container() !!}
                <script src="{{ $weeklyChart->cdn() }}"></script>
                {{ $weeklyChart->script() }}
            </div>
        @endif


        @if($user->isAdmin())
            <div class="statistics__chart--row row">
                <h2 class="statistics__chart--title _title mb-4 pb-2 ps-sm-4 pb-sm-4 ps-4 pb-4">
                    {{ __('locale.statistics.recent_orders') }}
                </h2>
                <div class="statistics__chart--item _line-chart col-12 col-xl-6">
                    <div class="statistics__chart--body _section-elem">
                        {!! $weeklyChart->container() !!}
                        <script src="{{ $weeklyChart->cdn() }}"></script>
                        {{ $weeklyChart->script() }}
                    </div>
                </div>
                <div class="statistics__chart--item _pie-chart col-12 col-xl-6 mt-3 mt-xl-0">
                    <div class="statistics__chart--body _section-elem">
                        {!! $chart->container() !!}
                        <script src="{{ $chart->cdn() }}"></script>
                        {{ $chart->script() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if($user->isAdmin())
        <div class="statistics__info mt-2">
            <div class="statistics__info--list row">
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_orders') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$blocksData['orders']}}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-5.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.completed') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_COMPLETED])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_COMPLETED]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-6.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.processing') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PROCESSING])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PROCESSING]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-7.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.in_progress') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_IN_PROGRESS])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_IN_PROGRESS]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-8.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.pending') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PENDING])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PENDING]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-9.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.partial') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                               {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PARTIAL])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_PARTIAL]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-10.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.canceled') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_CANCELED])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_CANCELED]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-11.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__info--item statistics__info-min-item col-sm-6 col-lg-6 col-xl-4 mt-3">
                    <div class="statistics__info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.refunded') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{
                                    ( isset($blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_REFUNDED])
                                    ? $blocksData['orders_statistics'][\App\Models\Order::ORDER_STATUS_REFUNDED]->count : 0)
                                }}
                            </span>
                        </div>
                        <div class="statistics__info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-12.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(!$user->isAdmin())
        <div class="statistics__projects mt-3">
            <div class="statistics__projects--body _section-block">
                <div class="statistics__projects--header _section-block-header">
                    <h2 class="statistics__projects--title _title ps-4 ms-3">
                        {{ __('locale.statistics.services.services') }}
                    </h2>
                </div>
                <div class="statistics__projects--block project-block pt-4">
                    <div class="project-block__body _scrollbar-styles">
                        <div class="statistics__projects--info project-block__info ps-3 pe-3">
                            <div class="project-block__param _id">
                                {{ __('locale.statistics.services.id') }}
                            </div>
                            <div class="project-block__param _name ps-4 pe-4">
                                {{ __('locale.statistics.services.name') }}
                            </div>
                            <div class="project-block__param _rate ms-4 me-4">
                                {{ __('locale.statistics.services.rate_per_1000') }}
                            </div>
                            <div class="project-block__param _min-max ms-4 me-4">
                                {{ __('locale.statistics.services.min_max_order') }}
                            </div>
                            <div class="project-block__param _descr ms-4 me-4">
                                {{ __('locale.statistics.services.description') }}
                            </div>
                        </div>
                        <ul class="statistics__projects--list project-block__list">
                            @foreach($topBestsellers as $topBestseller)
                                <li class="statistics__projects--item project-block__item p-3 pt-2 pb-2">
                                    <div class="project-block__item--body row align-items-center">
                                        <div class="project-block__item--id col-2">
                                            {{$topBestseller->id}}
                                        </div>
                                        <div class="project-block__item--name ps-3 pe-4 col">
                                            {{$topBestseller->name}}
                                        </div>
                                        <div class="project-block__item--value _rate ms-4 me-4 col-1">
                                            ${{$topBestseller->price}}
                                        </div>
                                        <div class="project-block__item--value _min-max ms-4 me-4 col-1">
                                            {{$topBestseller->min}} / {{$topBestseller->max}}
                                        </div>
                                        <div class="project-block__item--detail ms-4 me-4 col-2">
                                            <a href="#project-popup-{{$topBestseller->id}}" class="project-block__item--btn _btn _btn-popup">
                                                {{ __('locale.statistics.services.details') }}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <div class="project-block__popup _popup" id="project-popup-{{$topBestseller->id}}">
                                    <div class="_popup-wrapper">
                                        <div class="project-block__popup--bg _popup-bg"></div>
                                        <div class="project-block__popup--body _popup-body">
                                            <button type="button" class="project-block__popup--close-btn _popup-close-btn">
                                                ✕
                                            </button>
                                            <h2 class="project-block__popup--title _title text-center _popup-title">
                                                {!! str_replace('|', '<br/>', $topBestseller->name) !!}
                                            </h2>
                                            <div class="project-block__popup--content">
                                                <ul>
                                                    @php
                                                        $list = '';
                                                        $desc = explode('if you want a special price - write to tickets', $topBestseller->desc);

                                                        foreach (explode("\r\n", $desc[0]) as $item) {
                                                            if (stripos($item, "[") !== false) {

                                                                $element = explode("[", $item);

                                                                if (stripos($element[0], "]") === false) {
                                                                    $list .= "<li>".$element[0]."</li>";
                                                                }

                                                                $element = explode("]", $element[1]);

                                                                foreach (explode('|', $element[0]) as $value) {
                                                                    if ($value !== '') {
                                                                        $list .= "<li>".$value."</li>";
                                                                    }
                                                                }

                                                                if ( isset($element[1]) && $element[1]) {
                                                                    $list .= "<li>".$element[1]."</li>";
                                                                }

                                                            } else {
                                                                if ($item !== '' && $item !== '🔔') {
                                                                    $list .= "<li>".$item."</li>";
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    {!! $list !!}
                                                </ul>
                                                <div class="popup__wrapper">
                                                    <button
                                                        class="popup__btn popup__order"
                                                        onclick="window.location.href = '{{route('user.order.new', ['language' => Config::get('language.current')])}}'"
                                                    >
                                                        Make order
                                                    </button>
                                                    <button class="popup__btn popup__close">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="statistics__main-info mt-2">
            <div class="statistics__main-info--list row">
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-3 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.your_balance') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                ${{$user->balance}}{{-- <span class="statistics__info-min-item--procent">+55%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-1.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-3 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_amount_spend') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                ${{$user->getSpentAmount()}}{{--<span class="statistics__info-min-item--procent">+5%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-2.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-3 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_orders') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['total_orders_count']}}{{--<span class="statistics__info-min-item--procent">+20%</span>--}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-3.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
                <div class="statistics__main-info--item statistics__info-min-item col-sm-6 col-lg-3 mt-3">
                    <div class="statistics__main-info-item--body statistics__info-min-item--body _section-elem">
                        <div class="statistics__main-info-item--block statistics__info-min-item--block">
                            <span class="statistics__info-min-item--title">
                                {{ __('locale.statistics.total_tickets') }}
                            </span>
                            <span class="statistics__info-min-item--value">
                                {{$userBlocksData['total_tickets_count']}}
                            </span>
                        </div>
                        <div class="statistics__main-info-item--icon statistics__info-min-item--icon">
                            <img src="{{asset('admin/img/statistics/icon-4.svg')}}" width="20" alt="" class="statistics__main-info-item--img statistics__info-min-item--img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @foreach($topBestsellers as $topBestseller)
        <div class="project-block__popup _popup" id="project-popup-{{$topBestseller->id}}">
            <div class="_popup-wrapper">
                <div class="project-block__popup--bg _popup-bg"></div>
                <div class="project-block__popup--body _popup-body">
                    <button type="button" class="project-block__popup--close-btn _popup-close-btn">
                        ✕
                    </button>
                    <h2 class="project-block__popup--title _title text-center _popup-title">
                        {{$topBestseller->name}}
                    </h2>
                    <div class="project-block__popup--content">
                      <ul>
    <li>
        NOT BOT | Instagram likes
    </li>
    <li> Always stable</li>
    <li>Max: 300k</li>
    <li>Speed: 500-4000/h</li>
    <li>Extra delivery: 10%</li>
    <li><b>INSTANT</b> Delivery</li>
    <li>All have avatar</li>
    <li>All have min 2 posts</li>
</ul>
                        <!-- <p>
                            {{$topBestseller->desc}}
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if($user->isAdmin())

        <div class="statistics__chat mt-2">
            <div class="statistics__chat--row row">
                <div class="statistics__chat--block _users-block col-12 col-xl-3 col-md-4">
                    <div class="statistics__chat--users statistics__users _section-block p-0">
                        <div class="statistics__users--header _section-block-header ps-3 pe-3 pt-3">
                            <h2 class="statistics__users--title _title">
                                {{ __('locale.statistics.lists_of_tickets') }}
                            </h2>
                        </div>
                        <form action="{{route('admin.dashboard', ['language' => Config::get('app.locale')])}}" class="statistics__users--form p-3">
                            <div class="statistics__users--row d-flex">
                                <label class="statistics__users--label _form-label">
                                    <input type="text" name="search" placeholder="Search" class="statistics__users--search _form-input _form-search-input _min">
                                </label>
                                <button class="statistics__users--submit _icon-search _btn _form-search-btn _min" type="submit"></button>
                            </div>

                        </form>
                        <ul class="statistics__users--list _section-block-footer ps-0 m-0 p-0">

                            @foreach($ticketsList as $ticket)
                                @if($ticket->status !== \App\Models\Ticket::PROCESS_STATUS)
                                    <li
                                        id="ticketBlock{{$ticket->id}}"
                                        class="statistics__users--li supportBlockTickets"
                                        @switch($ticket->status)
                                        @case(\App\Models\Ticket::OPEN_STATUS)
                                        style="background-color: cornflowerblue"
                                        @break
                                        @case(\App\Models\Ticket::CLOSE_STATUS)
                                        style="background-color: grey"
                                        @break
                                        @case(\App\Models\Ticket::WAIT_FOR_ADMIN_ANSWER)
                                        style="background-color: coral"
                                        @break
                                        @case(\App\Models\Ticket::WAIT_FOR_USER_ANSWER)
                                        style="background-color: yellow"
                                        @break
                                        @endswitch
                                        onclick="showTicketMessages({{$ticket->id}})"
                                    >
                                    <span class="statistics__users--link p-3">
                                        #<span class="statistics__users--id ps-1 pe-2">{{$ticket->id}}</span> -
                                        <span class="statistics__users--name">{{$ticket->subject}}</span><br/>
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->first_name : ''}}</span>
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->last_name : ''}}</span> -
                                        <span class="statistics__users--name">{{$ticket->user ? $ticket->user->email : ''}}</span><br/>
                                        <span class="statistics__users--name">
                                            {{$ticket->created_at}}
{{--                                            {{Timezone::convertToLocal($ticket->created_at, 'Y-m-d H:i:s')}}--}}
                                        </span>
                                    </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="statistics__chat--block _chat-block col-12 col-xl-9 col-md-8 mt-md-0 mt-3">
                    <div class="statistics__chat--body _section-block p-0">
                        <div class="statistics__chat--header _section-block-header ps-3 pe-3 pt-3">
                            <h2 class="statistics__chat--title _title">
                                {{ __('locale.statistics.chat') }}
                            </h2>
                        </div>
                        <div id="ticketMessageAddingBlock" class="statistics__chat--place statistics__chat-place" style="display: none">
                            <div class="statistics__chat-place--list _scrollbar-styles pb-4 ps-3 pe-3 pt-4" id="showTicketMessage">

                            </div>
                            <form
                                action="{{route('admin.ticket.message.create', ['language' => Config::get('language.current')])}}"
                                class="statistics__chat-place--form p-3"
                                method="POST"
                            >
                                @csrf
                                <div id="ticketDisplayErrors"></div>
                                <label class="statistics__chat-place--label _form-label">
                                    <span class="statistics__chat-place--placeholder _form-placeholder">
                                        {{ __('locale.statistics.message') }}
                                    </span>
                                    <span class="statistics__chat-place--label-wrapper _form-elem-wrapper _textarea-wrapper">
                                        <span class="statistics__chat-place--icon _form-icon _icon-close _clear-input-btn"></span>
                                        <textarea id="newTicketMessageText" name="message" rows="3" placeholder="Share a reply" class="statistics__chat-place--textarea _form-textarea"></textarea>
                                    </span>
                                    <input type="hidden" id="currentTicketId" name="ticket_id">
                                </label>
                                <div class="statistics__chat-place--submit d-flex justify-content-end pt-3 pb-2">
                                    <button type="button" class="statistics__chat-place--submit-btn _btn _large-btn" onclick="addNewMessage()">
                                        {{ __('locale.statistics.send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="statistics__tab-section">
            <ul class="statistics__tab-section--tab-list _tab-list p-3 pt-4 pb-4 m-0 row justify-content-md-start justify-content-center">
                <li class="statistics__tab-section--tab-li col-auto">
                    <a href="#top-bestsellers" class="statistics__tab-section--tab-link _link p-3 pb-2 pt-2 _tab-link _active">
                        {{ __('locale.statistics.top_bestsellers.top_bestsellers') }}
                    </a>
                </li>
                <li class="statistics__tab-section--tab-li col-auto">
                    <a href="#last-5-users" class="statistics__tab-section--tab-link _link p-3 pb-2 pt-2 _tab-link">
                        {{ __('locale.statistics.last_5_newest_users.last_5_newest_users') }}
                    </a>
                </li>
                <li class="statistics__tab-section--tab-li col-auto">
                    <a href="#last-5-orders" class="statistics__tab-section--tab-link _link p-3 pb-2 pt-2 _tab-link">
                        {{ __('locale.statistics.last_5_orders.last_5_orders') }}
                    </a>
                </li>
            </ul>
            <ul class="statistics__tab-section--list p-0 m-0 _tab-wrapper _section-block">
                <li class="statistics__tab-section--item statistics__tab-item _tab-block _active _fade-in" id="top-bestsellers">
                    <div class="statistics__tab-item--body _section-block">
                        <div class="statistics__tab-item--header _section-block-header ps-3 pe-3 pb-2">
                            <h2 class="statistics__tab-item--title _title">
                                {{ __('locale.statistics.top_bestsellers.top_bestsellers') }}
                            </h2>
                        </div>
                        <div class="statistics__tab-section--wrapper _scrollbar-styles">
                            <table class="statistics__tab-section--table statistics__tab-table _table">
                                <colgroup>
                                    <col class="statistics__tab-table--col-1">
                                    <col class="statistics__tab-table--col-2">
                                    <col class="statistics__tab-table--col-3">
                                    <col class="statistics__tab-table--col-4">
                                    <col class="statistics__tab-table--col-5">
                                    <col class="statistics__tab-table--col-6">
                                    <col class="statistics__tab-table--col-7">
                                    <col class="statistics__tab-table--col-8">
                                    <col class="statistics__tab-table--col-9">
                                    <col class="statistics__tab-table--col-10">
                                </colgroup>
                                <thead>
                                <tr>
                                    <td class="bestsellers-cell pe-3 ps-4 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.id') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.name') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.total_orders') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2 text-center">
                                        {{ __('locale.statistics.top_bestsellers.type') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2 text-center">
                                        {{ __('locale.statistics.top_bestsellers.api_provider') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.api_service_id') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.rate_per_1000') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.min_max_order') }}
                                    </td>
                                    <td class="bestsellers-cell pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.status') }}
                                    </td>
                                    <td class="bestsellers-cell text-center pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.top_bestsellers.details') }}
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topBestsellers as $topBestseller)
                                    <tr class="statistics__tab-table--item">
                                        <td class="ps-4 pe-3 fw-bold pt-2 pb-2">
                                            {{$topBestseller->id}}
                                        </td>
                                        <td class="fw-bold pe-3 pt-2 pb-2">
                                            {{$topBestseller->name}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$topBestseller->total_orders}}
                                        </td>
                                        <td class="pe-3 text-center pt-2 pb-2 _dark-gray">
                                            {{$topBestseller->type}}
                                        </td>
                                        <td class="pe-3 text-center pt-2 pb-2 _dark-gray">
                                            {{$topBestseller->api_provider}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$topBestseller->api_service_id}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$topBestseller->price}}
                                            <span class="statistics__tab-table--min-value">{{$topBestseller->original_price}}</span>
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$topBestseller->min}} / {{$topBestseller->max}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2">
                                                <span
                                                    class="
                                                    statistics__tab-table--status
                                                    @if($topBestseller->status) _status-2 @else _status-1 @endif"
                                                >
                                                    @if(!$topBestseller->status) ❌ @else ✔️ @endif
                                                </span>
                                        </td>
                                        <td class="text-center pe-3 pt-2 pb-2">
                                            <a href="#project-popup-{{$topBestseller->id}}" class="statistics__tab-table--link _icon-details _btn _btn-popup"></a>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </li>
                <li class="statistics__tab-section--item statistics__tab-item _tab-block" id="last-5-users">
                    <div class="statistics__tab-item--body _section-block">
                        <div class="statistics__tab-item--header _section-block-header ps-3 pe-3 pb-2">
                            <h2 class="statistics__tab-item--title _title">
                                {{ __('locale.statistics.last_5_newest_users.last_5_newest_users') }}
                            </h2>
                        </div>
                        <div class="statistics__tab-section--wrapper _scrollbar-styles">
                            <table class="statistics__tab-section--table statistics__tab-table _table">
                                <colgroup>
                                    <col class="statistics__tab-table--col-1">
                                    <col class="statistics__tab-table--col-2">
                                    <col class="statistics__tab-table--col-3">
                                    <col class="statistics__tab-table--col-4">
                                    <col class="statistics__tab-table--col-5">
                                    <col class="statistics__tab-table--col-6">
                                    <col class="statistics__tab-table--col-7">
                                    <col class="statistics__tab-table--col-8">
                                    <col class="statistics__tab-table--col-9">
                                    <col class="statistics__tab-table--col-10">
                                </colgroup>
                                <thead>
                                <tr>
                                    <td class="pe-3 ps-4 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_newest_users.id') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_newest_users.name') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_newest_users.email') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2 text-center">
                                        {{ __('locale.statistics.last_5_newest_users.type') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2 text-center">
                                        {{ __('locale.statistics.last_5_newest_users.funds') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_newest_users.last_ip_address') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_newest_users.created') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_newest_users.status') }}
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lastUsers as $lastUser)
                                    <tr class="statistics__tab-table--item">
                                        <td class="ps-4 pe-3 fw-bold pt-2 pb-2">
                                            {{$lastUser->id}}
                                        </td>
                                        <td class="fw-bold pe-3 pt-2 pb-2">
                                            {{mb_substr($lastUser->full_name, 0, 100)}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{mb_substr($lastUser->email, 0, 100)}}
                                        </td>
                                        <td class="pe-3 text-center pt-2 pb-2 _dark-gray">
                                            @switch($lastUser->role_id)
                                                @case(\App\Models\User::ROLE_ADMIN)
                                                {{ __('locale.statistics.last_5_newest_users.admin') }}
                                                @break
                                                @case(\App\Models\User::ROLE_CLIENT)
                                                {{ __('locale.statistics.last_5_newest_users.regular_user') }}
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="pe-3 text-center pt-2 pb-2 _dark-gray">
                                            {{$lastUser->balance}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$lastUser->lastSession ? $lastUser->lastSession->ip : ''}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$lastUser->created_at}}
{{--                                            {{Timezone::convertToLocal($lastUser->created_at, 'Y-m-d H:i:s')}}--}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2">
                                                <span
                                                    class="
                                                    statistics__tab-table--status
                                                    @if($lastUser->status) _status-1 @else _status-2 @endif"
                                                >
                                                    @if(!$lastUser->status) ❌ @else ✔️ @endif
                                                </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </li>
                <li class="statistics__tab-section--item statistics__tab-item _tab-block" id="last-5-orders">
                    <div class="statistics__tab-item--body _section-block">
                        <div class="statistics__tab-item--header _section-block-header ps-3 pe-3 pb-2">
                            <h2 class="statistics__tab-item--title _title">
                                {{ __('locale.statistics.last_5_orders.last_5_orders') }}
                            </h2>
                        </div>
                        <div class="statistics__tab-section--wrapper _scrollbar-styles">
                            <table class="statistics__tab-section--table statistics__tab-table _table">
                                <colgroup>
                                    <col class="statistics__tab-table--col-1">
                                    <col class="statistics__tab-table--col-2">
                                    <col class="statistics__tab-table--col-3">
                                    <col class="statistics__tab-table--col-4">
                                    <col class="statistics__tab-table--col-5">
                                    <col class="statistics__tab-table--col-6">
                                    <col class="statistics__tab-table--col-7">
                                    <col class="statistics__tab-table--col-8">
                                    <col class="statistics__tab-table--col-9">
                                    <col class="statistics__tab-table--col-10">
                                </colgroup>
                                <thead>
                                <tr>
                                    <td class="pe-3 ps-4 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.order_id') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.user') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.name') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2 text-center">
                                        {{ __('locale.statistics.last_5_orders.type') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2 text-center">
                                        {{ __('locale.statistics.last_5_orders.link') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.quantity') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.amount') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.created') }}
                                    </td>
                                    <td class="pe-3 pt-4 pb-2">
                                        {{ __('locale.statistics.last_5_orders.status') }}
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lastOrders as $lastOrder)
                                    <tr class="statistics__tab-table--item">
                                        <td class="ps-4 pe-3 fw-bold pt-2 pb-2">
                                            {{$lastOrder->id}}
                                        </td>
                                        <td class="fw-bold pe-3 pt-2 pb-2">
                                            {{mb_substr($lastOrder->user->email, 0, 100)}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$lastOrder->service->name}}
                                        </td>
                                        <td class="pe-3 text-center pt-2 pb-2 _dark-gray">
                                            {{$lastOrder->type}}
                                        </td>
                                        <td class="pe-3 text-center pt-2 pb-2 _dark-gray">
                                            {{$lastOrder->link}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$lastOrder->quantity}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$lastOrder->charge}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2 _dark-gray">
                                            {{$lastOrder->created_at}}
{{--                                            {{Timezone::convertToLocal($lastOrder->created_at, 'Y-m-d H:i:s')}}--}}
                                        </td>
                                        <td class="pe-3 pt-2 pb-2">
                                                 <span
                                                     class="
                                                    statistics__tab-table--status
                                                    @if($lastOrder->status) _status-2 @else _status-1 @endif"
                                                 >
                                                    {{$lastOrder->status}}
                                                </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    @endif

    <script>
        function addNewMessage()
        {
            $('#ticketDisplayErrors').html('');

            $.ajax({
                type: "POST",
                url: "<?php echo e(route('admin.ticket.message.create', ['language' => Config::get('language.current')])); ?>",
                data: {
                    message : $('#newTicketMessageText').val(),
                    ticket_id : $('#currentTicketId').val(),
                    _token : "{{csrf_token()}}"
                }
            }).done(function(data) {
                if (data.status) {
                    var ticketMessages = '';
                    var userFirstName = "{{$user->first_name}}";
                    var userLastName = "{{$user->last_name}}";
                    var userRole = "{{$user->role_id}}";
                    var userAvatar = "{{$user->image_file}}";

                    if(userAvatar === '' || userAvatar === null) {
                        userAvatar = "{{asset('admin/img/user/avatar.png')}}";
                    }

                    if(userRole === "1") {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0 _admin">'
                            +'<div class="statistics__chat-place--avatar">'
                            +'<img src="'+userAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + $('#newTicketMessageText').val()
                            +'</div>'
                            + '<span class="statistics__chat-place--name">'
                            + userFirstName + ' ' + userLastName
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    } else {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0">'

                            +'<div class="statistics__chat-place--avatar mt-4">'
                            +'<img src="'+userAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + $('#newTicketMessageText').val()
                            +'</div>'
                            +'<span class="statistics__chat-place--name">'
                            + userFirstName + ' ' + userLastName
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    }
                    $('#newTicketMessageText').val('');
                    $('#showTicketMessage').append(ticketMessages);
                }
            }).fail(function( data ) {

                var errors = '';
                $.each(data.responseJSON.errors, function (id, message) {
                    errors += '<div class="error" style="color: firebrick">'+message[0]+'</div>'
                });

                $('#ticketDisplayErrors').html(errors);
            });
        }

        function showTicketMessages(ticketId)
        {
            $('#ticketMessageAddingBlock').hide();
            $('#ticketMessageAddingBlock').show();
            $.ajax({
                type: "GET",
                url: "{{route('admin.ticket.message.ticket', ['language' => Config::get('language.current')])}}",
                data: {
                    ticket_id : ticketId
                }
            }).done(function(data) {
                var ticketMessages = '';
                $.each(data.data, function( index, value ) {
                    var UserAvatar = value.user_avatar;

                    if(UserAvatar === '' || UserAvatar === null) {
                        UserAvatar = "{{asset('admin/img/user/avatar.png')}}";
                    }
                    if(value.is_admin) {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0 _admin">'
                            +'<div class="statistics__chat-place--avatar">'
                            +'<img src="'+UserAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + value.message
                            +'</div>'
                            + '<span class="statistics__chat-place--name">'
                            + value.first_name + ' ' + value.last_name
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    } else {
                        ticketMessages += '<div class="statistics__chat-place--user mb-3 mb-md-0">'

                            +'<div class="statistics__chat-place--avatar mt-4">'
                            +'<img src="'+UserAvatar+'" width="42" height="42" alt="" class="statistics__chat-place--img">'
                            +'</div>'
                            +'<div class="statistics__chat-place--info ms-2 me-2">'
                            +'<div class="statistics__chat-place--message">'
                            + value.message
                            +'</div>'
                            +'<span class="statistics__chat-place--name">'
                            + value.first_name + ' ' + value.last_name
                            +'</span>'
                            +'</div>'
                            +'</div>'
                    }
                });

                $('#showTicketMessage').html(ticketMessages);
                $('#currentTicketId').val(ticketId);
            });
        }

        $(".project-block__popup--close-btn").on("click", function() {
            $(this).closest(".project-block__popup").removeClass("_active").fadeOut().css({"opacity": 0});
            $(body, html).css({"overflow-y": "auto", "height": "auto"});
        });

        $(".statistics__users--li:first-child").trigger("click");
    </script>
@stop
