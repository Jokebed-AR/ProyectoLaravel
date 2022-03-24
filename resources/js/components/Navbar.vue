<template>
  <div class>
    <header class="bg-white md:hidden">
      <!-- Mobile Menu -->
      <div
        v-show="!isOpen"
        class="bg-secondary-100 w-full h-6 z-50 flex flex-row items-center justify-end transition duration-300 ease-in-out"
        id="navbarHelperXs"
      >
        <div class="w-auto flex flex-row items-center justify-center space-x-5">
          <a
            href="tel:33-47-70-05-05"
            data-action="CALL"
            target="_blank"
            rel="noreferrer"
            onclick="phone(1)"
            aria-label="Phone Button"
          >
            <div class="flex flex-row justify-center items-center px-4">
              <svg
                class="flex-shrink-0 text-transparent"
                fill="#fff"
                height="1.25rem"
                width="1.25rem"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                />
              </svg>
              <span class="ml-3 text-white">
                <dl>
                  <dt class="sr-only">Telefono</dt>
                  <dd>
                    <p class="text-white">GDL 33 47 70 05 05</p>
                  </dd>
                </dl>
              </span>
            </div>
          </a>
        </div>
      </div>
      <section>
        <div
          v-show="!isOpen"
          id="navbarXs"
          class="bg-white w-screen fixed z-10 flex items-center justify-between px-6 py-3 md:p-0 shadow-xl"
        >
          <div class="flex justify-center items-center">
            <a href="/">
              <img
                class="h-8 w-32 transition duration-300 ease-in-out"
                height="2"
                width="130"
                src="/img/tecnotanques/logo-resize.png"
                loading="lazy"
                alt="Pro | Proyectos"
              />
            </a>
          </div>
          <div>
            <button
              @click="isOpen = !isOpen"
              class="float-right text-black"
              aria-label="Hamburguer Menu Button"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
              >
                <path
                  class="heroicon-ui"
                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                />
              </svg>
            </button>
          </div>
        </div>
        <div
          v-show="isOpen"
          class="fixed bg-white z-20 w-screen flex justify-between px-6 py-3 md:p-0"
        >
          <div class="flex justify-center items-center"></div>
          <div>
            <button @click="isOpen = !isOpen" class="float-right">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 22 22"
                width="30"
                height="30"
              >
                <path
                  xmlns="http://www.w3.org/2000/svg"
                  class="heroicon-ui"
                  d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"
                  style="&#10;    fill: #FF7006;&#10;"
                />
              </svg>
            </button>
          </div>
        </div>
      </section>
    </header>

    <!-- Navbar For mobile -->
    <transition
      name="animate"
      enter-active-class="animated fadeInDown"
      leave-active-class="animated fadeOutUp"
    >
      <nav
        v-if="isOpen"
        class="bg-white h-screen fixed md:block w-screen z-10 mt-8 flex flex-col overflow-y-auto"
      >
        <div>
          <div class="pr-10 pl-12 pt-2 pb-4 md:flex md:p-0">
            <div v-for="(link, index) in mainMenu" :key="index">
              <a
                @click="navigate(link)"
                class="hover:no-underline block text-black font-semibold hover:bg-gray-500 rounded md:mt-0 md:ml-2 py-3 uppercase"
              >
                <span class="align-middle f-m tracking-widest">{{
                  link.title
                }}</span>
              </a>
              <transition
                enter-active-class="fadeIn animation-fastest"
                leave-active-class="fadeOut animation-fastest"
              >
                <div class="pl-4" v-show="link.title === 'Productos' && active">
                  <div
                    v-for="({ id, name }, index) in clasifications"
                    :key="index"
                  >
                    <a
                      :href="`/productos/${name}`"
                      :class="`hover:no-underline f-m tracking-widest block ${index % 2 == 0 ? 'text-primary' : 'text-secondary-100'} font-semibold hover:bg-gray-500 rounded sm:mt-0 sm:ml-2 py-3 uppercase`"
                    >
                      {{ name }}
                    </a>
                      <div
                        class="pl-4"
                        v-show="link.title === 'Productos' && active"
                      >
                        <div
                          v-for="({ url, name, classification_id },
                          index2) in categories"
                          v-if="classification_id === id"
                          :key="index2"
                        >
                          <a
                            :href="`/productos/${url}/todas-las-subcategorias/todas-las-marcas`"
                            class="hover:no-underline f-m tracking-widest block text-gray-100 font-semibold hover:bg-gray-500 rounded sm:mt-0 sm:ml-2 py-3 uppercase"
                          >
                            {{ name }}
                          </a>
                        </div>
                      </div>
                  </div>
                </div>
              </transition>
              <transition
                enter-active-class="fadeIn animation-fastest"
                leave-active-class="fadeOut animation-fastest"
              >
                <div
                  class="pl-4"
                  v-show="link.title === 'Marcas' && activeBrands"
                >
                  <div
                    v-for="({ id, name, url }, index) in brands"
                    :key="index"
                  >
                    <a
                      :href="`/productos/todas-las-categorias/todas-las-subcategorias/${url}`"
                      class="hover:no-underline f-m tracking-widest block text-gray-100 font-semibold hover:bg-gray-500 rounded sm:mt-0 sm:ml-2 py-3 uppercase"
                    >
                      {{ name }}
                    </a>
                  </div>
                </div>
              </transition>
            </div>
          </div>
        </div>
        <div class="border-t border-gray-100 mx-16"></div>
        <div class="pr-10 pl-12 pt-2 pb-4 md:flex md:p-0">
          <a href="mailto:info@dinamcicaensoluciones.com" aria-label="Email Button">
          <!-- <a href="mailto:info@proproyectos.com.mx" aria-label="Email Button"> -->
            <div class="flex flex-row my-8">
              <svg
                class="flex-shrink-0 h-6 w-6 text-transparent"
                viewBox="0 0 512 512"
                style="enable-background: new 0 0 512 512"
                fill="#969191"
                stroke="currentColor"
                xml:space="preserve"
              >
                <g>
                  <g>
                    <polygon points="43.52,76.8 256,225.28 468.48,76.8   " />
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="M268.8,276.48c-7.68,5.12-20.48,5.12-28.16,0L0,107.52V409.6c0,12.8,12.8,25.6,25.6,25.6h460.8    c12.8,0,25.6-12.8,25.6-25.6V107.52L268.8,276.48z"
                    />
                  </g>
                </g>
              </svg>
              <span class="ml-3 text-gray-700 f-m">
                <dd>
                  <p class="text-gray-700 f-m uppercase">
                    INFO@PROPROYECTOS.COM.MX
                  </p>
                </dd>
              </span>
            </div>
          </a>
          <a
            href="tel:33-47-70-05-05"
            data-action="CALL"
            target="_blank"
            rel="noreferrer"
            onclick="phone(1)"
            aria-label="Phone Button"
          >
            <div class="flex flex-row my-8">
              <svg
                class="flex-shrink-0 h-6 w-6 text-transparent"
                fill="#969191"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                />
              </svg>
              <span class="ml-3 text-gray-700 f-m">
                <dd>
                  <p class="text-gray-700 f-m">GDL 33 1706 3046</p>
                </dd>
              </span>
            </div>
          </a>
          <a
            href="tel:55-47-47-70-71"
            data-action="CALL"
            target="_blank"
            rel="noreferrer"
            onclick="phone(1)"
            aria-label="Phone Button"
          >
            <div class="flex flex-row my-8">
              <svg
                class="flex-shrink-0 h-6 w-6 text-transparent"
                fill="#969191"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                />
              </svg>
              <span class="ml-3 text-gray-700 f-m">
                <dd>
                  <p class="text-gray-700 f-m">CDMX 55 4747 7071</p>
                </dd>
              </span>
            </div>
          </a>
          <div class="flex justify-center items-center">
            <a
              href="https://www.facebook.com/TanquesTinacosyCisternas"
              target="_blank"
              class="text-secondary-100 hover:text-secondary-100"
            >
              <span class="sr-only">Facebook</span>
              <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 22 22">
                <path
                  fill-rule="evenodd"
                  d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                  clip-rule="evenodd"
                />
              </svg>
            </a>
            <a
              href="https://www.youtube.com/channel/UCZsjReLuEVueve__GD6I8Yw/featured"
              target="_blank"
              class="ml-6 text-secondary-100 hover:text-secondary-100"
            >
              <span class="sr-only">Youtube</span>
              <svg
                fill="currentColor"
                viewBox="-21 -117 682.66672 682"
                width="34"
                height="34"
                style="margin-top: 3px"
              >
                <path
                  d="m626.8125 64.035156c-7.375-27.417968-28.992188-49.03125-56.40625-56.414062-50.082031-13.703125-250.414062-13.703125-250.414062-13.703125s-200.324219 0-250.40625 13.183593c-26.886719 7.375-49.03125 29.519532-56.40625 56.933594-13.179688 50.078125-13.179688 153.933594-13.179688 153.933594s0 104.378906 13.179688 153.933594c7.382812 27.414062 28.992187 49.027344 56.410156 56.410156 50.605468 13.707031 250.410156 13.707031 250.410156 13.707031s200.324219 0 250.40625-13.183593c27.417969-7.378907 49.03125-28.992188 56.414062-56.40625 13.175782-50.082032 13.175782-153.933594 13.175782-153.933594s.527344-104.382813-13.183594-154.460938zm-370.601562 249.878906v-191.890624l166.585937 95.945312zm0 0"
                />
              </svg>
              <!-- <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 22 22">
                <path
                  fill-rule="evenodd"
                  d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                  clip-rule="evenodd"
                />
              </svg> -->
            </a>
            <a
              href="https://twitter.com/ProProyectos"
              target="_blank"
              class="ml-6 text-secondary-100 hover:text-secondary-100"
            >
              <span class="sr-only">Twitter</span>
              <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 22 22">
                <path
                  d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                />
              </svg>
            </a>
            <a
              href="https://www.linkedin.com/company/15077283/admin/"
              target="_blank"
              class="ml-6 text-secondary-100 hover:text-secondary-100"
            >
              <span class="sr-only">Linkedin</span>
              <svg
                viewBox="0 0 382 382"
                style="enable-background: new 0 0 382 382"
                fill="currentColor"
                class="h-8 w-8"
              >
                <path
                  d="M347.445,0H34.555C15.471,0,0,15.471,0,34.555v312.889C0,366.529,15.471,382,34.555,382h312.889  C366.529,382,382,366.529,382,347.444V34.555C382,15.471,366.529,0,347.445,0z M118.207,329.844c0,5.554-4.502,10.056-10.056,10.056  H65.345c-5.554,0-10.056-4.502-10.056-10.056V150.403c0-5.554,4.502-10.056,10.056-10.056h42.806  c5.554,0,10.056,4.502,10.056,10.056V329.844z M86.748,123.432c-22.459,0-40.666-18.207-40.666-40.666S64.289,42.1,86.748,42.1  s40.666,18.207,40.666,40.666S109.208,123.432,86.748,123.432z M341.91,330.654c0,5.106-4.14,9.246-9.246,9.246H286.73  c-5.106,0-9.246-4.14-9.246-9.246v-84.168c0-12.556,3.683-55.021-32.813-55.021c-28.309,0-34.051,29.066-35.204,42.11v97.079  c0,5.106-4.139,9.246-9.246,9.246h-44.426c-5.106,0-9.246-4.14-9.246-9.246V149.593c0-5.106,4.14-9.246,9.246-9.246h44.426  c5.106,0,9.246,4.14,9.246,9.246v15.655c10.497-15.753,26.097-27.912,59.312-27.912c73.552,0,73.131,68.716,73.131,106.472  L341.91,330.654L341.91,330.654z"
                />
              </svg>
              <!-- <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 33 33">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M30.667,14.939c0,8.25-6.74,14.938-15.056,14.938c-2.639,0-5.118-0.675-7.276-1.857L0,30.667l2.717-8.017   c-1.37-2.25-2.159-4.892-2.159-7.712C0.559,6.688,7.297,0,15.613,0C23.928,0.002,30.667,6.689,30.667,14.939z M15.61,2.382   c-6.979,0-12.656,5.634-12.656,12.56c0,2.748,0.896,5.292,2.411,7.362l-1.58,4.663l4.862-1.545c2,1.312,4.393,2.076,6.963,2.076   c6.979,0,12.658-5.633,12.658-12.559C28.27,8.016,22.59,2.382,15.61,2.382z M23.214,18.38c-0.094-0.151-0.34-0.243-0.708-0.427   c-0.367-0.184-2.184-1.069-2.521-1.189c-0.34-0.123-0.586-0.185-0.832,0.182c-0.243,0.367-0.951,1.191-1.168,1.437   c-0.215,0.245-0.43,0.276-0.799,0.095c-0.369-0.186-1.559-0.57-2.969-1.817c-1.097-0.972-1.838-2.169-2.052-2.536   c-0.217-0.366-0.022-0.564,0.161-0.746c0.165-0.165,0.369-0.428,0.554-0.643c0.185-0.213,0.246-0.364,0.369-0.609   c0.121-0.245,0.06-0.458-0.031-0.643c-0.092-0.184-0.829-1.984-1.138-2.717c-0.307-0.732-0.614-0.611-0.83-0.611   c-0.215,0-0.461-0.03-0.707-0.03S9.897,8.215,9.56,8.582s-1.291,1.252-1.291,3.054c0,1.804,1.321,3.543,1.506,3.787   c0.186,0.243,2.554,4.062,6.305,5.528c3.753,1.465,3.753,0.976,4.429,0.914c0.678-0.062,2.184-0.885,2.49-1.739   C23.307,19.268,23.307,18.533,23.214,18.38z"
                />
              </svg> -->
            </a>
          </div>
          <div class="flex flex-row justify-center my-6">
            <a href="/">
              <img
                class="h-12"
                src="/img/tecnotanques/logo.png"
                loading="lazy"
                alt="Pro | Proyectos"
              />
            </a>
          </div>
          <div class="flex flex-row justify-center my-8">
            <a href="/documentos-legales/politicas-privacidad">
              <span class="text-gray-100 text-center tracking-widest f-m"
                >Aviso de Privacidad</span
              >
            </a>
          </div>
        </div>
      </nav>
    </transition>

    <!-- Navbar For desktop -->
    <div
      class="bg-secondary-100 w-full h-8 hidden z-50 md:flex flex-row items-center justify-end transition duration-300 ease-in-out"
      id="navbarHelper"
    >
      <div class="w-auto flex flex-row items-center justify-center space-x-5">
        <a
          href="tel:55-47-47-70-71"
          data-action="CALL"
          target="_blank"
          rel="noreferrer"
          onclick="phone(1)"
          aria-label="Phone Button"
        >
          <div class="flex flex-row justify-center items-center">
            <svg
              class="flex-shrink-0 text-transparent"
              fill="#fff"
              height="1.25rem"
              width="1.25rem"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
              />
            </svg>
            <span class="ml-3 text-white">
              <dl>
                <dt class="sr-only">Telefono</dt>
                <dd>
                  <p class="text-white">CDMX 55 47 47 70 71</p>
                </dd>
              </dl>
            </span>
          </div>
        </a>
        <a
          href="tel:33-47-70-05-05"
          data-action="CALL"
          target="_blank"
          rel="noreferrer"
          onclick="phone(1)"
          aria-label="Phone Button"
        >
          <div class="flex flex-row justify-center items-center px-4">
            <svg
              class="flex-shrink-0 text-transparent"
              fill="#fff"
              height="1.25rem"
              width="1.25rem"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
              />
            </svg>
            <span class="ml-3 text-white">
              <dl>
                <dt class="sr-only">Telefono</dt>
                <dd>
                  <p class="text-white">GDL 33 47 70 05 05</p>
                </dd>
              </dl>
            </span>
          </div>
        </a>
      </div>
    </div>
    <nav
      class="hidden z-40 w-full md:flex flex-row items-center justify-between bg-transparent p-6 fixed transition duration-300 ease-in-out"
      id="navbarMd"
    >
      <div class="flex items-center flex-shrink-0 mr-6">
        <a
          href="/"
          class="transition duration-500 ease-in-out hover:no-underline"
        >
          <img
            id="logo"
            class="w-auto md:h-10 md:pl-8 lg:h-full lg:pl-12 transition duration-300 ease-in-out"
            src="/img/tecnotanques/logo-blanco.png"
            loading="lazy"
            alt="Pro | Proyectos"
            height="72px"
            width="290px"
          />
        </a>
      </div>
      <div class="w-auto flex flex-row items-center justify-center space-x-5">
        <div class="text-sm flex flex-row space-x-10">
          <div v-for="(link, index) in mainMenu" :key="index">
            <a
              v-show="
                link.title !== 'Contacto' &&
                link.title !== 'Home' &&
                link.title !== 'Productos' &&
                link.title !== 'Marcas' &&
                link.title !== 'Blog'
              "
              :href="link.uri"
              class="buttonAnimation hover:no-underline inline-block text-lg font-bold text-whiteSmoke-100 hover:pt-3 hover:text-secondary-100 hover:border-b-4 border-secondary-100 transition duration-500 ease-in-out uppercase"
              :class="
                currentPath === link.uri
                  ? 'text-primary border-b-2 border-secondary-100'
                  : ''
              "
              >{{ link.title }}</a
            >
            <a
              v-show="link.title === 'Blog'"
              :href="link.uri"
              target="_blank"
              aria-label="Blog button"
              rel="noopener noreferrer"
              class="buttonAnimation hover:no-underline inline-block text-lg font-bold text-whiteSmoke-100 hover:pt-3 hover:text-secondary-100 hover:border-b-4 border-secondary-100 transition duration-500 ease-in-out uppercase"
              :class="
                currentPath === link.uri
                  ? 'text-primary border-b-2 border-secondary-100'
                  : ''
              "
              >{{ link.title }}</a
            >

            <li
              v-show="link.title === 'Productos'"
              class="nav-dropdown relative inline cursor-pointer uppercase buttonAnimation hover:no-underline text-lg font-bold text-whiteSmoke-100 hover:pt-3 hover:text-secondary-100 hover:border-b-4 border-secondary-100 transition duration-500 ease-in-out"
              :class="
                currentPath === link.uri
                  ? 'text-primary border-b-2 border-secondary-100'
                  : ''
              "
            >
              <a :href="link.uri">{{ link.title }}</a>
              <div
                class="nav-dropdown-menu absolute top-1 hidden w-32 h-auto transition duration-100 ease-in-out"
              >
                <ul
                  class="border-t-4 border-secondary-100 w-full py-2 pl-2 flex flex-col justify-center items-start bg-white shadow space-y-2"
                >
                  <li
                    v-for="({ id, name }, index) in clasifications"
                    class="nav-dropdown-item w-full"
                    :key="index"
                  >
                    <a
                      :href="`/productos/${name}`"
                      class="hover:no-underline font-bold text-base text-black hover:text-secondary-100 cursor-pointer transition duration-500 ease-in-out uppercase"
                    >
                      {{ name }}
                    </a>
                    <div
                      class="nav-dropdown-item-menu absolute hidden w-40 h-auto transition duration-100 ease-in-out"
                    >
                      <ul
                        class="border-t-4 border-secondary-100 w-full py-2 pl-2 flex flex-col justify-center items-start bg-white shadow space-y-2"
                      >
                        <li
                          v-for="({ url, name, classification_id },
                          index) in categories"
                          class="nav-dropdown-item"
                          v-if="classification_id === id"
                          :key="index"
                        >
                          <a
                            :href="`/productos/${url}/todas-las-subcategorias/todas-las-marcas`"
                            class="hover:no-underline font-bold text-base text-black hover:text-secondary-100 cursor-pointer transition duration-500 ease-in-out uppercase"
                          >
                            {{ name }}
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
            <li
              v-show="link.title === 'Marcas'"
              class="nav-dropdown relative inline cursor-pointer uppercase buttonAnimation hover:no-underline text-lg font-bold text-whiteSmoke-100 hover:pt-3 hover:text-secondary-100 hover:border-b-4 border-secondary-100 transition duration-500 ease-in-out"
              :class="
                currentPath === link.uri
                  ? 'text-primary border-b-2 border-secondary-100'
                  : ''
              "
            >
              <a :href="link.uri">{{ link.title }}</a>
              <div
                class="nav-dropdown-menu absolute top-1 hidden w-32 h-auto transition duration-100 ease-in-out"
              >
                <ul
                  class="border-t-4 border-secondary-100 w-full py-2 pl-2 flex flex-col justify-center items-start bg-white shadow space-y-2"
                >
                  <li v-for="({ id, name, url }, index) in brands" :key="index">
                    <a
                      :href="`/productos/todas-las-categorias/todas-las-subcategorias/${url}`"
                      class="hover:no-underline font-bold text-base text-black hover:text-secondary-100 cursor-pointer transition duration-500 ease-in-out uppercase"
                    >
                      {{ name }}
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </div>
          <a
            @click="showModalSearch()"
            class="buttonAnimation hover:no-underline inline-block text-lg font-bold text-whiteSmoke-100 hover:pt-3 hover:text-secondary-100 transition duration-500 ease-in-out uppercase"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              width="24"
              height="24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </a>
        </div>
        <div>
          <a
            href="/contacto"
            id="buttonNav5"
            class="buttonAnimation inline-block px-6 py-2 border rounded-full text-lg font-bold text-whiteSmoke-100 border-white hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-500 ease-in-out"
            >CONTÁCTANOS</a
          >
        </div>
      </div>
    </nav>

    <Modal :modalSearch="modalSearch" :showModalSearch="showModalSearch" />
  </div>
