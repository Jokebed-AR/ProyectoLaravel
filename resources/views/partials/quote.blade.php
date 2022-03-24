@include('partials.banner', [
    'type' => 1,
    'img' => '/img/tecnotanques/banner-separador.jpg', 
    'title' => 'cotiza tu proyecto ya'
])

<section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
    <div class="relative max-w-7xl mx-auto">
        
        
        <div class="mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col justify-center items-center fadeIn md:space-x-5">
            <div class="md:px-64 mb-16">
                <h3 class="text-center text-black font-black  text-3xl md:text-5xl tracking-tight uppercase leading-tight">
                    contáctanos y obtén asesoramiento personalizado.
                </h3>
            </div>
            <a href="/contacto"
                class="bg-secondary-100 inline-block px-16 md:px-32  md:py-3 border rounded-full text-3xl font-bold text-white border-secondary-100 hover:border-transparent hover:no-underline hover:bg-secondary-900 transition duration-500 ease-in-out"
            >
                COTIZA AHORA
            </a>
        </div>
    </div>
</section>