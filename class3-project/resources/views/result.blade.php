@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
    @include('search')
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
                  <input class="tipoPrezzo" type="checkbox" name="price_range" value="0" >
                  <label for="tipo_prezzo">0 - 50 </label>
                </div>
                <div class="inpuPrezzo">
                  <input class="tipoPrezzo" type="checkbox" name="price_range" value="1">
                  <label for="tipo_prezzo">50 - 100</label>
                </div>
                <div class="inpuPrezzo">
                  <input class="tipoPrezzo" type="checkbox" name="price_range" value="2">
                  <label for="tipo_prezzo">100 - 300</label>
                </div>
            </div>

            <div class="range pl-2 pr-2">
              <label for="formControlRange">Raggio km</label>
              <input type="range" class="barra custom-range" min="10" max="100" step="1" id="customRange2">
            </div>
          </aside>
          <div class="wrapResult">
            @foreach ($apartments as  $appartamento)
                <div class="wrapRisultato">
                  <div class="row ">
                  <div class="col-4 wrap-img">
                    <img class="img-fluid pt-2"src="{{asset("img/")}}/{{$appartamento->images()->first()->path}}" alt="">
                  </div>
                  <div class="col-8">
                    <h5 class="pt-2">{{$appartamento->title}}</h5>
                    <h5>numeri letto: {{$appartamento->bed_count}}</h5>
                    <p>{{ $appartamento->description}}</p>
                    <h3>{{ $appartamento->price}} €</h3>
                    <div class="wrapBtn">
                      <button class="btn btn-danger text-right"type="button" name="button">Descrizione completa</button>
                    </div>
                  </div>
                </div>

              </div>
            @endforeach
        </div>
      </div>
    </div>
</div>

<script src="{{ asset('js/ricercaInterna.js') }}" defer></script>
<script src="{{asset('js/common.js')}}"></script>

@endsection
