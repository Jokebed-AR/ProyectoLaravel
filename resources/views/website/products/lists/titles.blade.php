<div class="w-full flex flex-col justify-center fadeIn pb-8">
    <div class="mb-4 px-4">
        <h1 class="text-2xl text-center uppercase font-extrabold">{{$contentPage->name}}</h1>
    </div>
    <div class="flex flex-col w-5/6 md:w-3/4 fadeIn self-center justify-center">
        <p class="text-lg text-justify md:text-center break-words">
            {!! $contentPage->description !!}
        </p>
    </div>
</div>