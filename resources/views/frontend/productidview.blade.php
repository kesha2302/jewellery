@extends('frontend.layout.main')

@section('main-container')

@if(session('success'))
<script>
    alert("{{ session('success') }}!");
</script>
@endif

<div class="container mt-4">
    <div class="container h-100 py-3" style="background-color: #eee; margin-bottom: 20px;">
        <h2 class="text-center mb-3">{{ $product->subcategory->name }}</h2>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-10">
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row justify-content-start align-items-center" style="margin-left:10px;">

                            <div class="col-md-5 text-center">
                                <img id="mainImage" src="{{ asset('productsimg/' . $product->image) }}" class="img-fluid rounded-3" alt="Product Image" style="height: 300px; width: 100%; margin-bottom: 20px; border-radius: 15px;">
                            </div>

                            <div class="col-md-7">
                                <h4 class="mt-3 mt-md-0">{{ $product->name }}</h4>
                                <p>{{ $product->description }}</p>
                                <h5><i class="fa fa-rupee"></i> {{ $product->price }}</h5>

                                <div class="d-flex mt-5" style="margin-top: 10px;">
                                    <button id="decrement" style="background-color: black; color:white; height: 38px; width: 40px; border: none; border-radius: 5px;">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="number" id="quantity" value="1" min="1" class="mx-2" style="width: 40px; height: 38px; text-align: center; border-radius: 5px;">
                                    <button id="increment" style="background-color: black; color:white; height: 38px; width: 40px; border: none; border-radius: 5px;">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>


                                <div class="mt-4">
                                    <button onclick="addToCart({{ $product->product_id }})" class="btn btn-lg btn-dark" style="background-color: #d93d3d; border:none; margin-top: 20px; color:#eee;">Add to cart</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4" style="display: flex; justify-content: space-between; margin-bottom:20px;">
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->image) }}" class="img-fluid rounded" alt="Image" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->image) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img1) }}" class="img-fluid rounded" alt="Image 1" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img1) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img2) }}" class="img-fluid rounded" alt="Image 2" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img2) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img3) }}" class="img-fluid rounded" alt="Image 3" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img3) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img4) }}" class="img-fluid rounded" alt="Image 4" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img4) }}')">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="{{ url('/') }}" class="btn btn-dark btn-lg" style="background-color:#d93d3d; color:#eee; margin-bottom:20px;" role="button">Back</a>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Quantity control functionality
    $(document).ready(function() {
        let quantityInput = $('#quantity');

        $('#increment').on('click', function() {
            let currentVal = parseInt(quantityInput.val());
            quantityInput.val(currentVal + 1);
        });

        $('#decrement').on('click', function() {
            let currentVal = parseInt(quantityInput.val());
            if (currentVal > 1) {
                quantityInput.val(currentVal - 1);
            }
        });
    });

    // Function to change the main product image
    function changeImage(newSrc) {
        document.getElementById('mainImage').src = newSrc;
    }

    // Add to Cart button functionality
    function addToCart(productId) {
        // Check if user is logged in
        @if(auth()->check())
            let quantity = $('#quantity').val();

            $.ajax({
                url: '{{ route("cart.add") }}',
                method: 'POST',
                data: {
                    id: productId, // Send only the product ID
                    quantity: quantity,
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function(response) {
                    alert(response.message); // Show success message
                    $('.badge').text(response.totalItems);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.message); // Show error message
                }
            });
        @else
            alert('Please logged in to add items to your cart.'); // Alert if not logged in
        @endif
    }
</script>
@endsection

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veehaagate</title>

    <!-- Bootstrap CSS -->

    <link href="{{ asset('frontend/css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >

</head>

<body>
@extends('frontend.layout.main')

@section('main-container')

@if(session('success'))
<script>
    $(document).ready(function() {
        $('#modalMessage .modal-body').text("{{ session('success') }}");
        $('#modalMessage').modal('show');
    });
