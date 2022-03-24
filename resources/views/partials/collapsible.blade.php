<div class="flex flex-col md:flex-row justify-between">
    <div class="w-full md:w-1/4 flex flex-col justify-center items-center space-y-2">
        @foreach ($specs as $spec)    
            <div @click="activeTab = {{ $loop->index }}" 
                 :class="{ 'bg-secondary-100 text-white cursor-pointer flex flex-row justify-between w-full p-3 hover:bg-secondary-900 hover:text-white transition duration-150 ease-in-out' : activeTab === {{ $loop->index }}, 'bg-gray-900 text-gray-100 cursor-pointer flex flex-row justify-between w-full p-3 hover:bg-secondary-900 hover:text-white transition duration-150 ease-in-out': activeTab !== {{ $loop->index }} }">
                <h2 class="text-xl ">{{$spec['name']}}</h2>

                <button
                    class="focus:outline-none focus:border-transparent focus:shadow-outline-primary flex justify-center items-center content-center text-white transition duration-150 ease-in-out rounded-full text-center"
                >
                    <svg stroke="currentColor" fill="white" width="26px" height="26px" viewBox="0 0 306 306" style=" padding:5px">
                        <g id="chevron-right">
                            <polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153   "/>
                        </g>
                    </svg>
                </button>
            </div>
        @endforeach
    </div>
    <div class="block md:hidden w-full border-b my-4"></div>
    <div class="w-full md:w-3/4 flex">
        @foreach ($specs as $spec)    
            
                <div class="md:px-24 fadeIn" v-show="activeTab === {{ $loop->index }}">
                    {!! $spec['content'] !!}
                </div>
            
        @endforeach
    </div>
</div>