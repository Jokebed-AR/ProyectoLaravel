@extends('layouts.website', [$clasifications, $brands])

@section('content')
    <section class="relative bg-white xs:pt-16 pb-20 xs:px-8 md:pt-32">
        <div class="relative max-w-7xl mx-auto">
            @include('landing.partials.title')
            @include('landing.partials.description')


            <div class="mt-12 max-w-lg mx-auto flex flex-col md:flex-row justify-between items-center fadeIn md:space-x-5">
                @include('landing.partials.images')
                @if($landingPage->has_form)
                    @include('landing.partials.form')
                @endif
            </div>

            @include('landing.partials.related_products')

            {{--<div class="text-center bg-primary py-10"><div id="fadeInRight" class="fadeInUp animation-fast"><h2 class="text-3xl md:text-5xl f-m leading-9 tracking-normal font-extrabold text-white sm:leading-10 uppercase">CONOCE NUESTROS PRODUCTOS</h2></div></div>--}}

            @include('landing.partials.videos')


        </div>
    </section>
@endsection
