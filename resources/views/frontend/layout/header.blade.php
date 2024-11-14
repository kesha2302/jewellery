<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veehaagate</title>

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    <script src="{{ asset('frontend/js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <!-- Correct Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



</head>

<style>
    .offcanvas {
        position: fixed;
        top: 0;
        bottom: 0;
        left: -250px;
        width: 250px;
        background-color: #f8f9fa;
        overflow-y: auto;
        z-index: 1040;
        transition: all 0.3s ease-in-out;
    }

    .offcanvas.show {
        left: 0;
    }

    .offcanvas ul {
        list-style: none;
        padding-left: 0;
    }

    .offcanvas ul li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .offcanvas ul li a {
        color: #333;
        text-decoration: none;
    }

    .navbar-toggle {
        background-color: #333;
        color: white;
    }
</style>


<body>
    @php
        $cart = session('cart', []);
        $totalItems = array_sum(array_column($cart, 'quantity'));
    @endphp
    <section id="header">
        <div class="container">
            <div class="row">
                <div class="header_1 clearfix">
                    <div class="col-sm-2">
                        <div class="header_1l text-center clearfix">
                            <h2 style="margin-top: 28px;"><a class="col_1" href="{{ url('/') }}">Veehaagate</a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="header_1r clearfix">
                            <div class="header_1ri border_none clearfix">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search"
                                        style="width: 350px">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>

                            <div class="header_1ri clearfix">
                                @if(session('success'))
                            <p  class="mgt">Welcome, <br> {{ session('username') }}!</p>
                        @endif

                              </div>

                            <div class="header_1ri clearfix" style="margin-left: 50px;">
                                @auth

                                    <div class="header_1ri border_none clearfix">
                                        <span class="span_1">
                                            <a class="col_1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-user"></i>
                                            </a>
                                        </span>

                                        <h5 class="mgt dropdown">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Profile </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ url('/edit-profile') }}">Profile</a></li>
                                                <li><a href="{{ url('/orderhistory') }}">Order History</a></li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark text-center"
                                                            style="margin-left: 20px; background-color: #d93d3d; color:white;"><b>Logout</b></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </h5>
                                    @else
                                        <span class="span_1">
                                            <a class="col_1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-user "></i>
                                            </a>
                                        </span>

                                        <h5 class="mgt dropdown">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Account </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ url('/Login') }}">Login</a></li>
                                                <li><a href="{{ url('/register') }}">Sign Up</a></li>
                                            </ul>
                                        </h5>
                                    @endauth
                                </div>

                                <div class="header_1ri border_none clearfix" style="position: relative;">
                                    <span class="span_1">
                                        <a class="col_1" href="javascript:void(0);" onclick="checkCartItems()">
                                            <i class="glyphicon glyphicon-shopping-cart"></i>
                                            <span id="cart-badge" class="badge rounded-pill bg-danger"
                                                style="position: absolute; top: -5px; right: -0px;display: {{ $totalItems > 0 ? 'inline' : 'none' }};  ">{{ $totalItems }}</span>
                                        </a>
                                    </span>
                                    <h5 class="mgt">
                                        <a href="javascript:void(0);" onclick="checkCartItems()"> Cart</a>
                                    </h5>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>
            </div>
    </section>


    <section id="menu" class="clearfix cd-secondary-nav">
        <nav class="navbar nav_t">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1"  >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href=" " class="col_1 navbar-brand">
                        <img src="{{ asset('AdminPanel/assets/images/logos/logo.jpg') }}" width="100"
                            height="90" alt="">
                    </a>




                    <div class="col_1 navbar-brand">
                        @auth

                            <div class="col_1 navbar-brand">
                                <span class="span_1">
                                    <a class="col_1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </span>

                                <h5 class="mgt dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Profile</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/edit-profile') }}">Profile</a></li>
                                        <li><a href="{{ url('/orderhistory') }}">Order History</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-dark text-center"
                                                    style="margin-left: 20px; background-color: #d93d3d; color:white;"><b>Logout</b></button>
                                            </form>
                                        </li>
                                    </ul>
                                </h5>
                            @else
                                <span class="span_1">
                                    <a class="col_1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-user "></i>
                                    </a>
                                </span>
                                <h5 class="mgt dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Account </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/Login') }}">Login</a></li>
                                        <li><a href="{{ url('/register') }}">Sign Up</a></li>
                                    </ul>
                                </h5>
                            @endauth
                        </div>

                        <div class="col_1 navbar-brand">
                            <span class="span_1">
                                <a class="col_1" href="javascript:void(0);" onclick="checkCartItems()">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                    <span id="cart-badge" class="badge rounded-pill bg-danger"
                                        style="position: absolute; top: -5px; right: -0px; display: {{ $totalItems > 0 ? 'inline' : 'none' }};">{{ $totalItems }}</span>
                                </a>
                            </span>
                            <h5 class="mgt">
                                <a href="javascript:void(0);" onclick="checkCartItems()"> Cart</a>
                            </h5>
                        </div>


                        {{-- <h5 class="mgt dropdown">
                            <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Category </a>
                            <ul class="dropdown-menu">

                                @foreach ($categories as $category)
                                <li><a
                                        href="{{ route('category.show', $category->category_id) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </h5> --}}

                    </div>



                    <div class="col_1 navbar-brand">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" style="width: 350px">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="margin-left: 40px;  margin-top:10px; background-color:azure">

                        <li><a class="m_tag active_tab" href="{{ url('/') }}">Home</a></li>

                        @php
                            $products = \App\Models\Product::all();
                        @endphp
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        <li class="dropdown">
                            <a class="m_tag" href="#" data-toggle="dropdown" role="button"
                                aria-expanded="false">Product <span class="caret"></span></a>
                            <ul class="dropdown-menu drop_3" role="menu">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('category.show', $category->category_id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                        <li><a class="m_tag" href="{{ url('/Aboutus') }}">About Us</a></li>
                        <li><a class="m_tag" href="{{ url('/Contactus') }}">Contact</a></li>

                    </ul>

                </div>

            </div>

        </nav>

    </section>

    {{-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav" style="margin-left: 40px;  margin-top:10px; background-color:azure">

            <li><a class="m_tag active_tab" href="{{ url('/') }}">Home</a></li>

            @php
                $products = \App\Models\Product::all();
            @endphp
            @php
                $categories = \App\Models\Category::all();
            @endphp
            <li class="dropdown">
                <a class="m_tag" href="#" data-toggle="dropdown" role="button"
                    aria-expanded="false">Product <span class="caret"></span></a>
                <ul class="dropdown-menu drop_3" role="menu">
                    @foreach ($categories as $category)
                        <li><a
                                href="{{ route('category.show', $category->category_id) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach

                </ul>
            </li>

            <li><a class="m_tag" href="{{ url('/Aboutus') }}">About Us</a></li>
            <li><a class="m_tag" href="{{ url('/Contactus') }}">Contact</a></li>

        </ul>

    </div>

    <section id="menu" class="clearfix cd-secondary-nav">
        <nav class="navbar nav_t">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <!-- Off-canvas toggle button -->
                    <button type="button" class="navbar-toggle" id="offcanvas-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Logo -->
                    <a href=" " class="col_1 navbar-brand">
                        <img src="{{ asset('AdminPanel/assets/images/logos/logo.jpg') }}" width="100"
                            height="90" alt="">
                    </a>


                </div>

                <!-- Off-canvas menu -->
                <div id="offcanvas-menu" class="offcanvas">
                    <ul class="nav navbar-nav" style="margin-left: 40px;  margin-top:10px; background-color:azure">
                        <li><a class="m_tag active_tab" href="{{ url('/') }}">Home</a></li>
                        <li class="dropdown">
                            <a class="m_tag" href="#" data-toggle="dropdown" role="button" aria-expanded="false">Product <span class="caret"></span></a>
                            <ul class="dropdown-menu drop_3" role="menu">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('category.show', $category->category_id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a class="m_tag" href="{{ url('/Aboutus') }}">About Us</a></li>
                        <li><a class="m_tag" href="{{ url('/Contactus') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </section> --}}


    <script>
        function checkCartItems() {
            var totalItems = parseInt($("#cart-badge").text());

        //     if (totalItems === 0) {
        //     $("#cart-badge").hide();
        // }

            if (totalItems == 0) {
                // Show alert if cart is empty
                alert("Your cart is empty! Please add items to cart.");
                // Redirect to homepage
                window.location.href = "{{ url('/') }}";
            } else {
                window.location.href = "{{ route('cart.view') }}";
            }
        }



    </script>

<script>
    $(document).ready(function() {
        $('#offcanvas-toggle').on('click', function() {
            $('#offcanvas-menu').toggleClass('show');
        });

        // Close offcanvas when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#offcanvas-menu, #offcanvas-toggle').length) {
                $('#offcanvas-menu').removeClass('show');
            }
        });
    });
</script>


