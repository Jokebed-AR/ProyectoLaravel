<section class="relative bg-white pt-16 pb-20 px-8 sm:px-8 lg:pt-10 lg:pb-28 lg:px-8">
    <div class="relative max-w-7xl mx-auto">
        @include('partials.title', ['type' => 'blue', 'title' => 'El mejor Costo-Beneficio para tus proyectos de construcción.', 'note' => ''])

        <div class="mt-12 max-w-lg mx-auto lg:max-w-none flex flex-col md:flex-row justify-center fadeIn md:space-x-3">
            @foreach ($services as $service)
                <div class="flex px-0 py-3 md:p-3 w-full md:w-1/3 justify-center">
                    @include('partials.cards', ['type' => 'gif', $service])
                </div>
            @endforeach
        </div>
    </div>
</section>
