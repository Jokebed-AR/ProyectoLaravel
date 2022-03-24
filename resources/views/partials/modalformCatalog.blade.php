<transition
  enter-active-class="animated fadeIn"
  leave-active-class="animated fadeOut"
>
    <div v-show="modalFormCatalog" id="modalFormCatalog" class="hidden fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
      <div class="flex items-center justify-center pt-4 px-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-black opacity-75"></div>
        </div>
        <transition
          enter-active-class="animated fadeInDown"
          leave-active-class="animated fadeOutUp"
        >
        <div v-show="modalFormCatalog" class="inline-block align-bottom bg-white rounded-lg px-4 py-2 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
          <div class="block absolute top-0 right-0 pt-4 pr-4">
            <button @click="closeCatalog()" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
              <!-- Heroicon name: x -->
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="flex flex-col md:flex-row justify-between items-center px-8 catalog-width">
            <div class="mt-3">
              <img src="/img/catalogo-proproyectos.jpg" style="width: 53rem;" alt="Catalogo proproyectos" loading="lazy" class="" >
            </div>
            <div class="mt-3 text-center md:px-16">
              <h2 class="text-2xl md:text-3xl text-black uppercase mb-3">
                PROVEEDORES MAYORISTAS NACIONALES DE MATERIALES Y EQUIPO DE CONSTRUCCIÓN 
              </h2>
                <p class="mb-3">Conoce la gran variedad de marcas y productos que tenemos para ti. <br> 
                Construye con calidad, construye con expertos.</p>
                @if($errors->has('recaptcha_token'))
                    {{$errors->first('recaptcha_token')}}
                @endif
                <div class="form">
                <form action="/catalogo" method="POST" ref="catalogForm">
                  @csrf
                    <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                    <input type="hidden" name="catalog_id" id="catalog_id" value="{{$catalog->id}}">
                    <input type="hidden" name="catalog_url" id="catalog_url" value="{{$catalog->url}}">
                    <div class="w-full mb-6 md:mb-0">
                          <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                              Nombre
                          </label>
                          <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                  type="text"
                                  name="name"
                                  required
                                  placeholder="Nombre">
                    </div>
                    <div class="w-full mb-6 md:mb-0">
                          <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                              Email
                          </label>
                          <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                  type="email"
                                  name="email"
                                  required
                                  placeholder="Email">
                    </div>
                  <input
                      {{-- type="submit" --}}
                      @click="submitCatalog"
                      value="Descargar Catálogo"
                      aria-label="Button submit catalog"
                      class="flex
                             text-center
                             cursor-pointer 
                             justify-center 
                             items-center 
                             px-8 
                             py-1 
                             rounded-full 
                             text-lg 
                             font-bold 
                             text-whiteSmoke-100 
                             hover:border-transparent 
                             hover:text-white 
                             hover:bg-primary 
                             hover:no-underline 
                             transition 
                             duration-500 
                             ease-in-out 
                             w-full 
                             bg-secondary-100">
                  </input>
                </form>
              </div>
            </div>
          </div>
        </div>
        </transition>
      </div>
    </div>
  </transition>
