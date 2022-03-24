@extends('layouts.website', [$clasifications, $brands])

@section('content')
    <section class="relative bg-white xs:pt-16 pb-20 xs:px-8 md:pt-32">
        <div class="relative max-w-7xl mx-auto">
            @include('landing.partials.title')
            @include('landing.partials.description')


            <div class=" max-w-lg mx-auto flex flex-col md:flex-row justify-between items-center fadeIn md:space-x-5">
                @if($landingPage->has_form)
                    @include('landing.partials.form_contact')
                @endif
            </div>

        </div>
    </section>
@endsection
