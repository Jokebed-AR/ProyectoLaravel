<div class="mt-12 max-w-lg mx-auto flex flex-col md:flex-row justify-between items-center fadeIn md:space-x-5">
    <div class="flex-1">
        <h2 class="text-3xl  text-secondary-100 tracking-tighter font-bold  leading-snug uppercase pb-3 pt-5">
            {{ $landingPage->related_products_title }}
        </h2>
    </div>
</div>

@foreach($relatedProducts as $relatedProduct)
    <div class="mt-12 max-w-lg mx-auto flex flex-col md:flex-row justify-between items-center fadeIn md:space-x-5 text-center">
        @foreach($relatedProduct as $product)
            <?php $product =  App\Models\Product::find($product['id']) ?>
            @if($product != null)
                <div class="flex-1 pt-3">
                    <a href="/productos/{{$product->getUrl()}}">
                        <img src="{{$product->getImage()}}" alt="{{$product->name}}" width="60%" class="img pb-5" style="display:block;margin:auto;">
                        <h3 class="pt-5"><b>{{$product->name}}</b></h3>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endforeach
