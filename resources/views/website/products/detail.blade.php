@extends('layouts.website', [$clasifications, $brands])

@section('content')
    @include('partials.sideBar', ['type' => 'top', 'types' => $categories])
    
    @include('partials.banner', [
        'type' => 2,
        'img' => $subcategory->getImage(),
        'title' => $category->name.' - '.$subcategory->name,
        'url' => getFilterUri($filters, 'category', $category->url)
    ])
    @include('partials.breadcrumbs', ['style' => 2])
    <section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
        <div class="relative max-w-7xl mx-auto">
            <div class="mt-12 flex flex-col justify-center fadeIn">
                <div class="mb-16 flex flex-col md:flex-row justify-between">
                    <div class="flex flex-col items-center md:w-1/2 px-4">
                        <div class="owl-carousel owl-carousel-one owl-theme">
                            @foreach ($productDetail->getImages() as $image)
                                <div class="item h-90 flex justify-center">
                                    <img
                                        class="h-full w-32 object-contain"
                                        width="100px" height="100px"
                                        src="{{$image}}"
                                        loading="lazy"
                                        alt="{{$productDetail->name}} Imagen producto"
                                    />
                                </div>
                            @endforeach
                            @foreach ($productDetail->getVideos() as $videoUrl)
                                <div class="item flex justify-center">
                                    <iframe
                                            src="{{$videoUrl}}"
                                            frameborder="0"
                                            class="w-full h-90"
                                            allowfullscreen="false">
                                    </iframe>
                                </div>
                                {{-- <a class="owl-video" href="{{$videoUrl}}"></a> --}}
                            @endforeach
                        </div>
                        {{-- <span>{{$productDetail->getVariants()}}</span> --}}
                        @if (count($productDetail->getDocuments()) > 0)    
                            <div class="flex justify-center items-center self-center md:w-full">
                                <div class="flex space-x-2">
                                    <svg width="16" x="0px" y="0px" viewBox="0 0 29.978 29.978" style="enable-background:new 0 0 29.978 29.978;" fill="color: rgba(85,85,85,var(--text-opacity));">
                                        <g>
                                            <path d="M25.462,19.105v6.848H4.515v-6.848H0.489v8.861c0,1.111,0.9,2.012,2.016,2.012h24.967c1.115,0,2.016-0.9,2.016-2.012   v-8.861H25.462z"/>
                                            <path d="M14.62,18.426l-5.764-6.965c0,0-0.877-0.828,0.074-0.828s3.248,0,3.248,0s0-0.557,0-1.416c0-2.449,0-6.906,0-8.723   c0,0-0.129-0.494,0.615-0.494c0.75,0,4.035,0,4.572,0c0.536,0,0.524,0.416,0.524,0.416c0,1.762,0,6.373,0,8.742   c0,0.768,0,1.266,0,1.266s1.842,0,2.998,0c1.154,0,0.285,0.867,0.285,0.867s-4.904,6.51-5.588,7.193   C15.092,18.979,14.62,18.426,14.62,18.426z"/>
                                        </g>
                                    </svg>
                                    <h3 class="text-xl text-gray-100"><i>Descargables</i></h3>
                                </div>
                            </div>
                        @endif
                        <div class="flex flex-wrap justify-center items-center self-center md:w-full mb-6">
                            <?php $isFirst = false; ?>
                            @if (isset($productDetail->getDocuments()["ficha-tecnica"]))
                                <?php $isFirst = true; ?>
                                <div class="w-full {{count($productDetail->getDocuments()) === 1 ?  'md:w-full' :'md:w-1/3'}}">
                                    <a
                                            href="{{$productDetail->getDocuments()["ficha-tecnica"]}}"
                                            target="_blank"
                                            rel="noreferrer"
                                            aria-label="FICHA TÉCNICA Button"
                                            class="flex justify-center w-full items-center py-1 text-lg font-bold text-secondary-100 hover:border-transparent hover:text-primary hover:no-underline transition duration-500 ease-in-out bg-transparent"
                                    >
                                        <span class="border-secondary-100 border-b uppercase text-sm text-center">FICHA TÉCNICA</span> 
                                    </a>
                                </div>
                            @endif
                            @if (isset($productDetail->getDocuments()["manual-uso"]))
                                <?php $isFirst = true; ?>
                                <div class="w-full {{count($productDetail->getDocuments()) === 1 ?  'md:w-full' :'md:w-1/3'}}">
                                    <a
                                            href="{{$productDetail->getDocuments()["manual-uso"]}}"
                                            target="_blank"
                                            rel="noreferrer"
                                            aria-label="MANUAL DE USO Button"
                                            class="flex justify-center w-full items-center py-1 text-lg font-bold text-secondary-100 hover:border-transparent hover:text-primary hover:no-underline transition duration-500 ease-in-out bg-transparent"
                                    >
                                        <span class="border-secondary-100 border-b uppercase text-sm text-center">MANUAL DE USO</span> 
                                    </a>
                                </div>
                            @endif
                            @if (isset($productDetail->getDocuments()["garantia"]))
                                <?php $isFirst = true; ?>
                                <div class="w-full {{count($productDetail->getDocuments()) === 1 ?  'md:w-full' :'md:w-1/3'}}">
                                    <a
                                            href="{{$productDetail->getDocuments()["garantia"]}}"
                                            target="_blank"
                                            rel="noreferrer"
                                            aria-label="GARANTÍA Button"
                                            class="flex justify-center w-full items-center py-1 text-lg font-bold text-secondary-100 hover:border-transparent hover:text-primary hover:no-underline transition duration-500 ease-in-out bg-transparent"
                                    >
                                        <span class="border-secondary-100 border-b uppercase text-sm text-center">GARANTÍA</span> 
                                    </a>
                                </div>
                            @endif
                            @if (isset($productDetail->getDocuments()["catalogo"]))
                                <?php $isFirst = true; ?>
                                <div class="w-full {{count($productDetail->getDocuments()) === 1 ?  'md:w-full' :'md:w-1/3'}}">
                                    <a
                                            href="{{$productDetail->getDocuments()["catalogo"]}}"
                                            target="_blank"
                                            rel="noreferrer"
                                            aria-label="CATÁLOGO Button"
                                            class="flex justify-center w-full items-center py-1 text-lg font-bold text-secondary-100 hover:border-transparent hover:text-primary hover:no-underline transition duration-500 ease-in-out bg-transparent"
                                    >
                                        <span class="border-secondary-100 border-b uppercase text-sm text-center">CATÁLOGO</span> 
                                    </a>
                                </div>
                            @endif
                            @if (isset($productDetail->getDocuments()["tabla-resistencia"]))
                                <?php $isFirst = true; ?>
                                <div class="w-full {{count($productDetail->getDocuments()) === 1 ?  'md:w-full' :'md:w-1/3'}}">
                                    <a
                                            href="{{$productDetail->getDocuments()["tabla-resistencia"]}}"
                                            target="_blank"
                                            rel="noreferrer"
                                            aria-label="TABLA RESISTENCIA Button"
                                            class="flex justify-center w-full items-center py-1 text-lg font-bold text-secondary-100 hover:border-transparent hover:text-primary hover:no-underline transition duration-500 ease-in-out bg-transparent"
                                    >
                                        <span class="border-secondary-100 border-b uppercase text-sm text-center">TABLA RESISTENCIA</span> 
                                    </a>
                                </div>
                            @endif
                            @if(count($productDetail->getDocuments()) === 4)
                                <div class="w-full {{count($productDetail->getDocuments()) === 1 ?  'md:w-full' :'md:w-1/3'}}">
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        @include('partials.title', ['type' => 'borderLeft', 'title' => $productDetail->name, 'black' => true, 'class' => 'text-4xl md:text-5xl mb-6 xs:text-center md:text-justify'])
                        <div class="flex flex-row mt-4 justify-center md:justify-start">
                            @if($productDetail->price_tax > 5 || ($productDetail->discount !== null && $productDetail->discount !== 0))
                                <div class="flex flex-col justify-center md:justify-start items-start">
                                    <h3 
                                        class="text-4xl text-center md:text-right font-semibold {{$productDetail->getTextColor()}} uppercase {{($productDetail->discount !== null && $productDetail->discount !== 0 && $productDetail->discount > 0) ? 'line-through' : ''}}" 
                                        v-if="!productSelected"
                                    >
                                        $ {{ number_format($productDetail->price_tax, 0) }} <sup class="sup-height-3">00</sup>
                                    </h3>



                                    @if($productDetail->discount !== null && $productDetail->discount !== 0 && $productDetail->discount > 0)
                                        <h3 class="text-4xl text-center md:text-right font-semibold uppercase color-discount" v-if="!productSelected">
                                            $ {{ number_format($productDetail->discount, 0) }} <sup class="sup-height-3">00</sup>
                                        </h3>
                                    @endif
                                    
                                    <h3 
                                        class="text-4xl text-center md:text-right font-semibold {{$productDetail->getTextColor()}} uppercase" 
                                        :class="{'line-through': (productSelectedVariants !== null && productSelectedVariants.discount !== null && productSelectedVariants.discount !== 0) }"
                                        v-else
                                    >
                                        <span v-if="productSelected !== 'No disponible'" >$</span> 
                                        @{{productSelected === 'No disponible' ? productSelected : number_format(productSelected, 0) }} 
                                        <sup v-if="productSelected !== 'No disponible'" class="sup-height-3">00</sup>
                                    </h3>

                                    <h3 
                                        class="text-4xl text-center md:text-right font-semibold uppercase color-discount"
                                        v-if="productSelectedVariants !== null && productSelectedVariants.discount !== 0"
                                    >
                                        $ @{{ number_format(productSelectedVariants.discount, 0) }} <sup class="sup-height-3">00</sup>
                                    </h3>

                                    <p class="text-gray-100 text-center md:text-right font-semibold  uppercase" v-if="productSelected !== 'No disponible'">
                                        <span>IVA incluido</span>
                                    </p>
                                </div>
                            @endif
                        </div>
                        <div class="xs:text-center md:text-justify no-styles">
                            {!!$productDetail->description!!}
                        </div>
                        @if (count($productDetail->characteristics) > 0)    
                            <div class="xs:text-center md:text-justify no-styles">
                                <h2>Caracteristicas</h2>
                                <ul>
                                    @foreach ($productDetail->characteristics as $characteristic)    
                                        <li>
                                            {{$characteristic->name}}: {{$characteristic->value}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- <span>{{$productDetail->getVariants()}}</span> --}}
                        @if (count($productDetail->getVariants()) > 0)
                            <variants-component data="{{$productDetail->getVariants()}}"></variants-component>
                        @endif
                        <div class="flex flex-row mt-4 space-x-2">
                            <button
                                @click="showModal({{$productDetail}}, {{$productDetail->category}})"
                                class="inline-block w-full md:w-1/2 justify-center items-center px-8 py-2 text-lg font-bold {{$productDetail->getButtonColor()}} text-white  hover:no-underline transition duration-500 ease-in-out rounded-full"
                            >
                                <span class="uppercase text-lg">COTIZA</span> 
                            </button>
                            {{-- @include('partials.button', ['type' => 1, 'title' => 'agregar al cotizador', 'class' => 'w-full bg-primary rounded-full']) --}}
                        </div>
                    </div>
                </div>
                <div class="border w-full p-8 md:p-16">
                    @include('partials.collapsible', [$specs,])
                </div>
                <div class="w-full md:px-16 mt-10">
                    <h3 class="text-4xl text-gray-100 uppercase xs:text-center md:text-left" >
                        productos relacionados
                    </h3>
                    @include('partials.relatedProducts', [$relatedProducts, 'title' => false,])
                </div>
            </div>
        </div>
    </section>
    <div class="hidden" id="allModals">
        @include('partials.modalform', compact('form'))
    </div>
    {{-- @dd("") --}}
@endsection
