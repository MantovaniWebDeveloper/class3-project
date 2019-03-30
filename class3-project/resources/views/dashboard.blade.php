@extends('layout.main')
@section('content')
    @include('header')
    <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: red">Crea nuovo appartamento</a>
    <div id="message_label" class="message"></div>
    @if(!$apartments->isEmpty())
        <h3>Questi sono i tuoi appartamenti</h3>
        @foreach($apartments as $apartment)
            <div data-slug="{{$apartment->slug}}" style="margin:30px;border:1px solid black;border-radius: 5px;padding: 10px;">
                <span>ID</span>
                <h3>{{$apartment->id}}</h3>
                <span>Titolo</span>
                <h3>{{$apartment->title}}</h3>
                <span>Descrizione</span>
                <h3>{{$apartment->description}}</h3>
                <span>Promozioni in corso</span>
                @if(is_null($apartment->end_promo) || \Carbon\Carbon::parse($apartment->end_promo)->lessThan(\Carbon\Carbon::now()))
                    <h3>Nessuna promozione in corso</h3>
                @else
                    <h3>Termina il {{\Carbon\Carbon::parse($apartment->end_promo)->format('d-m-Y H:i')}}</h3>
                @endif
                <a href="{{route('sponsorizza',$apartment->slug)}}" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: green">Sponsorizza</a>
                <button class="button delete_button" data-slug="{{$apartment->slug}}" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: red">Elimina</button>
                <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: blue">Modifica</a>
                <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: yellow">Statistiche</a>
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
    <script src="js/dashboard.js"></script>
@endsection