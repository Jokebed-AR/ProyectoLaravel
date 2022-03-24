@extends('layouts.website', [$clasifications, $brands])

@section('content')
    @include('partials.breadcrumbs')
    @include('partials.hero', [
        'type' => 2,
        'img' => '/img/banners/nosotros.jpg',
        'imgMobile' => '/img/tecnotanques/banner-nosotros-mobile-min.jpg',
        'title' => 'Nosotros',
        'note' => 'OBTÉN LA MEJOR CALIDAD EN PRODUCTOS Y ASESORAMIENTO ESPECIALIZADO PARA TUS PROYECTOS.'
    ])

    <section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
        <div class="relative max-w-7xl mx-auto">
            <div class="md:px-24">
                <h1 class="text-center text-3xl md:text-5xl text-black tracking-tighter font-bold leading-snug uppercase">proveedores mayoristas nacionales de materiales y equipo de construcción</h1>
            </div>
            <div class="mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row justify-center fadeIn md:space-x-5">
                <div class="md:px-24">
                    <p class="text-justify text-2xl f-m">
                        Somos proveedores de materiales para la construcción a nivel nacional. Estamos compuestos por un equipo
                        de es-pecialistas con la prioridad de encontrar la mejor opción para tu proyecto. Te ofrecemos el mejor
                        costo - beneficio en productos de construcción y material hidráulico. <br> <br>

                        Conoce la gran variedad de marcas y productos que tenemos para ti. Construye con calidad, construye con
                        expertos.
                    </p>
                </div>
            </div>
            <div class="hidden md:flex mt-12 max-w-lg mx-auto lg:max-w-none flex-col md:flex-row justify-center fadeIn md:space-x-5">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/CLRzTsn8cYI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="flex md:hidden mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row justify-center fadeIn md:space-x-5">
                <iframe width="300" height="300" src="https://www.youtube.com/embed/CLRzTsn8cYI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>
    @include('partials.trademarks', [$brands, 'title' => false,])
    <div class="mt-12 mb-12 max-w-lg mx-auto lg:max-w-none flex flex-col justify-center items-center fadeIn md:space-x-5">
        <p class="text-justify text-2xl f-m">
            Orgulloso patrocinador de 
            <a href="http://alasdeluz.org.mx/" target="_blank" class="text-primary hover:underline text-center">
                ALAS de Luz AC 
            </a>
        </p>
        <a href="http://alasdeluz.org.mx/" target="_blank" class="mt-4">
            <img src="/img/alas.png" alt="alas de luz" class="" >
        </a>
    </div>

@endsection
