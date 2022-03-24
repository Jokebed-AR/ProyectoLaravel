@extends('layouts.website', [$clasifications, $brands])

@section('content')

  <section id="home" class="bg-cover bg-center object-cover bg-no-repeat bg-home">
    <div class="container mx-auto h-screen pt-16 flex flex-col justify-center items-center">
      <img src="/img/tecnotanques/404.jpg" alt="404 error">
      <h1 class="text-black leading-tight tracking-wide text-xl md:text-6xl text-center uppercase">Oops.. <span class="text-sm md:text-2xl uppercase"> pagina no encontrada</span>   </h1>
      <h1 class="text-black leading-tight md:text-7xl text-center uppercase">Algo Salio Mal</h1>

      <h1 class="text-black leading-tight text-xl md:text-2xl text-center f-m mt-2">Prueba suerte con estos links</h1>
      @foreach ($clasifications as $clasification)
        @if($loop->index % 2 == 0)
          <a href="/productos/{{$clasification->name}}" class="text-secondary-100 leading-tight text-xl md:text-2xl f-m font-extrabold mt-3 uppercase">
              {{$clasification->name}}
          </a>
        @else 
          <a href="/productos/{{$clasification->name}}" class="text-primary leading-tight text-xl md:text-2xl f-m font-extrabold mt-2 uppercase">
              {{$clasification->name}}
          </a>
        @endif
      @endforeach
    </div>
  </section>

@endsection