</template>
<script>
import { mixins } from "../utils";
import Modal from "./Modal";
export default {
  components: { Modal },
  props: {
    hideMenu: {
      type: Boolean,
      default: false,
    },
    clasifications: {},
    categories: {},
    brands: {},
  },
  data: () => ({
    isOpen: false,
    active: false,
    activeBrands: false,
    mainMenu: [
      {
        title: "Home",
        id: "Home",
        uri: "/",
      },
      {
        title: "Nosotros",
        id: "Nosotros",
        uri: "/nosotros",
      },
      {
        title: "Productos",
        id: "Productos",
        uri:
          "/productos/todas-las-categorias/todas-las-subcategorias/todas-las-marcas",
      },
      {
        title: "Marcas",
        id: "Marcas",
        uri:
          "/productos/todas-las-categorias/todas-las-subcategorias/todas-las-marcas",
      },
      {
        title: "Blog",
        id: "Blog",
        uri: "https://blog.proproyectos.com/",
      },
      {
        title: "Contacto",
        id: "Contacto",
        uri: "/contacto",
        class: "md:hidden",
      },
    ],
    currentPath: "",
    isLoading: false,
    modalSearch: false,
  }),
  mounted() {
    // console.log(this.categories);
    this.currentPath = window.location.pathname;
    this.currentPath = this.currentPath.split("/");
    this.currentPath = "/" + this.currentPath[1];
  },
  methods: {
    goToSection(section) {
      if (this.hideMenu) {
        window.location.href = section;
        return;
      }
      this.isOpen = false;
      const options = {
        offset: -60,
      };
    },
    navigate(link) {
      if (link.title === "Productos") {
        this.active = !this.active;
      } else if (link.title === "Marcas") {
        this.activeBrands = !this.activeBrands;
      } else {
        window.location.href = link.uri;
      }
    },
    showModalSearch() {
      this.modalSearch = !this.modalSearch;
    },
  },
};
</script>
