 {{-- <section id="center" class="center_home">
    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
         <!-- Overlay -->
         <div class="overlay"></div>

         <!-- Indicators -->
         <ol class="carousel-indicators">
           <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
           <li data-target="#bs-carousel" data-slide-to="1" class=""></li>
           <li data-target="#bs-carousel" data-slide-to="2" class=""></li>
         </ol>

         <!-- Wrapper for slides -->
         <div class="carousel-inner">
           <div class="item slides active">
             <div class="slide-1"></div>
             <div class="hero">
               <h1 class="mgt">Rd Jewellers</h1>

               <hr>
               <p>Nulla quis sem at nibh elementum imperdiet <br> lacinia arcu eget nulla!</p>
               <h4><a class="button col" href="#">View More</a></h4>
               <h4><a class="button_1 col" href="#"> Shop Now</a></h4>
             </div>
           </div>
           <div class="item slides">
             <div class="slide-2"></div>
             <div class="hero hero_1">
               <h1 class="mgt">Dolore Magna</h1>
               <hr>
               <p>Nulla quis sem at nibh elementum imperdiet <br> lacinia arcu eget nulla!</p>
               <h4><a class="button col" href="#">View More</a></h4>
               <h4><a class="button_1 col" href="#"> Shop Now</a></h4>
             </div>
           </div>
           <div class="item slides">
             <div class="slide-3"></div>
             <div class="hero">
               <h1 class="mgt">Fusce  Tellus </h1>
               <hr>
               <p>Nulla quis sem at nibh elementum imperdiet <br> lacinia arcu eget nulla!</p>
               <h4><a class="button col" href="#">View More</a></h4>
               <h4><a class="button_1 col" href="#"> Shop Now</a></h4>
             </div>
           </div>
         </div>
       </div>


   </section> --}}
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

