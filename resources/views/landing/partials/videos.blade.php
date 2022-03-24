<div class="mt-12 max-w-lg mx-auto flex flex-col md:flex-row justify-between items-center fadeIn md:space-x-5">
    <div class="flex-1">
        <h2 class="text-3xl  text-secondary-100 tracking-tighter font-bold  leading-snug uppercase pb-3 pt-5">
            {{ $landingPage->videos_title }}
        </h2>
    </div>
</div>



@foreach($videos as $videoArray)
    <div class="mt-12 max-w-lg mx-auto flex flex-col md:flex-row justify-between items-center fadeIn md:space-x-5">
        @foreach($videoArray as $video)
            <div class="flex-1 pt-3">
                <iframe width="300" height="300"
                        src="{{$video}}">
                </iframe>
            </div>
        @endforeach
    </div>
@endforeach