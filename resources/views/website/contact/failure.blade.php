@extends('layouts.website', [$clasifications, $brands])

@section('content')
    <section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
        <div class="relative max-w-7xl mx-auto">
            <div class="md:px-24">
                Cotización
            </div>
            <div class="mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row justify-center fadeIn md:space-x-5">
                <div class="md:px-24 py-16">
                    <p class="text-justify text-2xl f-m py-32">
                        No puedes enviar este formulario tan rapido. Espere 30 minutos por favor.
                    </p>
                    <div class="flex justify-center">
                        
                        <a 
                            href="/productos"
                            class="flex justify-center items-center px-8 py-1 rounded-full text-lg font-bold text-whiteSmoke-100 hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-500 ease-in-out w-full md:w-1/2 bg-primary"
                        >
                            <span class="uppercase text-sm">Regresar</span> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
