@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
  <div class="container">
    @include('searchInterno')
    <h4>Filtra per :</h4>

    <h4>Includi anche :</h4>
    <div class="row">
      <div class="col-3">
        <input type="checkbox" name="service" ><label class="nomiCheck">Parcheggio</label>
      </div>
      <div class="col-3">
        <input type="checkbox" name="service"><label class="nomiCheck">Wi-fi</label>
      </div>
      <div class="col-3">
        <input type="checkbox" name="service"> <label class="nomiCheck">Cancellazione gratuita</label>
      </div>
      <div class="col-3">
        <input type="checkbox" name="service"><label class="nomiCheck">Piscina</label>
      </div>
    </div>
    @php
  //   dd($apartments);
    @endphp

    <div class="row wrapRisultato">
          <div class="wrapImg col-4">
            <img class="img-fluid" src="" alt="">
          </div>
          <div class="wrapDescrizione col-8">
              <h4>Nome appartamento</h4>
              <p><i class="fas fa-map-marker-alt"></i>localita</p>
              <p>descrizione</p>
              <p>numeri letti</p>
              <button type="button" name="button">Descrzione completa ></button>
          </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/chiamataApiCitta.js') }}" defer></script>
<script src="{{ asset('js/ricercaInterna.js') }}" defer></script>

@endsection
