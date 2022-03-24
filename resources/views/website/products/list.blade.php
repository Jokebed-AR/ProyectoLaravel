@extends('layouts.website', ['brands' => $brandsNavbar])

@section('content')
    {{-- @include('partials.breadcrumbs') --}}
    @include('partials.sideBar', [
        'type' => 'top',
        'types' => $categories,
        'filters' => $filters
    ])
    <div class="block md:hidden">
        @include('partials.breadcrumbs', ['style' => 2])
    </div>
    <section class="relative bg-white">
        <div class="relative flex flex-col">
            
            <div class="hidden md:block px-4">
                @include('partials.breadcrumbs', ['style' => 2])
            </div>
            @if($contentPage != null)
                @include('website.products.lists.titles')
            @endif
            
            <section class="w-full flex flex-col justify-start fadeIn md:space-x-5 bg-gray-600 p-8 relative">
                    @include('website.products.lists.filters', ['type' => 'left', 'brands' => $brands, 'subcategories' => $subcategories])
                @if($contentPage == null)
                    <div class="mb-4 px-4">
                        <h1 class="text-2xl font-extrabold">{{ $titleWebsite }}</h1>
                    </div>
                @endif
                <div class="flex flex-col md:flex-row md:flex-wrap fadeIn ">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <div class="flex p-4  w-full lg:w-1/3 2xl:w-1/4">
                                @include('partials.cards', ['type' => 'cart', $product, 'button' => 'true'])
                            </div>
                        @endforeach
                        <div class="flex justify-center w-full my-8">
                            {{ $products->appends(['sort_order' => $order, 'search' => $search])->links() }}
                        </div>
                    @else
                        <div class="flex p-2 w-full my-32">
                            <h3 class="text-xl text-center">No hay productos registrados</h3>
                        </div>
                    @endif
                </div>
            </section>
            @if($contentPage != null)
                @include('website.products.lists.gallery')
                @include('website.products.lists.faqs')
                @include('website.products.lists.videos')
                @include('website.products.lists.extras')
            @endif
        </div>
    </section>
    <div class="hidden" id="allModals">
        @include('partials.modalform', compact('form'))
    </div>

@endsection
