
@include('partials.title', ['type' => 'bg', 'title' => 'CONOCE NUESTROS PRODUCTOS'])
{{-- <section class="relative bg-white pt-8 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
    <div class="relative max-w-7xl mx-auto">

        <div class="mt-2 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row md:flex-wrap justify-center fadeIn">
            @foreach ($products as $product)
                <div class="flex justify-center p-3 md:p-2 w-full md:w-1/2">
                    <span class="text-center text-lg md:text-2xl f-m">
                        {{$product['title']}}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}

<section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
    <div class="relative max-w-7xl mx-auto">
        @include('partials.title', ['type' => 'big', 'title' => '¡TUS ALIADOS EN RECUBRIMIENTOS Y ALMACENAMIENTO HIDRÁULICO!'])

        <div class="mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row justify-center fadeIn md:space-x-5">
            <div class="md:px-32">
                <p class="text-center text-xl md:text-3xl f-m text-gray-100 leading-loose">
                    Somos la mejor opción en productos para tus proyectos de construcción. Obtén el mejor costo -
                    beneficio en productos de las mejores marcas y asesora esesoramiento especializado para hacer de
                    tu proyecto un éxito. Conoce nuestro catálogo y
                    construye con nosotros.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
    <div class="relative max-w-7xl mx-auto">
        @include('partials.title', ['type' => 'border', 'title' => 'productos'])

        <div class="mt-2 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row md:flex-wrap justify-center fadeIn">
                @foreach ($productsImg as $productImg)
                <div class="flex justify-center p-3 md:p-2 w-full md:w-1/2">
                    @include('partials.cards', ['type' => 'button', $productImg])
                </div>
            @endforeach
        </div>
    </div>
</section>