<?php $videos = $contentPage->video_urls; ?>
<?php ($videos != null) ? $videos = array_merge($videos, \App\Helpers\LaravelMedia::getVideos($contentPage, 'videos'))  : \App\Helpers\LaravelMedia::getVideos($contentPage, 'videos') ?>
@if($videos != null)
    @if(count($videos) > 0)
        <div class="w-full fadeIn p-8">
            <div class="mb-4 px-4">
                @if($contentPage->video_title != null && $contentPage->video_title != '')
                    <h3 class="text-2xl text-center uppercase font-extrabold">{{$contentPage->video_title}}</h3>
                @else
                    <h3 class="text-2xl text-center uppercase font-extrabold">Videos</h3>
                @endif
            </div>
            <div class="flex flex-col md:flex-row md:flex-wrap fadeIn self-center justify-center">
                @foreach($videos as $video)
                    <div class="hidden lg:flex flex-col w-full lg:w-3/4 space-y-6 mt-8 items-center">
                        <!-- <video width="720" height="405" src="{{$video}}" controls>
                        </video> -->
                        <iframe id="ytplayer" width="720" height="405"
                            src="{{$video}}"
                            frameborder="0"
                            class=""
                            allowfullscreen></iframe>
                    </div>
                    <div class="lg:hidden flex flex-col w-full lg:w-3/4 space-y-6 mt-8 items-center resp-container">
                        <!-- <video width="720" height="405" src="{{$video}}" controls>
                        </video> -->
                        <iframe id="ytplayer"
                            src="{{$video}}"
                            frameborder="0"
                            class=""
                            allowfullscreen></iframe>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif
