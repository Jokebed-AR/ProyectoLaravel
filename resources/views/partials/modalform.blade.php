@extends('partials.modal', ['visible' => 'modalForm', 'bgColor' => 'bg-transparent'])
@section('closeSection')
  <div class="block absolute top-0 right-0 pt-4 pr-4">
    <button @click="close()" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
@endsection
@section('contentModal')
    <div class="flex flex-col justify-center items-center h-full" >
        
      <div class="flex flex-col justify-center items-center w-full h-full lg:h-auto py-6">
          <span class="text-xs text-3xl md:text-5xl text-black uppercase mb-3">
            Formulario de cotizacion
          </span>
            @if($errors->has('recaptcha_token'))
              {{$errors->first('recaptcha_token')}}
          @endif
          <div class="form">
            <form action="/contacto" method="POST">
              @csrf
                <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Nombre
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="text"
                              name="name"
                              required
                              placeholder="Nombre">
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Email
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="email"
                              name="email"
                              required
                              placeholder="Email">
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Telefono
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="text"
                              name="phone"
                              required
                              placeholder="Telefono">
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Lugar de envio
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="text"
                              name="shipping_place"
                              required
                              placeholder="Lugar de envio">
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Sustancia a almacenar
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="text"
                              v-if="clasification !== 1"
                              name="substance_to_store"
                              required
                              placeholder="Sustancia a almacenar">
                </div>
                {{-- <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Capacidad
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="text"
                              name="capacity"
                              required
                              placeholder="Capacidad">
                </div> --}}
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Cantidad
                      </label>
                      <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                              type="text"
                              name="quantity"
                              required
                              placeholder="Cantidad">
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Selecciona un sector
                      </label>
                      <select
                          class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                          name="sector"
                          required
                          id="sector">
                          <option value="">Selecciona un sector</option>
                          <option value="Industria Química">Industria Química</option>
                          <option value="Industria Farmacéutica">Industria Farmacéutica</option>
                          <option value="Industria Alimenticia">Industria Alimenticia</option>
                          <option value="Tratamiento">Tratamiento</option>
                          <option value="Sistemas contra incendio">Sistemas contra incendio</option>
                          <option value="Construcción">Construcción</option>
                          <option value="Agro">Agro</option>
                          <option value="Gobierno">Gobierno</option>
                          <option value="Hogar">Hogar</option>
                          <option value="Otros">Otros</option>
                      </select>
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                      <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                          Mensaje
                      </label>
                      <textarea class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                type="text"
                                name="message"
                                placeholder="Mensaje"></textarea>
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                    <input class="appearance-none hidden w-full placeholder-white text-white border-2 border-gray-100 py-3 px-4 mb-3 leading-tight focus:outline-none bg-gray-100"
                                type="text"
                                name="product_id"
                                hidden
                                :value="product.id">
                </div>
                <div class="w-full mb-3 sm:mb-6 md:mb-0">
                    <input class="appearance-none block w-full placeholder-white border-2 border-gray-100 py-3 px-4 mb-3 leading-tight focus:outline-none bg-gray-100"
                                type="text"
                                name="product_name"
                                disabled="true"
                                :placeholder="product.name">
                </div>
                <input
                    type="submit"
                    value="Siguiente"
                    class="flex justify-center items-center px-8 py-1 rounded-full text-lg font-bold text-whiteSmoke-100 hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-500 ease-in-out w-full md:w-1/3 bg-secondary-100">
                  <br>
                  Este sitio está protegido por ReCaptcha y Google
                  <a href="https://policies.google.com/privacy" target="_blank" rel="noreferrer" aria-label="link privacy policies google" class="text-secondary-100">Aviso de privacidad</a> y
                  <a href="https://policies.google.com/terms" target="_blank" rel="noreferrer" aria-label="link terms google" class="text-secondary-100">Términos y condiciones</a>.
                <p class="mt-4" >Al hacer click en <strong>SIGUIENTE</strong> estás aceptando nuestro <a href="/documentos-legales/politicas-privacidad" class="text-secondary-100">Aviso de privacidad</a></p>
            </form>
          </div>
      </div>
        
    </div>
@endsection

