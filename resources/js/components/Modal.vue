<template>
  <div class>
    <transition
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
        <div v-show="modalSearch" class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
          <div class="flex items-center justify-center text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
              <div class="absolute inset-0 bg-secondary-100 opacity-75"></div>
            </div>
            <transition
              enter-active-class="animated fadeInDown"
              leave-active-class="animated fadeOutUp"
            >
            <div v-show="modalSearch" class="fixed md:relative inline-block bg-transparent h-full w-full rounded-lg xs:px-3 md:px-16 py-2 overflow-auto md:overflow-hidden transform transition-all" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
              <div class="block absolute top-0 right-0 pt-3 pr-3 md:pr-16">
                <button @click="showModalSearch()" type="button" class="text-white hover:text-gray-100 focus:outline-none transition" aria-label="Close">
                  <!-- Heroicon name: x -->
                  <svg class="h-6 w-6 hover:text-gray-100 focus:text-gray-100 ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <div class="sm:flex sm:items-start my-16 md:my-8 w-full">
                <div class="mt-4 text-center w-full h-full bg-white shadow rounded border-0 my-3 xs:px-4 md:px-32">
                    <div class="relative flex justify-between items-center w-full">
                        <input v-if="inputIsVisible" autofocus id="search" ref="search" type="search" v-model="search" v-on:keyup.enter="searchProduct" class="w-64 md:h-32 border-0 focus:outline-none md:text-2xl" placeholder="Buscar en Pro Proyectos...">
                        <div class="flex-1 flex justify-start items-center p-8 cursor-pointer" v-on:keyup.enter="searchProduct" @click="searchProduct">
                            <div class="absolute">
                                <svg version="1.1" class="h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 52.966 52.966" style="enable-background:new 0 0 52.966 52.966;" xml:space="preserve">
                                    <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
                                    c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
                                    C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
                                    S32.459,40,21.983,40z"/>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            </transition>
          </div>
        </div>
      </transition>

  </div>
</template>
<script>
export default {
  props: { 
    modalSearch: {
      required: true,
      type: Boolean,
      default: false,
    }, 
    showModalSearch: {
      required: true,
      type: Function,
      default: () => {},
    }
  },
  data() {
    return {
      search: '',
      inputIsVisible: false,
    }
  },
  methods: {
    showInput() {
      // Show the input component
      this.inputIsVisible = true;
    },
    searchProduct() {
      window.location.href = `/productos/todas-las-categorias/todas-las-subcategorias/todas-las-marcas?sort_order=ASC&search=${this.search.toUpperCase()}`;
    }
  },
  watch: {
      modalSearch(val) {
          if (val){
            this.showInput();
          }
      }
  },
};
</script>
