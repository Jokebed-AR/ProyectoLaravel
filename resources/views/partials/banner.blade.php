<div class="text-center {{$type === 2 ? 'py-16' : 'py-32'}} flex flex-col justify-center items-center px-4" 
     style="background: url({{$img === '/img/tecnotanques/NotFound.png' ? '' : $img}}) center center / cover no-repeat; background-color:#00A0DF;">
    <h2
        class="text-4xl md:text-7xl leading-9 tracking-tight md:tracking-tighter font-extrabold text-white leading-snug uppercase mb-6"
    >
        {{$title}}
    </h2>
    @if ($type === 2)
        <a
            href="{{ $url }}"
            rel="noreferrer"
            aria-label="Product list"
            class="flex justify-center items-center px-8 py-1 rounded-full text-lg font-bold text-whiteSmoke-100 hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-500 ease-in-out bg-primary"
        >
            <span class="uppercase text-sm">Ver más</span> 
        </a>
    @endif
</div>
