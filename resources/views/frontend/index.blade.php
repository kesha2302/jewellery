@extends('frontend.layout.main')
@section('main-container')

{{-- @if(session('success'))

<script>
    alert("Welcome, {{ session('username') }}!");
</script>
@endif --}}


   @php
   $banners = \App\Models\Banner::all();
 @endphp

@include('frontend.banner')
   @php
   $products = \App\Models\Product::all();
 @endphp

 @php
   $categories = \App\Models\Category::all();
 @endphp

   @include('Frontend.allproducts')





   {{-- <section id="list_o">
    <div class="container">
     <div class="row">
      <div class="price_1 text-center clearfix">
          <div class="col-sm-12">
            <h3 class="mgt">Shop by  <span class="col_1">Your Preference</span></h3>
           <p>Explore our unique daily wear jewellery designs that reflect elegance and exclusivity.</p>
          </div>
      </div>
      <div class="list_2 clearfix">
        <div id="carousel-example_1" class="carousel slide" data-ride="carousel">
               <!-- Wrapper for slides -->
               <div class="carousel-inner">
                   <div class="item active">
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/6.jpg" class="iw" alt="abc"></a>
                           <h5><a class="button_1" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/7.jpg" class="iw" alt="abc"></a>
                          <h5><a class="button" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/8.jpg" class="iw" alt="abc"></a>
                           <h5><a class="button_1" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/9.jpg" class="iw" alt="abc"></a>
                           <h5><a class="button" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                   </div>
                   <div class="item">
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/10.jpg" class="iw" alt="abc"></a>
                           <h5><a class="button_1" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/11.jpg" class="iw" alt="abc"></a>
                           <h5><a class="button" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/12.jpg" class="iw" alt="abc"></a>
                           <h5><a class="button_1" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="list_2i text-center clearfix">
                           <a href="#"><img src="img/13.png" class="iw" alt="abc"></a>
                           <h5><a class="button" href="#">SHOP NOW</a></h5>
                         </div>
                       </div>
                   </div>
               </div>
           </div>
        <div class="feature_2_last text-center clearfix">
               <div class="col-sm-12">
                   <!-- Controls -->
                   <div class="controls">
                       <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example_1" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example_1" data-slide="next"></a>
                   </div>
               </div>
           </div>
      </div>
     </div>
    </div>
   </section> --}}



  @include('frontend.explorenewarrival')









@endsection
