@extends('layouts.website', [$clasifications, $brands])

@section('content')
    <div class="bg-white">
        <div class="container md:px-64 py-32">
            {!! $document->content !!}
        </div>
    </div>
@endsection
