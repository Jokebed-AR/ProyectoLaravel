<!-- Original -->
<!-- <div class="hidden md:flex w-full flex-row px-16 pb-8 space-x-8 justify-end">
=======

<div class="hidden md:flex w-full flex-row px-16 pt-8 space-x-8 justify-end">
    <div class="section flex flex-row justify-between items-center space-x-4 w-1/4 lg:w-1/6">
        <h4 class="text-xl xl:text-2xl text-left">Subcategoria</h4>

        <button
                id="isOpenSub"
                aria-label="isOpenSub"
                @click="open('isOpenSub')"
                class="focus:outline-none focus:border-transparent focus:shadow-outline-primary flex justify-center items-center text-black transition duration-150 ease-in-out bg-gray-900 rounded-full text-center"
        >
            <svg stroke="currentColor" fill="black" width="26px" height="26px" viewBox="0 0 306 306" style="transform: rotate(90deg); padding:5px">
                <g id="chevron-right">
                    <polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153   "/>
                </g>
            </svg>
        </button>
    </div>
    <div class="section flex flex-row justify-between items-center space-x-4 w-1/4 lg:w-1/6">
        <h4 class="text-xl xl:text-2xl text-left">Marca</h4>

        <button
                id="isOpenMar"
                aria-label="isOpenMar"
                @click="open('isOpenMar')"
                class="focus:outline-none focus:border-transparent focus:shadow-outline-primary flex justify-center items-center text-black transition duration-150 ease-in-out bg-gray-900 rounded-full text-center"
        >
            <svg stroke="currentColor" fill="black" width="26px" height="26px" viewBox="0 0 306 306" style="transform: rotate(90deg); padding:5px">
                <g id="chevron-right">
                    <polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153   "/>
                </g>
            </svg>
        </button>
    </div>
    <div class="flex flex-row items-center justify-around w-2/4 lg:w-2/6">
        <h4 class="text-lg xl:text-xl font-thin f-m">Ordenar por:</h4>
        <label for="order" class="sr-only">Order</label>
        <select class="custom-select w-48 p-2 rounded-md border border-gray-700" id="order" name="order" @change="onChangeOrder()" v-model="order">
            <option value="">Todos</option>
            <option value="ASC">Nombre (ascendente)</option>
            <option value="DESC">Nombre (descendente)</option>
        </select>
    </div>
</div> -->

<!-- Selects -->
<div class="flex-col md:flex-row flex w-full lg:px-16 pt-8 justify-start md:justify-around lg:justify-end ">
    <div class="flex flex-col lg:flex-row items-start md:items-center pb-3 justify-end lg:mr-3">
        <h4 class="text-lg xl:text-xl font-thin f-m mr-2 mr-2">Subcategoría:</h4>
        <label for="subcategory" class="sr-only">subcategory</label>
        @if (count($subcategories) > 1)
            <select style="200px" class="custom-select w-48 p-2 rounded-md border border-gray-700" id="subcategory" name="subcategory" onchange="location = this.value;">
                <option value="" disabled selected>Todas</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ getFilterUri($filters, 'subcategory', $subcategory->url ) }}">{{$subcategory->name}}</option>
                @endforeach
            </select>
            @else
            <select style="200px" class="custom-select w-48 p-2 rounded-md border border-gray-700" id="subcategory" name="subcategory" onchange="location = this.value;">
                @foreach ($subcategories as $subcategory)
                    <option value="" disabled selected>{{$subcategory->name}}</option>
                    <option value="{{ getFilterUri($filters, 'subcategory', 'todas-las-subcategorias') }}">Todas las subcategorías</option>
                @endforeach
            </select>
        @endif
    </div>
    <div class="flex flex-col lg:flex-row items-start md:items-center pb-3 justify-end lg:mr-3">
        <h4 class="text-lg xl:text-xl font-thin f-m mr-2">Marca:</h4>
        <label for="brand" class="sr-only">brand</label>
            @if (count($brands) > 1)
                <select style="200px" class="custom-select w-48 p-2 rounded-md border border-gray-700" id="brand" name="brand" onchange="location = this.value;">
                <option value="" disabled selected>Todas</option>
                @foreach ($brands as $brand)
                    @if($brand)
                    <option value="{{ getFilterUri($filters, 'brand', $brand->url) }}">{{$brand->name}}</option>
                    @endif
                @endforeach
                </select>
            @else
                <select style="200px" class="custom-select w-48 p-2 rounded-md border border-gray-700" id="brand" name="brand" onchange="location = this.value;">
                    @foreach ($brands as $brand)
                        <option value="" disabled selected>{{$brand->name}}</option>
                        <option value="{{ getFilterUri($filters, 'brand', 'todas-las-marcas') }}">Todas las marcas</option>
                    @endforeach
                </select>
            @endif
    </div>
    {{--<div class="flex flex-col lg:flex-row items-start md:items-center pb-3 justify-end ">--}}
        {{--<h4 class="text-lg xl:text-xl font-thin f-m mr-2">Ordenar por:</h4>--}}
        {{--<label for="order" class="sr-only">Order</label>--}}
        {{--<select style="200px" class="custom-select w-48 p-2 rounded-md border border-gray-700" id="order" name="order" @change="onChangeOrder()" v-model="order">--}}
            {{--<option value="">Todos</option>--}}
            {{--<option value="ASC">Nombre (ascendente)</option>--}}
            {{--<option value="DESC">Nombre (descendente)</option>--}}
        {{--</select>--}}
    {{--</div>--}}
