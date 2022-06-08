@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')

            <div class="add-funds__block mt-3">
                <div class="add-funds__block--body _section-block">
                    <div class="add-funds__block--header _section-block-header ps-2 ps-sm-4 pb-1 pt-1">
                        <h2 class="add-funds__block--title _title">
                            {{ __('locale.add_funds.add_funds') }}
                        </h2>
                    </div>
                    <form action="#" class="add-funds__block--form add-funds__form _tab-section">
                        <div class="add-funds__form--body ps-2 pe-2 ps-sm-4 pe-sm-4 pb-4">
                            <label class="add-funds__form--label pt-3 _form-label">
                        <span class="add-funds__form--placeholder _form-placeholder">
                            {{ __('locale.add_funds.choose_method') }}
                        </span>
                                <input type="hidden" id="addFundsPaymentId" name="payment_id">
                                <span class="add-funds__form--label-body _form-elem-wrapper">
                            <span class="add-funds__form--icon _form-icon _icon-arrow"></span>
                            <select name="payment" class="add-funds__form--select _form-select _tab-select" id="paymentIdSelect">
                                <option value="0" selected>{{ __('locale.add_funds.select') }}</option>
                                @foreach($payments as $payment)
                                    <option value="{{$payment->id}}">{{$payment->name}}</option>
                                @endforeach
                            </select>
                        </span>
                                <div id="payment_idError" class="registerErrorClass"></div>
                            </label>
                            <div class="add-funds__form--add text-center _tab-wrapper pt-4 mt-3 pb-1">
                                @foreach($payments as $payment)

                                    @if( $payment->type === 'customPaypalService' )
                                        @if((int)$minimalClientAmountSum > $currentUserAmount)
                                            <h3 class="p-t-10" id="paypalNeedFundBlock" style="display: none">
                                                You need to fund your account through other payment systems to get access to PayPal
                                            </h3>
                                        @else
                                            @if(
                                                    $paypalDayLimitFactor - $currentPaypalSum > 0
                                                    && $payment->min < ($paypalDayLimitFactor - $currentPaypalSum)
                                                )
                                                <div class="payment_block" id="{{$payment->id}}" style="display: none">
                                                    <img src="{{$payment->image_url}}" loading="lazy" width="125" height="125" alt="" class="add-funds__form--logo">
                                                </div>
                                            @else
                                                <h3 class="p-t-10" id="paypalTemporarilyBlock" style="display: none">Service is temporarily unavailable</h3>
                                            @endif
                                        @endif
                                    @else
                                        <div class="payment_block" id="{{$payment->id}}" style="display: none">
                                            <img src="{{$payment->image_url}}" loading="lazy" width="125" height="125" alt="" class="add-funds__form--logo">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <label class="add-funds__form--label pt-3 _form-label" id="amountInfoBlock">
                                <span class="add-funds__form--placeholder _form-placeholder">
                                    {{ __('locale.add_funds.amount') }}
                                </span>
                                        <span class="add-funds__form--label-body _form-elem-wrapper">
                                    <span class="add-funds__form--icon _form-icon _icon-close _clear-input-btn"></span>
                                    <input type="number" id="addFundsAmount" name="amount" placeholder="$" class="add-funds__form--input _form-input">
                                </span>
                                <div id="amountError" class="registerErrorClass"></div>
                            </label>
                            <div class="add-funds__form--info pt-3">
                        <span class="add-funds__form--title">
                            {{ __('locale.add_funds.note') }}
                        </span>
                                <ul class="add-funds__form--list ps-2">
                                    @foreach($payments as $payment)
                                        <div class="payment_limit" id="limit_{{$payment->id}}" style="display: none">
                                            <li class="add-funds__form--li">
                                                {{ __('locale.add_funds.minimal') }}: ${{$payment->min}}
                                            </li>
                                            <li class="add-funds__form--li">
                                                {{ __('locale.add_funds.maximal') }}: ${{$payment->max}}
                                            </li>
                                        </div>
                                    @endforeach
                                    <li class="add-funds__form--li">
                                        {{ __('locale.add_funds.clicking') }}
                                        <b>{{ __('locale.add_funds.return') }}</b>
                                        {{ __('locale.add_funds.completed') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="add-funds__form--footer ps-2 pe-2 ps-sm-4 pe-sm-4 pt-3 pb-2 _section-block-footer" id="payFundsBlock">
                            <div class="add-funds__form--footer-body row justify-content-center align-items-center justify-content-md-between">
                                <div class="add-funds__form--check col-auto mt-1 mb-1">
                                    <input type="checkbox" id="returnToShopCheck" name="check" required class="add-funds__form--checkbox _hidden-checkbox _form-checkbox">
                                    <label for="returnToShopCheck" class="add-funds__form--label _form-label-checkbox">
                                        {{ __('locale.add_funds.understand') }}
                                    </label>
                                </div>
                                <div class="add-funds__form--submit col-auto mt-1 mb-1">
                                    <button type="button" onclick="addFunds()" class="add-funds__form--btn _btn _large-btn">
                                        {{ __('locale.add_funds.pay') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="return_to_shopError" class="registerErrorClass"></div>
                    </form>
                </div>
            </div>
            <div id="payeer"></div>
<script>
    $('#paymentIdSelect').on('change', function (){
        console.log($(this).val());
        $('.payment_block').hide();
        $('.payment_limit').hide();
        $('#amountInfoBlock').hide();
        $('#payFundsBlock').hide();
        $('#paypalNeedFundBlock').hide();
        $('#paypalTemporarilyBlock').hide();

        if ($(this).val() == '{{$paypalId}}') {

            if ($('#paypalNeedFundBlock').length > 0 || $('#paypalTemporarilyBlock').length > 0) {
                $('#paypalNeedFundBlock').show();
                $('#paypalTemporarilyBlock').show();
            } else {
                $('#addFundsPaymentId').val($(this).val());
                $('#'+$(this).val()).show();
                $('#limit_'+$(this).val()).show();
                $('#amountInfoBlock').show();
                $('#payFundsBlock').show();
            }

        } else {
            $('#addFundsPaymentId').val($(this).val());
            $('#'+$(this).val()).show();
            $('#limit_'+$(this).val()).show();
            $('#amountInfoBlock').show();
            $('#payFundsBlock').show();
        }

    });

    function addFunds()
    {
        $('.registerErrorClass').html('');
        $.ajax({
            type: "POST",
            url: "{{route('user.transaction.add', ['language' => Config::get('language.current')])}}",
            data: {
                payment_id : $('#addFundsPaymentId').val(),
                amount : $('#addFundsAmount').val(),
                return_to_shop : ($('#returnToShopCheck').is(':checked') ? 'on' : 'off'),
                currency : $('#transactionCurrency').val(),
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {
            if (data.error){
                alert(data.error);
            } else {
                if (data.provider_data) {
                    var fields = JSON.parse(data.provider_data);
                    var form = '<form method="post" action="'+data.redirect_url+'" name="f1" id="payment_method_form">';
                    for (const [key, value] of Object.entries(fields)) {
                        form += '<input type="hidden" name="'+key+'" value="'+value+'">';
                    }
                    form += '<input type="hidden" name="token" value="{{csrf_token()}}">';
                    form += '</form>';
                    $('#payeer').html(form);
                    $('#payment_method_form').submit();
                } else {
                    window.location.href = data.redirect_url;
                }
            }
        }).fail(function( data ) {

            var result = JSON.parse((data.responseText));

            console.log(result.errors);

            $.each(result.errors, function(index, value) {
                $('#' + index + 'Error').html('<div style="color: indianred">' + value[0] + '</div>');
            });

        });
    }
</script>
@stop
