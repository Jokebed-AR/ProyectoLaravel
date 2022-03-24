<?php $images = \App\Helpers\LaravelMedia::getImages($contentPage, 'gallery') ?>
@if(count($images) > 0)
    <div class="w-full flex flex-col justify-start fadeIn p-8">
        <div class="mb-4 px-4">
            @if($contentPage->gallery_title != null && $contentPage->gallery_title != '')
                <h3 class="text-2xl text-center uppercase font-extrabold">{{$contentPage->gallery_title}}</h3>
            @else
                <h3 class="text-2xl text-center uppercase font-extrabold">Galería</h3>
            @endif
        </div>
        <div class="flex flex-col md:flex-row md:flex-wrap fadeIn justify-center">
            @foreach($images as $image)
                <div class="flex p-4  w-full lg:w-1/4 2xl:w-1/4 h-64">
                    <img class="rounded-xl shadow-lg object-cover" width="100%" src="{{$image}}" alt="">
                </div>
            @endforeach
        </div>
    </div>
@endif