</div>


<!-- <div class="hidden md:flex w-full flex-row px-16 ml-0 space-x-8 justify-end">
    
    <div v-if="!isOpenSub" class="content flex flex-col w-1/4 lg:w-1/6">&nbsp;</div>
    <transition name="animate" enter-active-class="animated fadeIn animation-fastest" leave-active-class="hidden" >
        <div v-if="isOpenSub" class="content flex flex-col py-3 w-1/4 lg:w-1/6">
            @if (count($subcategories) > 1)
                @foreach ($subcategories as $subcategory)
                    <a href="{{ getFilterUri($filters, 'subcategory', $subcategory->url ) }}"   class="hover:no-underline">
                        <span class="text-sm f-m uppercase text-black font-bold flex items-center my-2 hover:text-primary transition duration-150 ease-in-out">
                            {{$subcategory->name}}
                        </span>
                    </a>
                @endforeach
            @else
                @foreach ($subcategories as $subcategory)
                    <a href="{{ getFilterUri($filters, 'subcategory', 'todas-las-subcategorias') }}" class="hover:no-underline px-4 border-2 border-primary flex justify-between text-sm f-m uppercase hover:text-primary">
                        <span class="my-2">
                            {{$subcategory->name}}
                        </span>
                        <span class="my-2">
                            x
                        </span>
                    </a>
                @endforeach
            @endif
        </div>
    </transition>
    <div v-if="!isOpenMar" class="content flex flex-col ml-10 w-1/4 lg:w-1/6"></div>
    <transition name="animate" enter-active-class="animated fadeIn animation-fastest" leave-active-class="hidden" >
        <div v-if="isOpenMar" class="content flex flex-col ml-10 py-3 w-1/4 lg:w-1/6">
            @if (count($brands) > 1)
                @foreach ($brands as $brand)
                    @if($brand)
                        <a href="{{ getFilterUri($filters, 'brand', $brand->url) }}"   class="hover:no-underline">
                            <span class="text-sm f-m uppercase text-black font-bold flex items-center my-2 hover:text-primary transition duration-150 ease-in-out">
                                {{$brand->name}}
                            </span>
                        </a>
                    @endif
                @endforeach
            @else
                @foreach ($brands as $brand)
                    <a href="{{ getFilterUri($filters, 'brand', 'todas-las-marcas') }}" class="hover:no-underline px-4 border-2 border-primary flex justify-between text-sm f-m uppercase hover:text-primary">
                        <span class="my-2">
                            {{$brand->name}}
                        </span>
                        <span class="my-2">
                            x
                        </span>
                    </a>
                @endforeach
            @endif
        </div>
    </transition>
    <div class="content flex flex-col ml-10 w-2/4 lg:w-2/6"></div>
