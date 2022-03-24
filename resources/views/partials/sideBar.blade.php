
@if ($type === 'left')
    <div class="hidden lg:flex w-full flex-row px-16 py-8 space-x-8">
        <div class="section flex flex-row justify-between items-center space-x-4 w-1/5">
            <h4 class="text-2xl text-left">Subcategoria</h4>

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
        <div class="section flex flex-row justify-between items-center space-x-4 w-1/5">
            <h4 class="text-2xl text-left">Marca</h4>

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
        <div class="flex flex-row items-center justify-start">
            <h4 class="text-xl font-thin f-m">Ordenar por:</h4>
            <label for="order" class="sr-only">Order</label>
            <select class="custom-select w-64 ml-8 p-2 rounded-md border border-gray-700" id="order" name="order" @change="onChangeOrder()" v-model="order">
                <option value="">Todos</option>
                <option value="ASC">Nombre (ascendente)</option>
                <option value="DESC">Nombre (descendente)</option>
            </select>
        </div>
    </div>
    <div class="hidden lg:flex w-full justify-start px-16 space-x-8">
        <transition name="animate" enter-active-class="animated fadeIn animation-fastest" leave-active-class="hidden" >
            <div v-if="isOpenSub" class="content flex flex-col py-3 w-1/5">
                <h4 class="text-xl text-left">Subcategoria</h4>
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
        <div v-if="!isOpenSub" class="content flex flex-col w-1/5"></div>
        <transition name="animate" enter-active-class="animated fadeIn animation-fastest" leave-active-class="hidden" >
            <div v-if="isOpenMar" class="content flex flex-col py-3 w-1/5">
                <h4 class="text-xl text-left">Marca</h4>
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
    </div>
    <div class="flex lg:hidden w-full md:w-1/4 flex-col py-8 px-8">
        <div class="section flex flex-row justify-between items-center">
            <h4 class="text-2xl text-left">Subcategoria</h4>

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
            <h4 class="text-2xl text-left">Marca</h4>

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
    </div>
@elseif ($type === 'top')
    <div class="pt-16 md:pt-32">
        <div class="flex-1 flex flex-row justify-center items-center px-6 py-6 bg-secondary-900 owl-carousel owl-carousel-nav owl-theme">
            @foreach ($types as $type)
                @php
                    if(Request::is('productos/'.'construccion'.'*')) {
                        $clasification = 'construccion';
                        $hasClasification = true;
                    } else if (Request::is('productos/'.'hidraulico'.'*')) {
                        $clasification = 'hidraulico';
                        $hasClasification = true;
                    } else {
                        $hasClasification = false;
                    }
                @endphp
                {{-- @dd($hasClasification) --}}
                @if ($hasClasification)
                    <div class="text-center py-2 md:py-0 cursor-pointer {{ Request::is('productos/'.$clasification.'/'.$type->url.'*') ? 'border-2 border-white' : null }}">
                        <a
                        href="{{Request::is('productos/'.$clasification.'/'.$type->url.'*') ? '/productos/'.$clasification.'/'.'todas-las-categorias/todas-las-subcategorias/todas-las-marcas': getFilterUri($filters, 'category', $type->url)}} "

                        class="hover:no-underline cursor-pointer">
                            <h2 class="text-2xl leading-tight tracking-normal font-bold text-white uppercase px-6 py-2 cursor-pointer">
                                {{$type->name}}
                            </h2>
                        </a>
                    </div>
                @else
                    <div class="text-center py-2 md:py-0 cursor-pointer {{ Request::is('productos/'.$type->url.'*') ? 'border-2 border-white' : null }}">
                        <a
                        href="{{Request::is('productos/'.$type->url.'*') ? '/productos/todas-las-categorias/todas-las-subcategorias/todas-las-marcas': '/productos/'. $type->url.'/todas-las-subcategorias/todas-las-marcas'}} "

                        class="hover:no-underline cursor-pointer">
                            <h2 class="text-2xl leading-tight tracking-normal font-bold text-white uppercase px-6 py-2 cursor-pointer">
                                {{$type->name}}
                            </h2>
                        </a>
                    </div>
                @endif

            @endforeach
        </div>
    </div>
@endif
