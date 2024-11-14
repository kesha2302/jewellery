
<section id="list">
    <div class="container">
        <div class="row">
            <!-- Loop through each category -->
            @foreach($categories as $category)
                <div class="list_1 clearfix">
                    <div class="col-sm-12">
                        <div class="list_1l clearfix">
                            <h3 class="mgt"><span class="col_1">{{ $category->name }}</span> Collections</h3>
                            <p>We craft exceptionally fashionable & trendy designs to make you look beautiful every day.</p>
                        </div>
                    </div>
                </div>

                <!-- Carousel Section for Each Category -->
                <div class="list_2 clearfix">
                    <div id="carousel-category-{{ $category->id }}" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($category->products->chunk(4) as $productChunk)
                                <div class="item @if($loop->first) active @endif">
                                    <div class="row">
                                        @foreach($productChunk as $product)
                                            <div class="col-sm-3">
                                                <div class="list_2i clearfix mgt-center">

                                                    @if($product->discount_price>1)
                                                    <div style="position: absolute; top: 10px; right: 10px; background-color: red; color: white; padding: 5px 15px; font-size: 14px; font-weight: bold; text-transform: uppercase; transform: rotate(45deg); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: ;">
                                                        Discount
                                                    </div>
                                                @endif
                                                    <a href="#"><img src="{{ asset('productsimg/' . $product->image) }}" class="iw" alt="{{ $product->name }}"></a>
                                                    <h4><a class="col_1 " href="#">{{ $product->name }}</a></h4>

                                                    <div class="price-section" style="height: 70px;">
                                                    <h4><i class="fa fa-rupee"></i> {{ $product->price }}</h4>
                                                @if($product->discount_price>1)
                                                    <h6 style="color:#d93d3d;">Discount: <i class="fa fa-rupee"></i> {{ $product->discount_price }}</h6>
                                                @endif
                                                    </div>
                                                    {{-- <h4 style="color:#d93d3d;"><i class="fa fa-rupee"></i> {{ $product->discount_price }}</h4> --}}
                                                    <div class="mt-5">
                                                        <a href="{{ route('product.show', $product->product_id) }}" class="btn btn-primary btn-block" style="background-color: #d93d3d; border:none; margin-top: 20px;">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls for the specific category carousel -->
                        <div class="feature_2_last text-center clearfix">
                            <div class="col-sm-12">
                                <div class="controls">
                                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-category-{{ $category->id }}" data-slide="prev"></a>
                                    <a class="right fa fa-chevron-right btn btn-success" href="#carousel-category-{{ $category->id }}" data-slide="next"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<style>
    .list_2i img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
</style>
