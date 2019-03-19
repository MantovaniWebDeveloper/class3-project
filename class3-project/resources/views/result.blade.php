@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
  <div class="container">
    @include('search')
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
    <div class="row wrapRisultato">
          <div class="wrapImg col-4">
            <img class="img-fluid" src="" alt="">
          </div>
          <div class="wrapDescrizione col-8">

          </div>
    </div>
  </div>
</div>
@endsection
