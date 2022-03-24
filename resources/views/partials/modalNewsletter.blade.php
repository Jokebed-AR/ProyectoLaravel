{{--<transition--}}
  {{--enter-active-class="animated fadeIn"--}}
  {{--leave-active-class="animated fadeOut"--}}
{{-->--}}
    {{--<div  id="modalNewsletter{{$modalNewsletter->id}}" class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">--}}
      {{--<div class="flex items-center justify-center pt-4 px-4 text-center sm:block sm:p-0">--}}
        {{--<div class="fixed inset-0 transition-opacity">--}}
          {{--<div class="{{$index == 0 ? 'absolute inset-0 bg-black opacity-75': ''}}" @click="closeNewsletterById({{$modalNewsletter->id}})"></div>--}}
        {{--</div>--}}
        {{--<transition--}}
          {{--enter-active-class="animated fadeInDown"--}}
          {{--leave-active-class="animated fadeOutUp"--}}
        {{-->--}}
        {{--<div  class="inline-block align-bottom bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">--}}
          {{--<div class="block absolute top-0 right-0 pt-4 pr-4">--}}
            {{--<button @click="closeNewsletterById({{$modalNewsletter->id}})" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" aria-label="Close">--}}
              {{--<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">--}}
                {{--<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
              {{--</svg>--}}
            {{--</button>--}}
          {{--</div>--}}
          {{-- <div class="absolute bottom-0 left-0 pt-4 pl-8 block">--}}
            {{--<input type="checkbox" id="not-show" name="not-show" value="show">--}}
            {{--<label for="not-show" class="text-white"> No volver a mostrar</label><br><br>--}}
          {{--</div> --}}
          {{--@php--}}
            {{--$black = true;--}}
            {{--if($modalNewsletter->title != null){--}}
              {{--$black = false;--}}
            {{--}--}}
            {{--if($modalNewsletter->description != null){--}}
              {{--$black = false;--}}
            {{--}--}}
            {{--if($modalNewsletter->button_text != null){--}}
              {{--$black = false;--}}
            {{--}--}}
          {{--@endphp--}}


          {{--<div class="flex flex-col justify-between items-center p-16 {{$black ? 'md:p-40' : 'md:p-32'}} catalog-width bg-newsletter {{$black}}"--}}
          {{--style="background:  linear-gradient(rgba(0,0,0,.3),rgba(0,0,0,.3)) ,url('{{$modalNewsletter->getImage()}}')">--}}
            {{--<div class="mt-3 text-center">--}}
              {{--@if($modalNewsletter->title != null)--}}
                {{--<h2 class="text-2xl md:text-2xl text-white uppercase mb-3">--}}
                  {{--{{ $modalNewsletter->title }}--}}
                {{--</h2>--}}
              {{--@endif--}}

              {{--@if($modalNewsletter->description != null)--}}
                {{--<h2 class="text-lg md:text-xl text-white uppercase mb-3">--}}
                  {{--{{ $modalNewsletter->description }}--}}
                {{--</h2>--}}
              {{--@endif--}}

                  {{--@if($modalNewsletter->button_text != null)--}}
                      {{--<div class="flex justify-center items-center ">--}}
                          {{--<a aria-label="Button submit Newsletter" href="{{$modalNewsletter->button_redirect}}" class="flex text-center cursor-pointer justify-center items-center px-8 py-1 rounded-full text-lg font-bold text-whiteSmoke-100 hover:border-transparent hover:text-white hover:bg-primary hover:no-underline transition duration-300 ease-in-out bg-secondary-100">--}}
                              {{--{{$modalNewsletter->button_text}}--}}
                          {{--</a>--}}
                      {{--</div>--}}
                  {{--@endif--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
        {{--</transition>--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</transition>--}}