@extends('layout.main')
@section('content')
    @include('header')
    <div id="apartment_dashboard" class="container">
      <div class="row">
        <div class="col-12 pt-5">
          <a class="btn btn-primary" href="{{route('nuovo')}}">Crea nuovo appartamento</a>
          <div id="message_label" class="message"></div>
          <h3>Dashboard appartamenti</h3>
        </div>
      </div>
    @if(!$apartments->isEmpty())
        @foreach($apartments as $apartment)
            <div class="apartment" data-slug="{{$apartment->slug}}">
              <div class="row">
                <div class="col-4 p-2">
                  <img src="{{asset("img/".$apartment->images->first()->path)}}" alt="">
                </div>
                <div class="col-8 p-2">
                  <span>Nome Appartamento</span>
                  <h3>{{$apartment->title}}</h3>
                  <span>Descrizione</span>
                  <h3>{{$apartment->description}}</h3>
                  <span>Promozioni in corso</span>
                </div>
              </div>
                @if(is_null($apartment->end_promo) || \Carbon\Carbon::parse($apartment->end_promo)->lessThan(\Carbon\Carbon::now()))
                    <h3>Nessuna promozione in corso</h3>
                @else
                    <h3>Termina il {{\Carbon\Carbon::parse($apartment->end_promo)->format('d-m-Y H:i')}}</h3>
                @endif
                <a class="btn btn-success" href="{{route('sponsorizza',$apartment->slug)}}">Sponsorizza</a>
                <a class="btn btn-warning" href="{{route('modifica', ['slug'=>$apartment->slug])}}">Modifica</a>
                <a class="btn btn-secondary" href="{{route('statistiche', ['slug'=>$apartment->slug])}}">Statistiche</a>
                <button class="button delete_button btn btn-danger ml-4" data-slug="{{$apartment->slug}}">Elimina</button>
                <p>Modifica visibilità annuncio</p>
                <div class="mytoggle">
                    <div class="mytoggle_state off_state{{(!$apartment->is_showed)?' active':null}}">OFF</div>
                    <div class="mytoggle_state standby_state">WAIT</div>
                    <div class="mytoggle_state on_state{{($apartment->is_showed)?' active':null}}">ON</div>
                </div>
            </div>
        @endforeach
    @else
        <h3>non hai un cavolo di appartamento, morto di fame</h3>
    @endif
  </div>
    <script src="js/dashboard.js"></script>
    <script src="js/common.js"></script>
@endsection
