@if ($type === 'lottie')
    <div class="flex flex-col overflow-hidden fadeIn">
        <div class="flex flex-col items-center">
            <animation
                :path="'{{$service['lottie']}}'"
                class="h-full w-full md:h-56 md:w-56 object-center"
                :autoplay="true"
            />
            <div class="border-b-5 border-gray-100 mt-1 w-1/2"></div>
        </div>

        <div class="bg-white flex flex-col justify-between mt-4">
            <div class="flex-1">
                <a href="#" class="block hover:no-underline">
                    <h3 class="text-xl md:text-3xl f-m text-center leading-normal text-gray-100">
                        {{$service['content']}}
                    </h3>
                </a>
            </div>
        </div>
    </div>
@elseif ($type === 'gif')
    <div class="flex flex-col overflow-hidden fadeIn">
        <div class="flex flex-col items-center">
            @if(\Illuminate\Support\Facades\Blade::check('browser', 'isSafari'))
                <img src="{{ $service['gif'] }}" alt="gif" loading="lazy" class="h-64 w-64 object-contain" height="16rem" width="16rem">  
            @else
                <video autoplay loop muted playsinline>
                    <source src="{{ $service['gif'] }}" type="video/webm">
                </video>
            @endif
            <div class="border-b-5 border-gray-100 mt-1 w-1/2"></div>
        </div>

        <div class="bg-white flex flex-col justify-between mt-4">
            <div class="flex-1">
                <div class="block hover:no-underline">
                    <h3 class="text-xl md:text-3xl f-m text-center leading-normal text-gray-100">
                        {{$service['content']}}
                    </h3>
                </div>
            </div>
        </div>
    </div>
@elseif ($type === 'cart')
    <div class="flex flex-col rounded-xl shadow-sm overflow-hidden fadeIn w-full">

        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
            <div class="flex flex-col justify-center">
                <div class="flex flex-col justify-center">

                    <h2 class="text-2xl text-center font-bold text-gray-100 uppercase">
                        {{$product->name}}
                    </h2>
                </div>
            </div>
        </div>


        <div class="flex-shrink-0 bg-white h-64">
            <div class="owl-carousel owl-carousel-one owl-theme cursor-pointer">
                @foreach ($product->getImages() as $image)
                    @if($product->redirect != null && $product->redirect != '')
                        <a href="{{$product->redirect}}" target="_blank">
                            <div class="item h-64">
                                <img
                                        class="h-64 w-64 object-contain"
                                        height="16rem"
                                        width="16rem"
                                        src="{{$image}}"
                                        loading="lazy"
                                        alt="{{$product->name}} Imagen"
                                />
                            </div>
                        </a>
                    @else
                        <div class="item h-64" @click="goProduct('{{$product->getUrl()}}')">
                            <img
                                    class="h-64 w-64 object-contain"
                                    height="16rem"
                                    width="16rem"
                                    src="{{$image}}"
                                    loading="lazy"
                                    alt="{{$product->name}} Imagen"
                            />
                        </div>
                    @endif

                @endforeach
            </div>
            {{-- <img
                @click="goProduct('{{$product->getUrl()}}')"
                class="h-full w-full object-contain cursor-pointer"
                src="{{$product->getImage()}}"
                loading="lazy"
                alt="{{$product->title}}"
            /> --}}
        </div>

        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div class="flex flex-col justify-center items-center">
                    {{-- <h3 class="text-lg text-left font-bold text-green f-m">
                        Disponible
                    </h3> --}}
                    {{-- <br> --}}
                    <div class="w-full line-clamp text-justify">
                        <h3>{!!$product->resum!!}</h3>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex flex-col justify-center">
                    
                    @if ($product->discount !== null && $product->discount !== 0.0)
                    
                    @endif
                </div>
                <div class="flex flex-row justify-center items-end">
                    @if ($product->discount !== null && $product->discount !== 0.0)
                        @if($product->price_tax > 5)
                            <div class="">
                                <h3 class="text-2xl text-right font-semibold {{$product->getTextColor()}} uppercase line-through">
                                    $ {{ number_format($product->price_tax, 0) }}
                                </h3>
                                <h3 class="text-2xl text-right font-semibold text-red uppercase">
                                    $ {{ number_format($product->discount, 0) }}
                                </h3>
                            </div>
                        @endif
                    @else
                        @if($product->price_tax > 5)
                            <div class="">
                                <h3 class="text-2xl text-right font-semibold {{$product->getTextColor()}} uppercase">
                                    $ {{ number_format($product->price_tax, 0) }} <sup class="sup-height-3">00</sup>
                                </h3>
                            </div>
                        @endif
                    @endif
                    @if($product->price_tax > 0)
                        <h3 class="text-lg text-right font-semibold text-gray-100 uppercase ml-1">
                            &nbsp;
                        </h3>
                    @endif
                </div>
            </div>
            <div class="mt-2 flex items-center justify-center space-x-2" v-show="{{$button ? $button : 'true'}}">
                @if($product->redirect != null && $product->redirect != '')
                    <a
                            target="_blank"
                            href="{{$product->redirect}}"
                            class="inline-block w-md h-10 justify-center items-center px-8 py-1 text-lg font-bold {{$product->getButtonColor()}} text-white  hover:no-underline transition duration-500 ease-in-out"
                    >
                        <span class="uppercase text-lg">C O T I Z A</span> 
                    </a>
                @else
                    <button
                            @click="showModal({{$product}}, {{$product->category}})"
                            class="inline-block w-md h-10 justify-center items-center px-8 py-1 text-lg font-bold {{$product->getButtonColor()}} text-white  hover:no-underline transition duration-500 ease-in-out"
                    >
                        <span class="uppercase text-lg">C O T I Z A</span> 
                    </button>
                @endif

                {{-- @include('partials.button', ['type' => 2, 'title' => 'agregar al cotizador', 'class' => 'w-full h-32']) --}}
            </div>
        </div>
    </div>
