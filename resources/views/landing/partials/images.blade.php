<div class="flex-1">
    @if($landingPage->image_1 != null)
        <img src="{{$landingPage->image_1}}" alt="{{$landingPage->seo_name}} imagen 1">
    @endif
        @if($landingPage->image_2 != null)
            <img src="{{$landingPage->image_2}}" alt="{{$landingPage->seo_name}} imagen 2">
        @endif
</div>