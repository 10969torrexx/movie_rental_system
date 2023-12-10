@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-header"><h5 class="text-success">Product Detail</h5></div>

                <div class="card-body row justify-content-center">
                    <div class="col-6 col-sm-6 p-1">
                        <div class="row justify-content-center">
                            <img src="{{ $product->image }}" class="col-8" alt="">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 p-1">
                        <form action="{{ route('confirmOrder') }}" method="post">
                            @csrf
                            <input type="text" hidden class="form-control" placeholder="productId" name="movie_id" value="{{ $product->id }}" id="finalProductId">
                            <input type="text" hidden class="form-control" placeholder="quantity" name="quantity" id="finalQuantity">
                            <input type="text" hidden class="form-control" placeholder="totalPrice" id="finalTotalPrice" name="totalPrice">
                            <input type="text" hidden class="form-control" placeholder="change" id="finalChange" name="change">

                            <p id="name"><strong>Name:</strong> {{ ucwords($product->name) }}</p>
                            <p data-price="{{ $product->rental_price }}" id="price"><strong>Rental Price</strong> ₱ {{ number_format($product->rental_price, 2, '.', ',')  }}</p>
                            <div class="container">
                                <div class="form-group row">
                                  <label for="from_date" class="col-sm-2 col-form-label">From:</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control datetimepicker" name="from" id="fromDatetimePicker" placeholder="Select From Date">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="until_date" class="col-sm-2 col-form-label">Until:</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control datetimepicker" name="until" id="untilDatetimePicker" placeholder="Select Until Date">
                                  </div>
                                </div>
                            </div>
                              
                            <div class="form-group">
                                <label for=""><strong>Number of Days: </strong></label>
                                <p id="result"></p>
                            </div>

                            <div class="form-group">
                                <label for=""><strong>Total Price: </strong></label>
                                <p id="totalPrice">₱ 0.00</p>
                            </div>
                            <p><strong> </strong></p>
                            <div class="form-group">
                                <label for=""><strong>Payment</strong></label>
                                <input type="number" class="form-control col-8" name="payment" id="payment" required>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Change</strong></label>
                                <p id="change">₱ 0.00</p>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Confirm Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var quantity = 0;
    var totalPrice = 0;
    updateSubmitButtonVisibility();

    $(document).on('input', '#payment', function() {
        updateSubmitButtonVisibility();

        $('#change').text(calculateChange().toLocaleString('en-PH', {
            style: 'currency',
            currency: 'PHP' 
        }));

        $('#finalChange').val(calculateChange());
    });


    function updateSubmitButtonVisibility() {
        var paymentAmount = parseFloat($("#payment").val());

        if (!isNaN(paymentAmount) && paymentAmount > calculateTotalPrice()) {
            $("#submitButton").show();
        } else {
            $("#submitButton").hide();
        }
    }

    function calculateTotalPrice() {
        // return  (parseFloat($('#price').data('price')) * quantity) > 0 ? parseFloat($('#price').data('price')) * quantity : 0;
        return parseFloat($('#price').data('price')) * ((quantity > 0) ? quantity : 0);
    }

    function calculateChange() {
        return  (calculateTotalPrice() > parseFloat($('#payment').val())) ? 'Insufficient Payment!' : parseFloat($('#payment').val()) - calculateTotalPrice();
    }


    $('#fromDatetimePicker').datetimepicker({
        format: 'F d, Y',
        step: 15,
        disabled: true,
        value: new Date(), // Set the initial value to the current date
        readOnly: true,    // Make the input unchangeable
        onChangeDateTime: function(dp, $input) {
            calculateDays();
        }
    });


    $('#untilDatetimePicker').datetimepicker({
      format: 'F d, Y',
      step: 15,
      onChangeDateTime: function(dp, $input) {
        calculateDays();

        $('#totalPrice').text( calculateTotalPrice().toLocaleString('en-PH', {
            style: 'currency',
            currency: 'PHP' 
        }));
        $('#finalTotalPrice').val(calculateTotalPrice());
      }
    });

    function calculateDays() {
      var fromDate = $('#fromDatetimePicker').datetimepicker('getValue');
      var untilDate = $('#untilDatetimePicker').datetimepicker('getValue');

      if (fromDate && untilDate) {
        var timeDiff = Math.abs(untilDate.getTime() - fromDate.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        quantity = parseInt(diffDays);
        $('#finalQuantity').val(quantity);

        $('#result').text('Days between: ' + diffDays);
      } else {
        $('#result').text('');
      }
    }

</script>
@endsection
