@if($contentPage->measures != null && $contentPage->measures != '')
    <div class="w-full flex flex-col justify-start fadeIn bg-gray-600  p-8">
        <div class="mb-4 px-4">
            @if($contentPage->extra_title != null && $contentPage->extra_title != '')
                <h3 class="text-2xl text-center uppercase font-extrabold">{{$contentPage->extra_title}}</h3>
            @else
                <h3 class="text-2xl text-center uppercase font-extrabold">Extras</h3>
            @endif
        </div>
        <div class="flex flex-col w-5/6 md:w-3/4 fadeIn self-center justify-center break-words overflow-auto">
            {!! $contentPage->measures !!}
        </div>
    </div>
@endif
