@if (isset($breadcrumbs))
<section class="relative bg-transparent {{isset($style) ? 'pt-4' : 'pt-16'}} {{isset($style) ? '' : 'md:pt-32'}} pb-4 px-4">
    <div class="relative">
        <div class="flex">
            <p class="text-lg">
            |
                <a href="/"> 
                    <span class="hover:text-secondary-100 transition duration-500 ease-in-out">Inicio</span>
                </a>          
                @foreach ($breadcrumbs as $breadcrumb)    
                    <a href="{{$breadcrumb['url']}}">
                        <span> > </span>
                        <span class="{{isset($breadcrumb['selected']) ? 'text-secondary-100 hover:text-primary transition duration-500 ease-in-out' : 'hover:text-secondary-100 transition duration-500 ease-in-out'}}">{{$breadcrumb['title']}}</span>
                    </a>
                @endforeach
            </p>
        </div>
    </div>
</section>
@endif