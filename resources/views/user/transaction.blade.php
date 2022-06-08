@extends('carsac'. (Config::get('system.orient') === "ltr" ? "" : "-rtl"))
@section('content')
<div class="add-service">
  <form action="{{route('admin.transaction.update', ['language' => Config::get('app.locale')])}}" id="transaction_edit_form" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT" />
    <div class="add-service-header-block" id="userEditBlock">
      <div class="add-service-header">Edit transaction</div>
      <div class="add-service-close">
        <div class="cross"></div>
      </div>
    </div>
    <hr>
    <div class="input-group mt-2">
      <label for="user" style="width: 100%">User</label>
      <input type="text" class="form-control" name="payer_email" id="user">
    </div>
    <div class="input-group mt-2">
      <label for="tranid" style="width: 100%">Transaction ID</label>
      <input type="text" class="form-control" name="transaction_id" id="transaction_id">
    </div>
    <div class="input-group mt-2" id="payment_block">
    </div>
    <div class="input-group mt-2">
      <label for="status" style="width: 100%">Status</label>
      <select class="form-select" id="status" name="status">
        @foreach(\App\Models\Transaction::STATUS_LIST as $key => $status)
        <option value="{{$key}}">{{$status}}</option>
        @endforeach
      </select>
    </div>
    <div class="tarea-header mt-2">Note</div>
    <div class="form-floating mt-2">
      <textarea class="form-control" id="note" name="note"></textarea>
    </div>
    <div class="add-service-buttons mt-2">
      <button type="submit" class="btn btn-success me-3 mt-2">Submit</button>
      <button type="reset" class="btn btn-danger me-3 mt-2">Cancel</button>
    </div>
  </form>
</div>

