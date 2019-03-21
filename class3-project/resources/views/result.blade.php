@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
    @include('searchInterno')
    <div class="wrapAll">
      <div class="container">
        <div class="wrapAllInterno">
          <aside>
            <h4 class="pt-2 pl-2">Filtri per servizi clienti:</h4>
            <hr>
            <div class="wrapServizi pt-2 pl-2">
              <div class="inpuServizi">
                <input class="largo" type="checkbox" name="" value="wifi">
                <label for="wifi">wifi</label>
              </div>
              <div class="inpuServizi">
                <input class="" type="checkbox" name="" value="wifi">
                <label for="wifi">parcheggio</label>
              </div>
              <div class="inpuServizi">
                <input class="" type="checkbox" name="" value="wifi">
                <label for="wifi">piscina</label>
              </div>
              <div class="inpuServizi">
                <input class="" type="checkbox" name="" value="wifi">
                <label for="wifi">sky</label>
              </div>
            </div>
            <div class="range pl-2 pr-2">
              <label for="formControlRange">Raggio km</label>
    <input type="range" class="form-control-range" id="formControlRange">
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

@endsection
