<transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut" >
    <div v-show="modalForm" id="{{$visible}}" class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-start md:justify-center">
      <div class="flex items-center justify-center pt-4 px-4 text-center overflow-y-auto mt-30vh md:mt-0">
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-black opacity-75" @click="close()"></div>
        </div>
        <transition enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutUp" >
          <div
            v-show="modalForm"
            class="bg-white 
            rounded-lg 
            text-left 
            shadow-xl 
            transform 
            transition-all 
            sm:max-w-lg 
            w-full 
            md:w-auto
            p-6
            xl:px-16"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
          >
            @yield('closeSection')
            @yield('contentModal')
          </div>
        </transition>
      </div>
        {{-- @include('layouts.GoogleReCaptchaJSForBlade')  --}}
    </div>
</transition>