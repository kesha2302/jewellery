@extends('Frontend.Layout.main')

@section('main-container')
<div class="container">
    <h1>{{ $categories->name }}</h1>
    <div class="row">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <img src="{{ asset('productsimg/' . $product->image) }}" alt="{{ $product->name }}" class="img-responsive">
                        <h4>{{ $product->name }}</h4>
                        <p>{{ $product->price }} USD</p>
                        <a href="{{ route('product.show', $product->product_id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            @endforeach
        @else
            <p>No products found in this category.</p>
        @endif
    </div>
</div>
@endsection
