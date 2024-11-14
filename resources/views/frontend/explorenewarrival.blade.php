<section id="list_o_1">
    <div class="container">
        <div class="row">
            <div class="list_1 clearfix">
                <div class="col-sm-9">
                    <div class="list_1l clearfix">
                        <h3 class="mgt">Explore <span class="col_1">The New Arrivals</span></h3>
                        {{-- <p>We craft exceptionally fashionable &amp; trendy designs to make you look beautiful every day.</p> --}}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="list_1r text-right clearfix">
                        {{-- <h5 class="mgt"><a class="button mgt" href="#">VIEW ALL</a></h5> --}}
                    </div>
                </div>
            </div>
            <div class="list_2 clearfix">
                <div id="carousel-example_2" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach ($products->chunk(4) as $chunk) <!-- Group products into chunks of 4 -->
                            <div class="item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($chunk as $product)
                                        <div class="col-sm-3">
                                            <div class="list_2i clearfix mgt-center">
                                                <a href="#"><img src="{{ asset('productsimg/' . $product->image) }}" class="iw" alt="{{ $product->name }}"></a>

                                                <h4><a class="col_1" href="#">{{ $product->name }}</a></h4>

                                                <div class="price-section" style="height: 70px;">
                                                    <h4><i class="fa fa-rupee"></i> {{ $product->price }}</h4>
                                                @if($product->discount_price)
                                                    <h6 style="color:#d93d3d;">Discount: <i class="fa fa-rupee"></i> {{ $product->discount_price }}</h6>
                                                @endif
                                                    </div>


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
                </div>
                <div class="feature_2_last text-center clearfix">
                    <div class="col-sm-12">
                        <!-- Controls -->
                        <div class="controls">
                            <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example_2" data-slide="prev"></a>
                            <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example_2" data-slide="next"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
