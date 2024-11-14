   <section id="center" class="center_home " style="margin-top: 20px;">

    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <!-- Overlay -->
        <div class="overlay"></div>

        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($banners as $index => $banner)
                <li data-target="#bs-carousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="item slides {{ $index === 0 ? 'active' : '' }}">
                    <div class="slide-{{ $index + 1 }} " style="background-image: url('{{ asset('BannerImage/' . $banner->image) }}');"></div>
                    <div class="hero">
                        <h1 class="mgt">{{ $banner->title }}</h1>
                        <hr>
                        <p>{{ $banner->description }}</p>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>

