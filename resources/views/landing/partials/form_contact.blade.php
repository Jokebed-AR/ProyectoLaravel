@if($errors->has('recaptcha_token'))
    {{$errors->first('recaptcha_token')}}
@endif

<div class="flex-1 pt-1 md:ml-24 md:mr-24  lg:ml-24 lg:mr-24  xl:ml-28 xl:mr-28">
    <h2 class="text-3xl  text-red tracking-tighter font-bold  leading-snug uppercase pb-3">
        {{ $landingPage->form_title }}
    </h2>
    <form action="/contacto" method="POST">
        @csrf
        <input type="hidden" name="recaptcha_token" id="recaptcha_token">
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Nombre Completo
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   id="name" name="name"
                   type="text"
                   required
                   placeholder="Nombre Completo">
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Email
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   id="email" name="email"
                   type="email"
                   required
                   placeholder="Email">
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Producto de interes
            </label>
            {{-- <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="phone" name="phone"
                type="tel"
                placeholder="Producto de interes"> --}}
            <select
                    class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    name="product_id"
                    required
                    id="product_id">
                <option value="">Producto de interes</option>
                @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Telefono
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   id="phone" name="phone"
                   type="tel"
                   required
                   placeholder="Telefono">
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Cantidad
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   id="quantity" name="quantity"
                   type="numeric"

                   placeholder="¿Cuántas piezas?">
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Sustancia a almacenar
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   id="substance_to_store" name="substance_to_store"
                   type="text"
                   required
                   placeholder="Sustancia a almacenar">
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Lugar de envio
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   id="shipping_place" name="shipping_place"
                   type="text"
                   required
                   placeholder="Lugar de envio">
        </div>

        {{--<div class="w-full mb-6 md:mb-0">--}}
        {{--<label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">--}}
        {{--Capacidad--}}
        {{--</label>--}}
        {{--<input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"--}}
        {{--id="capacity" name="capacity"--}}
        {{--type="text"--}}
        {{--required--}}
        {{--placeholder="Capacidad">--}}
        {{--</div>--}}

        {{-- <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Empresa
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="company" name="company"
                type="text"
                placeholder="Empresa">
        </div>
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Cargo
            </label>
            <input class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="position" name="position"
                type="text"
                placeholder="Cargo">
        </div> --}}
        <div class="w-full mb-6 md:mb-0">
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
        <div class="w-full mb-6 md:mb-0">
            <label class="sr-only block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                Mensaje
            </label>
            <textarea class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                      type="text"
                      name="message"
                      placeholder="Mensaje"></textarea>
        </div>

        <div class="flex justify-end">
            <button
                    class="flex justify-center items-center px-8 py-1 rounded-full text-lg font-bold text-whiteSmoke-100 hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-500 ease-in-out w-1/3 bg-secondary-100"
            >
                <span class="uppercase text-sm">Enviar</span> 
            </button>
        </div>
        <br>
        {{--Este sitio está protegido por ReCaptcha y Google--}}
        {{--<a href="https://policies.google.com/privacy" target="_blank" rel="noreferrer" aria-label="link privacy policies google" class="text-secondary-100">Aviso de privacidad</a> y--}}
        {{--<a href="https://policies.google.com/terms" target="_blank" rel="noreferrer" aria-label="link terms google" class="text-secondary-100">Términos y condiciones</a>.--}}
        {{--<p class="mt-4" >Al hacer click en <strong>SIGUIENTE</strong> estás aceptando nuestro <a href="/documentos-legales/politicas-privacidad" class="text-secondary-100">Aviso de privacidad</a></p>--}}
    </form>
</div>