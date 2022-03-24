<section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
    <div class="relative max-w-7xl mx-auto">
        @if ($title)
            @include('partials.title', ['type' => 'border', 'title' => 'Nuestras marcas'])
        @endif
        
        <div class="mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row justify-center fadeIn md:space-x-5 owl-carousel owl-carousel-multi owl-theme">
            @foreach ($brands as $brand)
                <div class="flex items-center justify-center px-0 py-3 md:p-3 w-full">
                    <div class="flex flex-col items-center justify-center overflow-hidden fadeIn px-6">
                        <div class=" flex flex-col items-center justify-center">
                            <img
                                loading="lazy"
                                src="{{$brand->getImage()}}"
                                width="100px" height="100px"
                                alt="{{$brand->meta_title}}"
                                class="h-full w-full object-contain"
                            />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>