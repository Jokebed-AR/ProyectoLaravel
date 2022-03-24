<div>
    @if($type === 'blue')
        <div class="text-center">
            <h2
            class="text-lg md:text-5xl leading-9 tracking-tight font-bold text-secondary-100 sm:leading-10 uppercase"
            >{{$title}}</h2>
        </div>
    @elseif($type === 'border')
        <div class="text-center flex flex-col items-center">
            <div class="border-t-10 border-primary w-1/5 mb-4"></div>
            <h2
            class="text-3xl md:text-5xl leading-9 tracking-wide font-extrabold text-gray-100 sm:leading-10 uppercase"
            >{{$title}}</h2>
        </div>
    @elseif($type === 'borderLeft')
        <h1 class="{{ $class !== '' ? $class : 'text-6xl'}} fadeIn animation-fastest leading-tight tracking-normal font-bold {{$black ? 'text-gray-100' : 'text-white'}} uppercase border-l-10 border-secondary-100 px-6">
            {{$title}}
        </h1>
    @elseif($type === 'bg')
        <div class="text-center bg-primary py-10">
            <div id="fadeInRight" class="" v-waypoint="{ active: true, callback: onWaypoint }">
                <h2
                class="text-3xl md:text-5xl f-m leading-9 tracking-normal font-extrabold text-white sm:leading-10 uppercase"
                >{{$title}}</h2>
            </div>
        </div>
    @elseif($type === 'extrabig')
        <div class="flex justify-center">
            <div class="w-full text-center">
                <h2
                class="text-3xl {{$type === 'extrabig' ? 'md:text-5xl text-black' : 'md:text-7xl text-gray-100'}} tracking-tighter font-bold  leading-snug uppercase"
                >{{$title}}</h2>
            </div>
        </div>
    @else
        <div class="flex justify-center">
            <div class="w-full text-center">
                <h2
                class="text-3xl  text-gray-100 font-bold uppercase {{$type === 'class' ? $class.' ' : 'md:text-7xl leading-snug tracking-tighter'}}"
                >{{$title}}</h2>
                @if ($type === 'class')
                    <h2
                    class="text-3xl  text-secondary-100 tracking-tighter font-bold  leading-snug uppercase"
                    >{{$note}}</h2>
                @endif
            </div>
        </div>
    @endif
</div>