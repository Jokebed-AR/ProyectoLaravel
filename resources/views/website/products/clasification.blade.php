@extends('layouts.website', [$clasifications, $brands])

@section('content')
    {{-- @dd($categoriesOfClasification) --}}
    @include('partials.sideBar', ['type' => 'top', 'types' => $categoriesOfClasification])
    @include('partials.breadcrumbs', ['style' => 2])
    <section class="relative bg-white">
        <div class="relative flex flex-col justify-center items-center md:flex-row md:px-40">
            <div class="w-full flex flex-col justify-start fadeIn md:space-x-5 bg-white p-4 md:p-8">
                @include('partials.title', [
                  'type' => 'class',
                  'class'=> 'text-3xl md:text-6xl py-4',
                  'note' => '',
                  'title' =>  $selectedClassification->name
                ])
                <div class="w-full flex flex-col md:flex-row md:flex-wrap fadeIn">
                    @if (count($categoriesOfClasification) > 0)
                        @foreach ($categoriesOfClasification as $category)
                            <div class="flex justify-center items-center p-3 w-full md:w-1/3">
                                @include('partials.cards', [
                                    'type' => 'clasification',
                                    $category
                                ])
                            </div>
                        @endforeach
                        <div class="flex justify-center w-full my-8">
                            {{ $categoriesOfClasification->links() }}
                        </div>
                    @else
                        <div class="flex items-center justify-center p-2 w-full my-32">
                            <h3 class="text-xl text-center">No hay clasificaciones registradas</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
