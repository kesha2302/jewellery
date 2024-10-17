@extends('Frontend.Layout.main')

@section('main-container')

<section id="center" class="clearfix center_prod" style="margin-bottom: 20px;">
    <div class="container">
     <div class="row">
       <div class="center_prod_1 clearfix">
        <div class="col-sm-12">
         <h6 class="mgt col_1 normal"><a href="#">Home</a>  <i style="font-size:14px; margin-left:5px; margin-right:5px;" class="fa fa-chevron-right"></i>{{ $categories->name }}</h6>
        </div>
       </div>
     </div>
    </div>
    </section>

<div class="container" style="margin-bottom: 20px;">
    <h1 style="margin-bottom: 20px;">{{ $categories->name }}</h1>
    <div class="row">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <img src="{{ asset('productsimg/' . $product->image) }}" alt="{{ $product->name }}" class="img-responsive"
                        style="height: 300px; width: 100%; margin-bottom: 20px; border-radius: 15px;">
                        <h4>{{ $product->name }}</h4>
                        <p>₹{{ $product->price }}</p>
                        <a href="{{ route('product.show', $product->product_id) }}" class="btn btn-danger">View Details</a>
                    </div>
                </div>
            @endforeach
        @else
            <p>No products found in this category.</p>
        @endif
    </div>
</div>
@endsection
