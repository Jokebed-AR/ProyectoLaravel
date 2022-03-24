@extends('layouts.website', [$clasifications, $brands])

@section('content')

  <section id="home" class="bg-cover bg-center object-cover bg-no-repeat bg-home">
    <div class="container mx-auto h-screen pt-16 flex flex-col justify-center items-center">
      <img src="/img/tecnotanques/agradecimiento-04.png" alt="Agradecimiento 1">
      <div class="flex justify-center items-center space-x-2">
        <a href="https://www.facebook.com/TanquesTinacosyCisternas" target="_blank">
            <img src="/img/tecnotanques/agradecimiento-05.png" alt="Agradecimiento 2">
        </a>
        <a href="https://www.youtube.com/channel/UCZsjReLuEVueve__GD6I8Yw/featured" target="_blank">
            <img src="/img/tecnotanques/agradecimiento-06.png" alt="Agradecimiento 3">
        </a>
        <a href="https://twitter.com/ProProyectos" target="_blank">
            <img src="/img/tecnotanques/agradecimiento-07.png" alt="Agradecimiento 4">
        </a>
        <a href="https://www.linkedin.com/company/15077283/admin/" target="_blank">
            <img src="/img/tecnotanques/agradecimiento-08.png" alt="Agradecimiento 5">
        </a>
      </div>
    </div>
  </section>

@endsection



