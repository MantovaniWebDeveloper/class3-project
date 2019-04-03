@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
    @include('search')
    <div class="modalLoading text-center">
      <i class="fas fa-circle-notch fa-spin"></i>
    </div>
      <div class="wrapAll">
        <div class="container">
          <div class="wrapAllInterno">
            <aside>
              <h4 class="pt-2 pl-2">Filtri per servizi clienti:</h4>

              <hr>
              <div class="wrapServizi pt-2 pl-2">
                @foreach ($services as  $servizio)
                  <div class="inpuServizi">
                    <input class="servizio largo" type="checkbox" name="services" value="{{$servizio->id}}">
                    <label for="{{$servizio->name}}">{{$servizio->name}}</label>
                  </div>
                @endforeach
              </div>
              <h4 class="pt-2 pl-2">Odinamento:</h4>
              <div class="wrapOrdinamento pt-2 pl-2">
                  <div class="inpuOrdinamento">
                    <input class="ordinamento" type="radio" name="order_type" value="distance" checked>
                    <label for="distanza">distanza</label>
                  </div>
                  <div class="inpuOrdinamento">
                    <input class="ordinamento" type="radio" name="order_type" value="price">
                    <label for="distanza">prezzo</label>
                  </div>
              </div>
              <h4 class="pt-2 pl-2">Prezzi :</h4>
              <div class="wrapOrdinamento pt-2 pl-2">
                  <div class="inpuPrezzo">
                    <input class="tipoPrezzo" type="checkbox" name="price_range" value="1" >
                    <label for="tipo_prezzo">0 - 50 </label>
                  </div>
                  <div class="inpuPrezzo">
                    <input class="tipoPrezzo" type="checkbox" name="price_range" value="10">
                    <label for="tipo_prezzo">50 - 100</label>
                  </div>
                  <div class="inpuPrezzo">
                    <input class="tipoPrezzo" type="checkbox" name="price_range" value="100">
                    <label for="tipo_prezzo">100 - 300</label>
                  </div>
              </div>

              <div class="range pl-2 pr-2">
                <label for="formControlRange">Raggio km</label>
                <input type="range" class="barra custom-range" min="10" max="100" step="1" id="customRange2">
              </div>
            </aside>
            <div class="wrapResult">
              <h3>Risultati per la ricerca su : </h3>
              @foreach ($apartments as  $appartamento)
                  <div class="wrapRisultato">
                    <div class="row">
                    <div class="col-4 wrap-img">
                      <img class="img-fluid pt-2"src="{{asset("img/")}}/{{$appartamento->images()->first()->path}}" alt="">
                    </div>
                    <div class="col-8">
                      <a></a><h3 class="pt-2">{{$appartamento->title}}</h3>
                      <p><i class="fas fa-map-marker-alt pr-2 "></i>{{$appartamento->address['streetName']}} {{$appartamento->address['postal_code']}} {{$appartamento->address['municipality']}} - {{$appartamento->address['province']}}</p>
                      <h5>numeri letto: {{$appartamento->bed_count}}</h5>
                      <p>{{ $appartamento->description}}</p>
                      <h3>{{ $appartamento->price}} €</h3>
                      <div class="wrapBtn">
                        <a href="{{ route("appartamento",$appartamento->slug)}}"><button class="btn btn-danger text-right"type="button" name="button">Descrizione completa</button></a>
                      </div>
                    </div>
                  </div>

                </div>
              @endforeach
          </div>
        </div>
      </div>

</div>

<!-- ZONA HANDLEBARS!!!-->
<script id="resultAjax-template" type="text/x-handlebars-template">
  @{{#each this}}
  <div class="wrapRisultato">
    <div class="row">
    <div class="col-4 wrap-img">
      <img class="img-fluid pt-2"src="" alt="">
    </div>
    <div class="col-8">
      <h3 class="pt-2">@{{title}}</h3>
      <p><i class="fas fa-map-marker-alt pr-2 "></i></p>
      <h5>numeri letto: @{{bed_count}}</h5>
      <p>@{{description}}</p>
      <h3>@{{price}} €</h3>
      <div class="wrapBtn">
        <a href="{{ route("appartamento",$appartamento->slug)}}"><button class="btn btn-danger text-right"type="button" name="button">Descrizione completa</button></a>
    </div>
  </div>
</div>
  @{{/each}}
</script>

<script src="{{ asset('js/ricercaInterna.js') }}" defer></script>
<script src="{{asset('js/common.js')}}"></script>

@endsection
