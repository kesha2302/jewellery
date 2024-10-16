{{-- @extends('Frontend.Layout.main')

@section('main-container')

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Checkout Page</h2>

    <section style="background-color: #f9f9f9; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h5>Total Cost: ₹{{ session('totalAmount') }}</h5>

                    <!-- Updated Card Design -->
                    <div class="card rounded-3 mb-4 shadow-sm border-0" style="border-radius: 10px;">
                        <div class="card-body p-4">
                            <h4 class="text-primary"><i class="bi bi-person-circle"></i> Basic Information</h4>
                            <hr class="mb-4">
                            <form id="bookdetail" method="POST" action="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label><i class="bi bi-person"></i> Full Name</label>
                                        <input type="text" name="name" class="form-control shadow-sm" placeholder="Enter Name" required/>
                                    </div>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-6 mb-3">
                                        <label><i class="bi bi-phone"></i> Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control shadow-sm" placeholder="Enter Phone Number" required/>
                                    </div>
                                    @error('contact_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-6 mb-3">
                                        <label><i class="bi bi-envelope"></i> Email Address</label>
                                        <input type="email" name="email" class="form-control shadow-sm" placeholder="Enter Email Address" required/>
                                    </div>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-6 mb-3">
                                        <label><i class="bi bi-geo"></i> Pin-code (Zip-code)</label>
                                        <input type="text" name="pincode" class="form-control shadow-sm" placeholder="Enter Pin-code" required/>
                                    </div>
                                    @error('pincode')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-6 mb-3">
                                        <label><i class="bi bi-building"></i> City</label>
                                        <input type="text" name="city" class="form-control shadow-sm" placeholder="Enter City" required />
                                    </div>
                                    @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-6 mb-3">
                                        <label><i class="bi bi-map"></i> State</label>
                                        <input type="text" name="state" class="form-control shadow-sm" placeholder="Enter State" required/>
                                    </div>
                                    @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-lg-12 mb-3">
                                        <label><i class="bi bi-house"></i> Full Address</label>
                                        <textarea name="address" class="form-control shadow-sm" rows="2" placeholder="Enter Full Address" required></textarea>
                                    </div>
                                    @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="text-center mt-4">
                        <form action="/handlepayment" method="post">
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
    </section>
</div>

<script>
    function submitForm() {
        var form = document.getElementById('bookdetail');
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                } else {
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
{{-- @extends('Frontend.Layout.main')

@section('main-container')

<div class="container mt-4 mb-5" >
    <h2 class="text-center" style="margin-bottom: 10px;">Checkout Page</h2>

    <section style="background-color: #eee; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <div class="container  py-4">
            <div class="row  justify-content-center ">
                <div class="col-10 col-md-8">
                    <h5>Total Cost: ₹{{ session('totalAmount') }}</h5>
                    <div class="card rounded-3mb-4 shadow-sm border-0" style="border-radius: 10px;">
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container text-center mx-auto">
                        <div class="d-flex justify-content-center">
                            <form action="/handlepayment" method="post">
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

@endsection