<div class="transaction-log__block mt-3">
  <div class="transaction-log__block--body _section-block">
    <div class="transaction-log__block--header _section-block-header ps-4 pb-1 pt-1">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="error" style="color: firebrick">{{$error}}</div>
      @endforeach
      @endif
      <h2 class="transaction-log__block--title _title">
        Transaction log
      </h2>
    </div>
    <div class="transaction-log__block--table transaction-log__table _scrollbar-styles">
      <div class="transaction-log__table--body ps-4 pe-4 pt-4">
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
        <form action="{{route('user.transaction.list', ['language' => Config::get('language.current')])}}" class="transaction-log__head-table--filter transaction-log__filter pb-2" method="GET">
          <div class="transaction-log__filter--body">
            <label class="transaction-log__filter--label _form-label">
              <input type="text" name="id_filter" placeholder="№" class="transaction-log__filter--input _form-input" style="padding:5px 5px 15px 15px;">
            </label>
            <label class="transaction-log__filter--label _form-label ps-xxl-2 pe-xxl-2">
              <input type="text" name="user_filter" placeholder="User" class="transaction-log__filter--input _form-input" style="padding:5px 5px 15px 15px;">
            </label>
            <label class="transaction-log__filter--label _form-label">
              <input type="text" name="transaction_id_filter" placeholder="Transaction ID" class="transaction-log__filter--input _form-input" style="padding:5px 5px 15px 15px;">
            </label>
            <label class="transaction-log__filter--label _form-elem-wrapper">
              <span class="new-order__form--icon _form-icon _icon-arrow" style="right: 10%; top: 42%"></span>
              <select name="payment_filter" class="new-order__form--select _form-select" style="padding:5px 5px 15px 15px;">
                <option value="none" selected disabled>Payment</option>
                @foreach($payments as $payment)
                <option value="{{$payment->id}}">{{$payment->name}}</option>
                @endforeach
              </select>
              {{-- <input type="text" name="payment_filter" placeholder="All" class="transaction-log__filter--input _form-input">--}}
            </label>
            <label class="transaction-log__filter--label _form-label">
              <input type="text" name="amount_filter" placeholder="Amount" class="transaction-log__filter--input _form-input" style="padding:5px 5px 15px 15px;">
            </label>
            <label class="transaction-log__filter--label _form-label">
              <input type="text" name="transaction_fee_filter" placeholder="Fee" class="transaction-log__filter--input _form-input" style="padding:5px 5px 15px 15px;">
            </label>
            <label class="transaction-log__filter--label _form-label">
              <input type="text" name="note" placeholder="Note" class="transaction-log__filter--input _form-input" style="padding:5px 5px 15px 15px;">
            </label>
            <label class="transaction-log__filter--label _form-elem-wrapper">
              <span class="new-order__form--icon _form-icon _icon-arrow" style="right: 10%; top: 42%"></span>
              <select name="status_filter" class="new-order__form--select _form-select" style="padding:5px 5px 15px 15px;">
                <option value="none" selected disabled>Status</option>
                @foreach($statuses as $key => $status)
                <option value="{{$key}}">{{$status}}</option>
                @endforeach
              </select>
              {{-- <input type="text" name="status_filter" placeholder="Status" class="transaction-log__filter--input _form-input">--}}
            </label>
            <label class="transaction-log__filter--label _form-elem-wrapper">

            </label>

            <label class="transaction-log__filter--label _form-label">
              <button class="dt-button add-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="submit">
                <span>Filter</span>
              </button>
            </label>
          </div>
        </form>
        @endif

        <div class="transaction-log__table--head transaction-log__head-table">
          <div class="transaction-log__head-table--row pt-2 pb-2">
            <div class="transaction-log__head-table--param transaction-log__header-cell _center" style="display: table-cell; vertical-align: middle; margin-right: 110px;">
              ID
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div class="transaction-log__head-table--param transaction-log__header-cell ps-xxl-2 pe-xxl-4" style="display: table-cell; vertical-align: middle; margin-right: 60px;">
              Name
            </div>
            @endif
            <div class="transaction-log__head-table--param transaction-log__header-cell transaction-log__item-big" style="display: table-cell; vertical-align: middle; min-width: fit-content; margin-right: 83px; ">
              Transaction ID
            </div>
            <div class="transaction-log__head-table--param transaction-log__header-cell transaction-log__item-big ps-xxl-2 pe-xxl-4" style="display: table-cell; vertical-align: middle; margin-right: 54px;">
              Payment method
            </div>
            <div class="transaction-log__head-table--param transaction-log__header-cell" style="display: table-cell; vertical-align: middle; margin-right: 55px;">
              Amount (includes fee)
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div class="transaction-log__head-table--param transaction-log__header-cell" style="display: table-cell; vertical-align: middle; margin-right: 92px;">
              Transaction fee
            </div>
            <div class="transaction-log__head-table--param transaction-log__header-cell" style="display: table-cell; vertical-align: middle;">
              Note
            </div>
            @endif
            <div class="transaction-log__head-table--param transaction-log__header-cell" style="display: table-cell; vertical-align: middle;">
              Created
            </div>
            <div class="transaction-log__head-table--param transaction-log__header-cell" style="display: table-cell; vertical-align: middle;">
              Status
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div class="transaction-log__head-table--param transaction-log__header-cell _center" style="display: table-cell; vertical-align: middle;">
              Action
            </div>
            @endif
          </div>
        </div>
        <div class="transaction-log__body-table">
          @foreach($transactions as $transaction)
          <div class="transaction-log__item pt-3 pb-3" style="max-width: 100%;">
            <div class="transaction-log__item--cell _bold _center" style="margin-right: 250px;">
              {{$transaction->id}}
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div id="transactionPayerEmail{{$transaction->id}}" class="transaction-log__item--cell _bold ps-xxl-2" style="text-align: left; overflow: hidden" onmouseenter="$('#transactionPayerEmail'+{{$transaction->id}}).css({overflow: 'visible', marginTop: '-20px'})" onmouseout="$('#transactionPayerEmail'+{{$transaction->id}}).css({overflow: 'hidden',marginTop: '-0px'})">
              {{$transaction->payer_email}}
            </div>
            @endif
            <div id="transactionTransactionId{{$transaction->id}}" class="transaction-log__item--cell transaction-log__item-big" style="text-align: left; overflow: hidden" onmouseenter="$('#transactionTransactionId'+{{$transaction->id}}).css({overflow: 'visible', marginTop: '-20px'})" onmouseout="$('#transactionTransactionId'+{{$transaction->id}}).css({overflow: 'hidden', marginTop: '0px' })">
              {{$transaction->transaction_id}}
            </div>
            <div id="transactionPaymentName{{$transaction->id}}" class="transaction-log__item--cell transaction-log__item-big" style="text-align: left; overflow: hidden; margin-right: 200px; margin-left: -75px;" onmouseenter="$('#transactionPaymentName'+{{$transaction->id}}).css({overflow: 'visible', marginTop: '-20px'})" onmouseout="$('#transactionPaymentName'+{{$transaction->id}}).css({overflow: 'hidden', marginTop: '0px' })">
              @if($transaction->payment->image_url)
              <img src="{{$transaction->payment->image_url}}" width="65" alt="" class="transaction-log__item--payment-logo">
              @endif
              {{$transaction->payment->name}}
            </div>
            <div class="transaction-log__item--cell" style="margin-right: 45px; width: 120px; text-align: center;">
              ${{$transaction->amount}}
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div class="transaction-log__item--cell" style="margin-right: 100px;
    width: 100px;
    text-align: center;">
              ${{$transaction->txn_fee}}
            </div>
            <div class="transaction-log__item--cell" style="margin-right: 90px;">
              {{$transaction->note}}
            </div>
            @endif
            <div class="transaction-log__item--cell _center">
                {{$transaction->created_at}}
              {{-- {{Timezone::convertToLocal($transaction->created_at, 'Y-m-d H:i:s')}}--}}
            </div>
            <div class="transaction-log__item--cell" style="margin-left: auto; margin-right: 43px;">
              <div
                  class="transaction-log__item--status _status-1"
                    @if($transaction->status == \App\Models\Transaction::STATUS_FAILED)
                        style="background-color: indianred"
                    @endif

                    @if($transaction->status == \App\Models\Transaction::STATUS_NEW)
                        style="background-color: cornflowerblue"
                    @endif
              >
                {{\App\Models\Transaction::STATUS_LIST[$transaction->status] ?? ''}}
              </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <div class="transaction-log__item--cell _center" style="margin-right: 44px;">
              <button class="transaction-log__item--action _button" onclick="editTransaction({{$transaction->id}})">
                <span class="transaction-log__item--icon _icon-edit"></span>
              </button>
            </div>
            @endif
          </div>
          @endforeach
          <!-- <div class="transaction-log__body-table--wrapper">

                            </div> -->
        </div>
        {{ $transactions->appends(request()->input())->links() }}
      </div>
    </div>
  </div>
