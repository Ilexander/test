@extends('panel/master')

@section('title', 'Transaction Add ')

@section('content')
  <section class="app-user-list">
    <div class="row">
      @foreach($payments as $payment)
        <div class="col-lg-3 col-sm-6" onclick="setFunds({{$payment->id}})">
          <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <h3 class="fw-bolder mb-75">{{$payment->name}}</h3>
                <span>some count</span>
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
    </div>

    <script>

    </script>

  </section>
  <!-- Basic Horizontal form layout section start -->
  <section id="addFundsSection" style="display: none">
    <div class="row">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-body">
            <form class="form form-horizontal" id="addFunds" action="{{route('transaction.add', ['language' => Config::get('language.current')])}}" method="POST">
                @csrf
              <div class="row">
                  <input type="hidden" id="addFundsPaymentId" name="payment_id">
                  <div class="col-12">
                      <div class="mb-1 row">
                          <div class="col-sm-12 offset-sm-4">
                              <img id="addFundsImage" class="footer_r" height="300" width="300" src="" alt="">
                          </div>
                      </div>
                  </div>
                <div class="col-12">
                  <div class="mb-1 row">
                    <div class="col-sm-3">
                      <label class="col-form-label" for="first-name">Amount (USD)</label>
                    </div>
                    <div class="col-sm-12">
                      <input type="number" id="addFundsAmount" class="form-control" name="amount" placeholder="5" />
                    </div>
                  </div>
                </div>
                  <div class="col-12">
                      <div class="mb-1 row" id="createNewTransaction">

                      </div>
                  </div>
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-12">
                            Note:
                            <ul>
                                <li>Minimal payment: <span id="addFundsMinValue">$5</span></li>
                                <li>Maximal payment: <span id="addFundsMaxValue">$100</span></li>
                                <li>Clicking Return to Shop (Merchant) after payment successfully completed</li>
                            </ul>
                        </div>
                    </div>
                </div>
                  <div class="col-12">
                      <div class="mb-1 row">
                          <div class="col-sm-12">
                              <input type="checkbox" name="return_to_shop" class="form-check-input" id="returnToShopCheck" />
                              Yes, I understand after the funds added i will not ask fraudulent dispute or charge-back!
                          </div>
                      </div>
                  </div>
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-12">
                            <button type="button" onclick="addFunds()" class="btn btn-primary me-1">Submit</button>
                        </div>
                    </div>
                </div>
              </div>
            </form>
              <div id="payeer"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Basic Horizontal form layout section end -->

  <script>
    function addFunds()
    {
        $.ajax({
            type: "POST",
            url: "{{route('transaction.add', ['language' => Config::get('language.current')])}}",
            data: {
                payment_id : $('#addFundsPaymentId').val(),
                amount : $('#addFundsAmount').val(),
                return_to_shop : $('#returnToShopCheck').val(),
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

        });
    }
    function setFunds(paymentId)
    {
        $('#createNewTransaction').html('');
        $('#addFundsAmount').val('')
        $('#addFundsSection').show()
        $('#returnToShopCheck').prop("checked", false);
        $.ajax({
            type: "GET",
            url: "{{route('payment.info', ['language' => Config::get('language.current')])}}",
            data: {
                id : paymentId,
                _token : "{{csrf_token()}}"
            }
        }).done(function(data) {
            if (data.data.currencies.length > 1) {
                var currency = '<div class="col-sm-3">'+
                                    '<label class="col-form-label" for="first-name">' +
                                        'Choose payment method'+
                                    '</label>'+
                                '</div>';
                currency += '<div class="col-sm-12"><select name="currency" id="transactionCurrency" class="select2 form-select">'
                $.each(data.data.currencies, function( index, value ) {
                    currency += '<option value="'+value.currency.id+'">'+value.currency.name+' ('+value.currency.description+')</option>';
                });
                currency += '</select></div>';

                $('#createNewTransaction').html(currency);
            }

            $("#addFundsImage").attr("src","{{asset('storage/')}}" + '/'+data.data.image_url);
            $('#addFundsMinValue').html('$'+data.data.min);
            $('#addFundsMaxValue').html('$'+data.data.max);
            $('#addFundsPaymentId').val(data.data.id);
        });
    }
  </script>
@endsection
