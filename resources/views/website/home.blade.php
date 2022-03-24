@extends('layouts.website', [$brands])

@section('content')
    <div class="" id="hero" v-waypoint="{ active: true, callback: onWaypoint }">
        @include('partials.hero', [
            'type' => 1,
            'img' => '/img/tecnotanques/banner-solo-small.jpg',
            'imgXs' => '/img/tecnotanques/Home-ProProyectos-Movil.webp',
            'title' => 'tus aliados en recubrimientos y almacenamiento hidráulico',
            'note' => 'OBTÉN LA MEJOR CALIDAD EN PRODUCTOS Y ASESORAMIENTO ESPECIALIZADO PARA TUS PROYECTOS.'
        ])
    </div>
    @if (count($homeProducts) > 0)
        <div id="products" class="block md:hidden">
            @include('partials.sliderProducts', compact('homeProducts'))
        </div>
    @endif
    <div id="services" class="" v-waypoint="{ active: true, callback: onWaypoint }">
        @include('partials.services', $services)
    </div>
    <div id="trademarks" class="" v-waypoint="{ active: true, callback: onWaypoint }">
        @include('partials.trademarks', [$brands, 'title' => true,])
    </div>
    <div id="hero" class="" v-waypoint="{ active: true, callback: onWaypoint }">
        @include('partials.products', $services)
    </div>
    <div id="quote" class="" v-waypoint="{ active: true, callback: onWaypoint }">
        <div class="" v-show="activeQuote">
            @include('partials.quote', $services)
        </div>
    </div>
@endsection
