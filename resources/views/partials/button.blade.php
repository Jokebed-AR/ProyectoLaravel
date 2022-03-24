
@if ($type === 1)
    <button 
        @click="showModal()"
        class="`inline-block flex justify-center items-center px-8 py-1 rounded-full text-lg font-bold text-whiteSmoke-100 hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-500 ease-in-out {{$class}}`"
    >
        <span class="uppercase {{$title === 'COTIZAR' ? 'text-lg' : 'text-sm'}}">{{$title}}</span> 
    </button>
@else    
    <a
        href="#"
        id="buttonNav5"
        style="height: 4rem"
        class="`uppercase flex justify-center items-center text-center px-4 py-4 border font-bold text-whiteSmoke-100 border-gray-100 hover:text-white bg-primary hover:no-underline transition duration-500 ease-in-out {{$class}}`"
    >
        <span class="uppercase {{$title === 'COTIZAR' ? 'text-xl' : ''}}">{{$title}}</span> 
    </a>
@endif