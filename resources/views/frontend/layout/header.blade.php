<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rd Jewellers</title>
	<link href="{{asset("frontend/css/bootstrap.min.css")}}" rel="stylesheet">
	<link href="{{asset("frontend/css/global.css")}}" rel="stylesheet">
	<link href="{{asset("frontend/css/index.css")}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset("frontend/css/font-awesome.min.css")}}" />
	<link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
	<script src="{{asset("frontend/js/jquery-2.1.1.min.js")}}"></script>
    <script src="{{asset("frontend/js/bootstrap.min.js")}}"></script>
  </head>

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
	    <h2 style="margin-top: 28px;"><a class="col_1" href="{{url('/')}}">Veehaagate</a></h2>
	 </div>
	</div>
	<div class="col-sm-10">
	 <div class="header_1r clearfix">
	   {{-- <div class="header_1ri border_none clearfix">
	     <div class="input-group">
					<input type="text" class="form-control" placeholder="Search" style="width: 350px">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button">
							<i class="fa fa-search"></i></button>
					</span>
				 </div>
	   </div> --}}
       <ul class="nav navbar-nav" style="margin-left: 40px;">

        <li><a class="m_tag active_tab" href="{{url('/')}}">Home</a></li>
        {{-- <li class="dropdown">
              <a class="m_tag" href="#" data-toggle="dropdown" role="button" aria-expanded="false">Product</a>
              <ul class="dropdown-menu drop_3" role="menu">
                <li><a href="product.html">Product</a></li>
                <li><a class="border_none" href="detail.html">Product Detail</a></li>
              </ul>
            </li> --}}
            @php
            $products = \App\Models\Product::all();
          @endphp
            <li class="dropdown">
                <a class="m_tag" href="#" data-toggle="dropdown" role="button" aria-expanded="false">Product <span class="caret"></span></a>
                <ul class="dropdown-menu drop_3" role="menu">
                    @foreach ($products as $product)
                        <li><a href="{{ route('product.show', $product->product_id) }}">{{ $product->name }}</a></li>
                    @endforeach
                </ul>
            </li>

        {{-- <li class="dropdown">
              <a class="m_tag" href="#" data-toggle="dropdown" role="button" aria-expanded="false">Blog<span class="caret"></span></a>
              <ul class="dropdown-menu drop_3" role="menu">
                <li><a href="blog.html">Blog</a></li>
                <li><a class="border_none" href="blog_detail.html">Blog Detail</a></li>
              </ul>
            </li> --}}

        <li><a class="m_tag" href="{{url('/Aboutus')}}">About Us</a></li>
        <li><a class="m_tag" href="{{url('/Contactus')}}">Contact</a></li>


    </ul>


       <div class="header_1ri clearfix" style="margin-left: 50px;">
        @auth

        {{-- <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark text-center" style="margin-left: 20px; background-color: #d93d3d;"><b>Logout</b></button>
        </form> --}}
        <div class="header_1ri border_none clearfix">
            <span class="span_1">
                <a class="col_1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user"></i>
                </a>
              </span>

            <h5 class="mgt dropdown">
              <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My<br>Profile </a>
              <ul class="dropdown-menu">
                <li><a href="{{url('/edit-profile')}}">Profile</a></li>
                <li><a href="{{url('/orderhistory')}}">Order History</a></li>
                <li> <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark text-center" style="margin-left: 20px; background-color: #d93d3d; color:white;"><b>Logout</b></button>
                </form></li>
              </ul>
            </h5>
        @else
        <span class="span_1">
            <a class="col_1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i>
            </a>
          </span>

        <h5 class="mgt dropdown">
          <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My <br>Account </a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/Login')}}">Login</a></li>
            <li><a href="{{url('/register')}}">Sign Up</a></li>
          </ul>
        </h5>
        @endauth
      </div>


      <div class="header_1ri border_none clearfix " style="position: relative;">
        <span class="span_1">
            <a class="col_1" href="#">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span class="badge rounded-pill bg-danger" style="position: absolute; top: -5px; right: -0px;">{{ $totalItems }}</span>
            </a>
        </span>
        <h5 class="mgt">
            <a href="{{ route('cart.view') }}">My <br> Cart</a>
        </h5>
    </div>




	   {{-- <div class="header_1ri border_none clearfix">
	     <span class="span_1"><a class="col_1" href="#"><i class="fa fa-heart-o"></i></a></span>
		 <h5 class="mgt"><a href="#">My <br> Wishlist (0)</a></h5>
	   </div> --}}

	 </div>
	</div>
   </div>
  </div>
 </div>
</section>

