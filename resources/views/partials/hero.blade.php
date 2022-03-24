@if ($type === 1)
    <div  class="hidden md:block pb-20">
        <!-- Slideshow container -->
        <div class="slideshow-container">

            <!-- Full-width images with number and caption text pb-3rem -->
            @foreach ($modalNewsletters as $modalNewsletter)
                <div class="mySlides fade">
                    <div  class="hidden md:block mb-20">
                        @if($modalNewsletter->button_redirect != null)
                            <a href="{{$modalNewsletter->button_redirect}}" class="bg-opacity"></a>
                        @else
                            <div class="bg-opacity"></div>
                        @endif
                        

                        <div class="flex-1 flex justify-start px-6 py-32 fadeInUpDown min-h-home-banner" style="background: url({{$modalNewsletter->getImageDesktop()}}) center center / cover no-repeat;">
                            <div class="text-left py-16 px-4"  style="width: 55%;">
                                <h1 class="home-title text-6xl leading-tight tracking-normal font-bold text-white uppercase border-l-10 border-secondary-100 px-6 z-index-15">
                                    
                                    @if($modalNewsletter->button_redirect != null)
                                        <a href="{{$modalNewsletter->button_redirect}}" class="z-index-15">
                                            <span>{!!  $modalNewsletter->title !!}</span>
                                        </a>
                                    @else
                                        <span>{!!  $modalNewsletter->title !!}</span>
                                    @endif

                                </h1>

                                <h3 class="fadeIn animation-slowest mt-16 text-3xl tracking-tight font-extrabold text-white leading-snug uppercase pl-8 pr-32 f-m z-index-15">
                                    {!! $modalNewsletter->description !!}
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Next and previous buttons -->
            <a class="z-index-15 prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="z-index-15 next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <!-- The dots/circles -->
        <div class="mt-dots-home" style="text-align:center">
            @foreach($modalNewsletters as $index => $value)
                <span class="dot" onclick="currentSlide({{$index}})"></span>
            @endforeach
        </div>
    </div>
    <div class="md:hidden">
        <div>
            <!-- Slideshow container -->
            <div class="slideshow-container">
                <!-- Full-width images with number and caption text -->
                @foreach ($modalNewsletters as $modalNewsletter)
                    <div class="mySlidesSm fade">
                        @if($modalNewsletter->button_redirect != null)
                            <a href="{{$modalNewsletter->button_redirect}}" class="bg-opacity"></a>
                        @else
                            <div class="bg-opacity"></div>
                        @endif
                        
                        <div class="md:hidden flex justify-center py-32" style="background: url({{$modalNewsletter->getImageMobile()}}) center center / cover no-repeat; background-size:100% 100%;">
                            <div class="text-center py-32 w-full px-6" >
                                <h1 class="home-title animation-fast text-3xl tracking-tight font-bold text-white leading-snug uppercase border-b-4 border-secondary-100 px-2">

                                    @if($modalNewsletter->button_redirect != null)
                                        <a href="{{$modalNewsletter->button_redirect}}" class="z-index-15">
                                            <span>{!!  $modalNewsletter->title !!}</span>
                                        </a>
                                    @else
                                        <span>{!!  $modalNewsletter->title !!}</span>
                                    @endif

                                </h1>

                                <h2 class="zoomIn animation-slow mt-8 text-lg tracking-tight font-extrabold text-white leading-snug uppercase px-6">
                                    {!! $modalNewsletter->description !!}
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Next and previous buttons -->
                <a class="z-index-15 prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="z-index-15 next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <!-- The dots/circles -->
            <div style="text-align:center">
                @foreach($modalNewsletters as $index => $value)
                    <span class="dotSm" onclick="currentSlide({{$index}})"></span>
                @endforeach
            </div>
        </div>
    </div>
@elseif($type === 2)
    <div class="hidden md:block">
        <div class="flex flex-1 flex-col justify-start items-center px-6">
            <img
                class="px-4 hidden md:block"
                src="{{$img}}"
                loading="lazy"
                alt="Fondo nosotros proproyectos"
                style="width: 100%; height: auto;"
            />
            <div class="border-b-10 border-secondary-900 px-128 mt-16"></div>
        </div>
    </div>
    <div class="flex md:hidden justify-center pt-0 md:py-32" style="background: url({{$imgMobile}}) center center / cover no-repeat;">
        <div class="text-center py-32 w-full px-6" >
            <h1 class="text-3xl tracking-tight font-bold text-black leading-snug uppercase border-b-4 border-secondary-100 px-2 mb-64">
                {{$title}}
            </h1>

            {{-- <h3 class="mt-16 text-lg tracking-tight font-extrabold text-black leading-snug uppercase px-6">
                {{$note}}
            </h3> --}}
        </div>
    </div>
@endif