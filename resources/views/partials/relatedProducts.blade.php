<section class="relative bg-white pt-16 pb-20">
    <div class="relative max-w-8xl mx-auto">
        <div class="max-w-lg mx-auto flex flex-row xs:flex-wrap md:flex-no-wrap md:justify-center fadeIn md:space-x-5 owl-carousel {{count($relatedProducts) > 1 ? 'owl-carousel-multi' : 'owl-carousel-one'}} owl-theme">
            @foreach ($relatedProducts as $product)
                <div class="mb-16 flex justify-center {{count($relatedProducts) > 1 ? '' : 'w-1/4'}}">
                    @include('partials.cards', ['type' => 'cart', $product, 'button' => 'false'])
                </div>
            @endforeach
        </div>
    </div>
</section>