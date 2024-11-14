{{--
@extends('Frontend.Layout.main')

@section('main-container')

<div class="container mt-4 mb-5" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <h2 class="text-center" style="margin-bottom: 10px;">Checkout Page</h2>

    <section style="background-color: #eee; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 30px; width: 100%; max-width: 900px;">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8">
                    <h5>Total Cost: ₹{{ session('totalAmount') }}</h5>
                    <div class="card rounded-3 mb-4 shadow-sm border-0" style="border-radius: 10px;">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-12">
                                    <h4 class="text-primary">Basic Information</h4>
                                    <hr>
                                    <form id="bookdetail" method="POST" action="{{ route('checkout.submit') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Name" onchange="submitForm()" required/>
                                            </div>
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control" placeholder="Enter Phone Number" onchange="submitForm()" required/>
                                            </div>
                                            @error('contact_number')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" onchange="submitForm()" required/>
                                            </div>
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>Pin-code (Zip-code)</label>
                                                <input type="text" name="pincode" class="form-control" placeholder="Enter Pin-code" onchange="submitForm()" required/>
                                            </div>
                                            @error('pincode')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control" placeholder="Enter City" onchange="submitForm()" required />
                                            </div>
                                            @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>State</label>
                                                <input type="text" name="state" class="form-control" placeholder="Enter State" onchange="submitForm()" required/>
                                            </div>
                                            @error('state')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 mb-3">
                                                <label>Full Address</label>
                                                <textarea name="address" class="form-control" rows="2" onchange="submitForm()" required></textarea>
                                            </div>
                                            @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror


                                            <div class="col-md-12 mb-3">
                                                <label>Payment Method</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="cashOnDelivery" value="cod" required>
                                                    <label class="form-check-label" for="cashOnDelivery">
                                                        Cash on Delivery
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="onlinePayment" value="online" required>
                                                    <label class="form-check-label" for="onlinePayment">
                                                        Online Payment (10% Discount)
                                                    </label>
                                                </div>
                                            </div>
                                            @error('payment_method')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                            <form action="/handlepayment" method="post" style="margin: 0 auto;">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZOR_KEY') }}"
                                    data-amount="{{ session('totalAmount') * 100 }}"
                                    data-currency="INR"
                                    data-buttontext="Pay"
                                    data-description="Test transaction"
                                    data-theme.color="#0000FF"></script>
                            </form>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function submitForm() {
        var form = document.getElementById('bookdetail');
        var formData = new FormData(form);

        // Send form data using AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    // Handle response here
                    console.log(response.message);
                } else {
                    // Handle error here
                    console.log('An error occurred while placing the order. Please try again.');
                }
            }
        };
        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
        xhr.send(formData);
    }
</script>

@endsection --}}


@extends('Frontend.Layout.main')

@section('main-container')
<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="container mt-4 mb-5" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <h2 class="text-center" style="margin-bottom: 10px;">Checkout Page</h2>

    <div id="spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;  background: rgba(0, 0, 0, 0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div style="border: 6px solid rgba(255, 255, 255, 0.3); border-top: 6px solid white; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite;"></div>
        <span style="font-size: 20px; color: white; margin-top: 10px; justify-content: center; align-items: center;" class="visually-hidden">Loading...</span>
    </div>

    <section style="background-color: #eee; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 30px; width: 100%; max-width: 900px;">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8">
                    <h5>Total Cost: ₹{{ session('totalAmount') }}</h5>
                    <div class="card rounded-3 mb-4 shadow-sm border-0" style="border-radius: 10px;">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-12">
                                    <h4 class="text-primary">Basic Information</h4>
                                    <hr>
                                    <form id="bookdetail" method="POST" action="{{ route('checkout.submit') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Name" onchange="submitForm()" required/>
                                            </div>
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control" placeholder="Enter Phone Number" onchange="submitForm()" required/>
                                            </div>
                                            @error('contact_number')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" onchange="submitForm()" required/>
                                            </div>
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>Pin-code (Zip-code)</label>
                                                <input type="text" name="pincode" class="form-control" placeholder="Enter Pin-code" onchange="submitForm()" required/>
                                            </div>
                                            @error('pincode')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control" placeholder="Enter City" onchange="submitForm()" required />
                                            </div>
                                            @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-6 mb-3">
                                                <label>State</label>
                                                <input type="text" name="state" class="form-control" placeholder="Enter State" onchange="submitForm()" required/>
                                            </div>
                                            @error('state')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 mb-3">
                                                <label>Full Address</label>
                                                <textarea name="address" class="form-control" rows="2" onchange="submitForm()" required></textarea>
                                            </div>
                                            @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 mb-3">
                                                <label>Payment Method</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="cashOnDelivery" value="cod" required onclick="togglePaymentButton()">
                                                    <label class="form-check-label" for="cashOnDelivery">Cash on Delivery</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="onlinePayment" value="online" required onclick="togglePaymentButton()">
                                                    <label class="form-check-label" for="onlinePayment">Online Payment (10% Discount)</label>
                                                </div>
                                            </div>
                                            @error('payment_method')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="payment-options" >
                        <div class="text-center">
                            <button id="codButton" class="btn btn-success" style="display: none;" onclick="submitCodOrder()">Confirm Cash on Delivery</button>
                            <form id="razorpayForm" action="/handlepayment" method="post" style="display: none;" onsubmit="showLoadingSpinner()">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZOR_KEY') }}"
                                    data-amount="{{ (session('totalAmount')) * 100 -(session('totalAmount') * 100)*0.10 }}"
                                    data-currency="INR"
                                    data-buttontext="Pay"
                                    data-description="Test transaction"
                                    data-theme.color="#0000FF">
                                 </script>
                            </form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function togglePaymentButton() {
        const codButton = document.getElementById('codButton');
        const razorpayForm = document.getElementById('razorpayForm');
        // let totalAmount = parseFloat('{{ session('totalAmount') }}');


        if (document.getElementById('cashOnDelivery').checked) {
            codButton.style.display = 'block';
            razorpayForm.style.display = 'none';

        } else {

            // const discount = totalAmount * 0.10;
            // const discountedAmount = totalAmount - discount;
            codButton.style.display = 'none';
            razorpayForm.style.display = 'block';

            // console.log(discountedAmount);
        }
    }


    function submitCodOrder() {
        const form = document.getElementById('bookdetail');
        const formData = new FormData(form);
        const spinner = document.getElementById('spinner');


        console.log('Sending form data for COD:', Array.from(formData.entries()));
        spinner.style.display = 'block';

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {

                spinner.style.display = 'none';

                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                    alert(response.message);

                    window.location.href = '/';
                } else {
                    console.log('An error occurred while placing the order. Please try again.');
                }
            }
        };
        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
        xhr.send(formData);
    }

//     function showLoadingSpinner() {
//     document.getElementById('loadingSpinner').style.display = 'flex';
// }

// function hideLoadingSpinner() {
//     document.getElementById('loadingSpinner').style.display = 'none';
// }

</script>

@endsection