</script>
@endif

<!-- Modal -->
<div class="modal fade" id="modalMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalMessageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMessageLabel">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="container h-100 py-3" style="background-color: #eee; margin-bottom: 20px;">
        <h2 class="text-center mb-3">{{ $product->subcategory->name }}</h2>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-10">
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row justify-content-start align-items-center" style="margin-left:10px;">
                            <div class="col-md-5 text-center">
                                <img id="mainImage" src="{{ asset('productsimg/' . $product->image) }}" class="img-fluid rounded-3" alt="Product Image" style="height: 300px; width: 100%; margin-bottom: 20px; border-radius: 15px;">
                            </div>

                            <div class="col-md-7">
                                <h4 class="mt-3 mt-md-0">{{ $product->name }}</h4>
                                <p>{{ $product->description }}</p>
                                <h5><i class="fa fa-rupee"></i> {{ $product->price }}</h5>

                                <div class="d-flex mt-5" style="margin-top: 10px;">
                                    <button id="decrement" style="background-color: black; color:white; height: 38px; width: 40px; border: none; border-radius: 5px;">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="number" id="quantity" value="1" min="1" class="mx-2" style="width: 40px; height: 38px; text-align: center; border-radius: 5px;">
                                    <button id="increment" style="background-color: black; color:white; height: 38px; width: 40px; border: none; border-radius: 5px;">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>

                                <div class="mt-4">
                                    <button onclick="addToCart({{ $product->product_id }})" class="btn btn-lg btn-dark" style="background-color: #d93d3d; border:none; margin-top: 20px; color:#eee;">Add to cart</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4" style="display: flex; justify-content: space-between; margin-bottom:20px;">
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->image) }}" class="img-fluid rounded" alt="Image" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->image) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img1) }}" class="img-fluid rounded" alt="Image 1" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img1) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img2) }}" class="img-fluid rounded" alt="Image 2" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img2) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img3) }}" class="img-fluid rounded" alt="Image 3" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img3) }}')">
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ asset('productsimg/' . $product->img4) }}" class="img-fluid rounded" alt="Image 4" style="width: 150px; height: 70px; border-radius: 15px;" onclick="changeImage('{{ asset('productsimg/' . $product->img4) }}')">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="{{ url('/') }}" class="btn btn-dark btn-lg" style="background-color:#d93d3d; color:#eee; margin-bottom:20px;" role="button">Back</a>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script>
    // Quantity control functionality
    $(document).ready(function() {
        let quantityInput = $('#quantity');

        $('#increment').on('click', function() {
            let currentVal = parseInt(quantityInput.val());
            quantityInput.val(currentVal + 1);
        });

        $('#decrement').on('click', function() {
            let currentVal = parseInt(quantityInput.val());
            if (currentVal > 1) {
                quantityInput.val(currentVal - 1);
            }
        });
    });

    // Function to change the main product image
    function changeImage(newSrc) {
        document.getElementById('mainImage').src = newSrc;
    }

    // Add to Cart button functionality
    function addToCart(productId) {
        @if(auth()->check())
            let quantity = $('#quantity').val();

            $.ajax({
                url: '{{ route("cart.add") }}',
                method: 'POST',
                data: {
                    id: productId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);

                    $('#modalMessage .modal-body').text(response.message);
                    console.log("Modal text updated:", response.message);

                    $('#modalMessage').modal('show');
                    console.log("Modal should now be displayed");

                    $('.badge').text(response.totalItems);
                },
                error: function(xhr) {
                    $('#modalMessage .modal-body').text('Error: ' + xhr.responseJSON.message);
                    $('#modalMessage').modal('show');
                    console.log("Modal should now display an error message");
                }
            });
        @else
        $('#modalMessage .modal-body').text('Please log in to add items to your cart.');
        $('#modalMessage').modal('show');
        console.log("Modal should now display a login message");
        @endif
    }
</script>
@endsection

</body>
</html> --}}
