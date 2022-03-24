<!doctype html>
<html lang="en">
<head>

    @include('layouts.socialMediaCodes')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/img/FavIcon.png" rel="shortcut icon" type="image/x-icon">
    <meta name="facebook-domain-verification" content="wcnfd7aokwbzakjfqa5aij9sekiotx" />
    
    {{--<link rel="preload" href="/fonts/Oswald/static/Oswald-Regular.ttf" as="font">--}}
    {{-- <link rel="preload" href="/css/app.css" as="style" onload="this.onload=null;this.rel='stylesheet'"> --}}
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/table.css">
    <link rel="stylesheet" href="/css/carousel.css">
    @include('layouts.GoogleTagManager')
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="dns-prefetch" href="//google-analytics.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//ssl.google-analytics.com">
    <link rel="dns-prefetch" href="//connect.facebook.net">

    @if(Request::url() !== env('APP_URL'))
        @include('layouts.GoogleReCaptchaJSForBlade')
    @endif
    {!! SEO::generate() !!}
</head>

<body>
    @include('layouts.GoogleTagManagerNoScript')
    <div id="app" v-scroll="scrollFunction">
        <navbar :clasifications="{{$clasifications}}" :categories="{{$categoriesNavbar}}" :brands="{{$brands}}"></navbar>
        @yield('content')
        <!-- @if(isset($modalNewsletters))
            @if(count($modalNewsletters) > 0)
                @foreach($modalNewsletters as $index => $modalNewsletter)
                    @include('partials.modalNewsletter', compact('modalNewsletter', 'index'))
                @endforeach
            @endif
        @endif -->
        @if($catalog != null)
            @include('partials.modalformCatalog', compact('catalog'))
            <div class="float-catalog cursor-pointer" @click="showModalCatalog">
                <button
                id="catalog"
                aria-label="Catalog Button"
                class="catalog-button"
                >
                    <svg width="30.667px" height="30.667px" viewBox="0 0 64 64" fill="white" stroke="white">
                        <path d="m62.41 10.088-20-9c-.261-.117-.56-.117-.82 0l-19.59 8.815-19.59-8.815c-.308-.138-.668-.111-.953.072-.285.185-.457.501-.457.84v51c0 .394.231.75.59.912l20 9c.261.117.56.117.82 0l19.59-8.815 19.59 8.815c.131.059.27.088.41.088.19 0 .379-.054.543-.16.285-.185.457-.501.457-.84v-51c0-.394-.231-.75-.59-.912zm-39.41 1.559 18-8.1v48.807l-18 8.1zm-20-8.101 18 8.1v48.807l-18-8.1zm58 56.908-18-8.1v-48.807l18 8.1z"/>
                        <path d="m18.385 13.077-12-5c-.31-.129-.662-.096-.939.091-.279.186-.446.498-.446.832v13c0 .404.243.768.615.923l12 5c.124.052.255.077.385.077.194 0 .388-.057.555-.168.278-.186.445-.498.445-.832v-13c0-.404-.243-.768-.615-.923zm-1.385 12.423-10-4.167v-10.833l10 4.167z"/>
                        <path d="m11 23h2v13h-2z" transform="matrix(.385 -.923 .923 .385 -19.846 29.231)"/><path d="m11 28h2v13h-2z" transform="matrix(.385 -.923 .923 .385 -24.462 32.308)"/>
                        <path d="m11 33h2v13h-2z" transform="matrix(.385 -.923 .923 .385 -29.077 35.385)"/><path d="m11 38h2v13h-2z" transform="matrix(.385 -.923 .923 .385 -33.692 38.462)"/>
                        <path d="m38.555 36.168c-.277-.187-.63-.22-.939-.091l-12 5c-.373.155-.616.519-.616.923v13c0 .334.167.646.445.832.167.111.36.168.555.168.13 0 .261-.025.385-.077l12-5c.372-.155.615-.519.615-.923v-13c0-.334-.167-.646-.445-.832zm-1.555 13.165-10 4.167v-10.833l10-4.167z"/>
                        <path d="m25.5 33.5h13v2h-13z" transform="matrix(.923 -.385 .385 .923 -10.812 14.971)"/>
                        <path d="m25.5 28.5h13v2h-13z" transform="matrix(.923 -.385 .385 .923 -8.888 14.586)"/>
                        <path d="m25.5 23.5h13v2h-13z" transform="matrix(.923 -.385 .385 .923 -6.964 14.201)"/>
                        <path d="m25.5 18.5h13v2h-13z" transform="matrix(.923 -.385 .385 .923 -5.04 13.816)"/>
                        <path d="m45.615 22.923 12 5c.124.052.255.077.385.077.194 0 .388-.057.555-.168.278-.186.445-.498.445-.832v-13c0-.404-.243-.768-.615-.923l-12-5c-.309-.129-.661-.096-.939.091-.279.186-.446.498-.446.832v13c0 .404.243.768.615.923zm1.385-12.423 10 4.167v10.833l-10-4.167z"/>
                        <path d="m51 23h2v13h-2z" transform="matrix(.385 -.923 .923 .385 4.769 66.154)"/>
                        <path d="m51 28h2v13h-2z" transform="matrix(.385 -.923 .923 .385 .154 69.231)"/>
                        <path d="m51 33h2v13h-2z" transform="matrix(.385 -.923 .923 .385 -4.462 72.308)"/>
                        <path d="m51 38h2v13h-2z" transform="matrix(.385 -.923 .923 .385 -9.077 75.385)"/>
                    </svg>
                </button>
                <span>
                    Descargar <br>
                    Catálogo
                </span>
            </div>
        @endif
        @include('layouts.helperButtons')
        @include('layouts.footer', compact('clasifications', 'brands'))
    </div>
    <script async src="{{asset('js/app.js')}}"></script>
    <script async defer>
        setTimeout(function()
        {
            var Tawk_API=Tawk_API||{},Tawk_LoadStart=new Date;!function(){var e=document.createElement("script"),t=document.getElementsByTagName("script")[0];e.async=!0,e.src="https://embed.tawk.to/606f3ae4f7ce182709386fc2/1f2p7s388",e.charset="UTF-8",e.setAttribute("crossorigin","*"),e.setAttribute("defer", "defer"),t.parentNode.insertBefore(e,t)}();
        },8000);
    </script>
    <script>!function(e){"function"==typeof define&&define.amd?define(e):e()}(function(){var e,t=["scroll","wheel","touchstart","touchmove","touchenter","touchend","touchleave","mouseout","mouseleave","mouseup","mousedown","mousemove","mouseenter","mousewheel","mouseover"];if(function(){var e=!1;try{var t=Object.defineProperty({},"passive",{get:function(){e=!0}});window.addEventListener("test",null,t),window.removeEventListener("test",null,t)}catch(e){}return e}()){var n=EventTarget.prototype.addEventListener;e=n,EventTarget.prototype.addEventListener=function(n,o,r){var i,s="object"==typeof r&&null!==r,u=s?r.capture:r;(r=s?function(e){var t=Object.getOwnPropertyDescriptor(e,"passive");return t&&!0!==t.writable&&void 0===t.set?Object.assign({},e):e}(r):{}).passive=void 0!==(i=r.passive)?i:-1!==t.indexOf(n)&&!0,r.capture=void 0!==u&&u,e.call(this,n,o,r)},EventTarget.prototype.addEventListener._original=e}});</script>

    <script async src="/js/carousel.js"></script>

</body>
</html>
