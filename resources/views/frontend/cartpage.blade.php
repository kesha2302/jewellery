
@extends('Frontend.Layout.main')

@section('main-container')
<h2 style="text-align: center; font-size: 32px; color: #333; margin-bottom: 20px;">Cart Page</h2>

<div style="margin: 50px auto; max-width: 900px; background-color: #f5f5f5; padding: 30px; border-radius: 8px;">
    <!-- Cart Page Title -->
    @foreach ($cart as $item)
    <!-- Product Card -->
    <div style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <!-- Product Image -->
            <div style="flex-basis: 20%; text-align: center;">
                <img src="{{ asset('productsimg/' . $item['image']) }}" alt="Product Image" style="width: 100px; border-radius: 5px;" />
            </div>

            <!-- Product Details -->
            <div style="flex-basis: 60%; padding-left: 20px;">
                <p style="font-size: 18px; margin: 0;">Name: {{ $item['name'] }}</p>
                {{-- <p style="font-size: 18px; margin: 0;">Quantity: {{ $item['quantity'] }}</p> --}}
                <p style="font-size: 16px; margin: 5px 0;">MRP Price: ₹{{ $item['price'] }}</p>
                @if(isset($item['discount_price']))
    <p style="font-size: 16px; margin: 5px 0;">Discount Price: ₹{{ $item['discount_price'] }}</p>
@endif
                <p>Quantity:</p>
                <div class="d-flex mt-5" style="margin-top: 10px;">
                    <button id="decrement"   class="decrement" style="background-color: black; color:white; height: 38px; width: 40px; border: none; border-radius: 5px;">
                        <i class="fa fa-minus"></i>
                    </button>
                    <input type="number" id="quantity" value="{{ $item['quantity'] }}" class="quantity-input mx-2" data-id="{{ $item['product_id'] }}" style="width: 40px; height: 38px; text-align: center; border-radius: 5px;">
                    <button id="increment" class="increment" style="background-color: black; color:white; height: 38px; width: 40px; border: none; border-radius: 5px;">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>


            <div style="flex-basis: 20%; text-align: right;">
                <button onclick="removeFromCart('{{ $item['product_id'] }}')" style="background-color: #d9534f; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Total Cost and Checkout -->
    <div style="display: flex; justify-content: space-between; align-items: center; background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <!-- Total Cost -->
        <div>
            <p style="font-size: 18px; font-weight: bold; margin: 0;">Total Cost:</p>
            <p id="totalAmount" style="font-size: 20px; color: #000; margin: 0;">₹{{ session('totalAmount', 0) }}</p>
        </div>

        <!-- Checkout Button -->
        {{-- <div>
            <a href="{{ url('/checkoutpage') }}" style="background-color:green; color: white; border: none; padding: 15px 30px; text-decoration:none; font-size: 18px; border-radius: 5px; cursor: pointer;">Checkout</a>
        </div> --}}
        <div>
            <button id="checkoutButton" style="background-color: green; color: white; border: none; padding: 15px 30px; font-size: 18px; border-radius: 5px; cursor: pointer;">Checkout</button>
        </div>
    </div>

    <!-- Back Button -->
    <div style="text-align: center; margin-top: 20px;">
        <button style="background-color: #000; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Back</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function removeFromCart(productId) {
        $.ajax({
            url: '{{ route("cart.remove") }}',
            method: 'POST',
            data: {
                id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.success);
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    }




    $(document).ready(function() {
        var totalAmount = {{ session('totalAmount', 0) }};
        var checkoutButton = $('#checkoutButton');


        if (totalAmount <= 0) {
            checkoutButton.prop('disabled', true);
            checkoutButton.css('background-color', 'grey');
        }

        checkoutButton.click(function() {
            if (totalAmount > 0) {
                window.location.href = '{{ url("/checkoutpage") }}';
            }
        });
    });


    // Quantity control functionality
    $('.quantity-input').on('change', function() {
        var productId = $(this).data('id');
        var newQuantity = $(this).val();

        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'POST',
            data: {
                id: productId,
                quantity: newQuantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // alert(response.success);
                $('.badge').text(response.totalItems);
                $('.badge').css('display', response.totalItems > 0 ? 'inline' : 'none');

                $('#totalAmount').text('₹' + response.newTotalAmount);
                $('input[data-id="' + productId + '"]').val(newQuantity);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });

    $('#increment').on('click',  function() {
        let quantityInput = $(this).siblings('.quantity-input');
        let currentVal = parseInt(quantityInput.val());
        quantityInput.val(currentVal + 1).change();
    });

    $('#decrement').on('click',   function() {
        let quantityInput = $(this).siblings('.quantity-input');
        let currentVal = parseInt(quantityInput.val());
        if (currentVal > 1) {
            quantityInput.val(currentVal - 1).change();
        }
    });

</script>
@endsection