@elseif ($type === 'clasification')
    <div class="flex flex-col border-2 border-gray-700 overflow-hidden fadeIn w-full p-8">
        <div class="flex-shrink-0 bg-white h-40 md:h-48">
            <a href="{{ '/productos/'. $category->classification->name . '/' . $category->url .'/todas-las-subcategorias/todas-las-marcas' }}">
                <img
                    class="h-full w-full object-cover cursor-pointer"
                    src="{{$category->getLogo()}}"
                    loading="lazy"
                    alt="{{$category->meta_title}}"
                />
            </a>
        </div>

        <div class="flex-1 flex flex-col justify-between -mt-4 md:-mt-16">
            <div class="flex items-center justify-between">
                <div class="flex flex-col justify-end items-end">
                    <a href="{{ '/productos/'. $category->classification->name . '/' . $category->url.'/todas-las-subcategorias/todas-las-marcas' }}"
                       class="text-2xl text-left font-semibold text-primary cursor-pointer uppercase hover:underline transition duration-300 ease-in-out">
                        {{$category->name}}
                    </a>
                </div>
                <div class="flex flex-col justify-end items-end w-32 h-32 md:w-48 md:h-48">
                    @if($category->getImage() !== '')
                        <img
                            class="h-full w-full object-contain cursor-pointer"
                            src="{{$category->getImage()}}"
                            loading="lazy"
                            alt="{{$category->title}}"
                        />
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <div class="flex flex-col overflow-hidden fadeIn px-6">
        <div class="flex flex-col items-center">
            <img
                class="h-full w-full object-center"
                width="100px" height="100px"
                src="{{$productImg['uri']}}"
                loading="lazy"
                alt="{{$productImg['title']}}"
            />
        </div>

        <div class="flex bg-white p-3 justify-center">
            <a href="/productos/{{$productImg['name']}}"
               class="{{$productImg['color']}} uppercase inline-block text-center px-4 py-2 rounded-full text-lg font-bold text-white hover:border-transparent hover:no-underline {{$productImg['color'] === 'bg-secondary-100' ? 'hover:bg-secondary-900' : ''}} transition duration-500 ease-in-out"
            >
                {{$productImg['title']}}
            </a>
        </div>
    </div>
@endif