</div>

<script>
  function editTransaction(transactionId) {
    $('#userEditBlock').html('<input type="hidden" name="id" value="' + transactionId + '" />');
    var paymentsList = null;

    $.ajax({
      type: "GET",
      url: "{{route('user.payment.all', ['language' => Config::get('language.current')])}}",
      data: {
          {{--_token: "{{csrf_token()}}", --}}
      }
    }).done(function(data) {
      paymentsList = data.data;
    });

    $.ajax({
      type: "GET",
      url: "{{route('admin.transaction.info', ['language' => Config::get('language.current')])}}",
      data: {
        id: transactionId,
        _token: "{{csrf_token()}}"
      }
    }).done(function(data) {
      $('#user').val(data.data.payer_email);
      $('#transaction_id').val(data.data.transaction_id);
      $('#note').text(data.data.note);

      var payments = '<label for="payment" style="width: 100%">Payment method</label><select name="payment_id" class="form-select" id="payment">';

      $.each(paymentsList, function(index, value) {
        if (value.id == data.data.payment_id) {
          payments += '<option value="' + value.id + '" selected>' + value.name + '</option>';
        } else {
          payments += '<option value="' + value.id + '">' + value.name + '</option>';
        }
      });
      payments += '</select>';
      $('#payment_block').html(payments);


      $('#status option').each(function() {
        if (data.data.status == $(this).val()) {
          $("#status").val($(this).val()).trigger('change');
        }
      });
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

  var editBtns = document.querySelectorAll(".transaction-log__item--action");

  for (var i = 0; i < editBtns.length - 2; i++) {
    editBtns[i].addEventListener("click", function() {
      putOverlay();
      var overlay = document.querySelector(".madeup-overlay");
      $(".add-service").addClass("active");

      $(document).on("click", function(e) {
        if (!($(e.target).is(".add-service")) && !($(e.target).hasClass("transaction-log__item--action") || $(e.target).hasClass("transaction-log__item--icon")) && !((document.querySelector(".add-service")).contains(e.target))) {
          overlay.remove();
          $(".add-service").removeClass("active");
        }
      });
      $(".add-service-close").on("click", function() {
        overlay.remove();
        $(".add-service").removeClass("active")
      });
    });
  }
  //
  // ClassicEditor
  //         .create( document.querySelector( '#note' ) )
  //         .catch( error => {
  //             console.error( error );
  //         } );
</script>
@stop