</div> -->
<!-- Movil version -->
<!-- <div class="flex lg:hidden w-full lg:w-1/3 flex-col py-8 px-8">
    <div class="section flex flex-row justify-between items-center">
        <h4 class="text-xl text-left">Subcategoria</h4>

        <button
                id="isOpenSubM"
                aria-label="isOpenSubM"
                @click="open('isOpenSubM')"
                class="focus:outline-none focus:border-transparent focus:shadow-outline-primary flex justify-center items-center content-center text-black transition duration-150 ease-in-out bg-gray-900 rounded-full text-center"
        >
            <svg stroke="currentColor" fill="black" width="26px" height="26px" viewBox="0 0 306 306" style="transform: rotate(270deg); padding:5px">
                <g id="chevron-right">
                    <polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153   "/>
                </g>
            </svg>
        </button>
    </div>

    <transition
            name="animate"
            enter-active-class="animated fadeIn animation-fastest"
            leave-active-class="hidden"
    >
        <div v-if="isOpenSubM" class="content flex flex-col justify-between py-3">
            @if (count($subcategories) > 1)
                @foreach ($subcategories as $subcategory)
                    <a href="{{ getFilterUri($filters, 'subcategory', $subcategory->url ) }}"   class="hover:no-underline">
                        <span class="text-sm f-m uppercase text-black font-bold flex items-center my-2 hover:text-primary transition duration-150 ease-in-out">
                            {{$subcategory->name}}
                        </span>
                    </a>
                @endforeach
            @else
                @foreach ($subcategories as $subcategory)
                    <a href="{{ getFilterUri($filters, 'subcategory', 'todas-las-subcategorias') }}" class="hover:no-underline px-4 border-2 border-primary flex justify-between text-sm f-m uppercase hover:text-primary">
                        <span class="my-2">
                            {{$subcategory->name}}
                        </span>
                        <span class="my-2">
                            x
                        </span>
                    </a>
                @endforeach
            @endif
        </div>
    </transition>
    <hr class="border-t-1 border-black my-4">
    <div class="section flex flex-row justify-between items-center">
        <h4 class="text-xl text-left">Marca</h4>

        <button
                id="isOpenMarM"
                aria-label="isOpenMarM"
                @click="open('isOpenMarM')"
                class="focus:outline-none focus:border-transparent focus:shadow-outline-primary flex justify-center items-center content-center text-black transition duration-150 ease-in-out bg-gray-900 rounded-full text-center"
        >
            <svg stroke="currentColor" fill="black" width="26px" height="26px" viewBox="0 0 306 306" style="transform: rotate(270deg); padding:5px">
                <g id="chevron-right">
                    <polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153   "/>
                </g>
            </svg>
        </button>
    </div>
    <transition
            name="animate"
            enter-active-class="animated fadeIn animation-fastest"
            leave-active-class="hidden"
        >
        <div v-if="isOpenMarM" class="content flex flex-col justify-between py-3">

            @if (count($brands) > 1)
                @foreach ($brands as $brand)
                    @if($brand)
                        <a href="{{ getFilterUri($filters, 'brand', $brand->url) }}"   class="hover:no-underline">
                            <span class="text-sm f-m uppercase text-black font-bold flex items-center my-2 hover:text-primary transition duration-150 ease-in-out">
                                {{$brand->name}}
                            </span>
                        </a>
                    @endif
                @endforeach
            @else
                @foreach ($brands as $brand)
                    <a href="{{ getFilterUri($filters, 'brand', 'todas-las-marcas') }}" class="hover:no-underline px-4 border-2 border-primary flex justify-between text-sm f-m uppercase hover:text-primary">
                        <span class="my-2">
                            {{$brand->name}}
                        </span>
                        <span class="my-2">
                            x
                        </span>
                    </a>
                @endforeach
            @endif
        </div>
    </transition>
    
    <div class="flex flex-row items-center my-5 justify-around w-full">
        <h4 class="text-sm font-thin f-m ">Ordenar por:</h4>
        <label for="order" class="sr-only">Order</label>
        <select class="custom-select w-48 p-2 rounded-md border border-gray-700" id="order" name="order" @change="onChangeOrder()" v-model="order">
            <option value="">Todos</option>
            <option value="ASC">Nombre (ascendente)</option>
            <option value="DESC">Nombre (descendente)</option>
        </select>
    </div>
</div> -->
