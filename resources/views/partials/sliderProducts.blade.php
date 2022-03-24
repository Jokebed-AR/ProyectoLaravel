<section class="relative bg-white pt-16 pb-8 px-8 sm:px-8">
    <div class="relative max-w-7xl mx-auto">
        @include('partials.title', ['type' => 'blue', 'title' => 'Productos.', 'note' => ''])
        <div class="w-full flex flex-col md:flex-row md:flex-wrap fadeIn owl-carousel owl-carousel-one owl-theme">
            @foreach ($homeProducts as $homeProduct)
                @if($homeProduct->getImage() !== "")
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col justify-center items-center w-64 h-64">
                            <img
                                loading="lazy"
                                src="{{$homeProduct->getImage()}}"
                                width="100px" height="100px"
                                alt="{{$homeProduct->title}}"
                                class="h-full w-full object-contain cursor-pointer"
                                @click="goProduct('{{$homeProduct->getUrl()}}')"
                            />
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

