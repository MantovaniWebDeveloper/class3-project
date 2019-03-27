@extends('layout.main')
@section('content')
    @include('header')
    <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: red">Crea nuovo appartamento</a>
    @if(!$apartments->isEmpty())
        <h3>Questi sono i tuoi appartamenti</h3>
        @foreach($apartments as $apartment)
            <div style="margin:30px;border:1px solid black;border-radius: 5px;padding: 10px;">
                <span>Titolo</span>
                <h3>{{$apartment->title}}</h3>
                <span>Descrizione</span>
                <h3>{{$apartment->description}}</h3>
                <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: green">Sponsorizza</a>
                <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: red">Elimina</a>
                <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: blue">Modifica</a>
                <a href="" style="padding: 10px; border: 1px solid black;border-radius: 5px;margin: 10px;display: inline-block;background-color: yellow">Statistiche</a>
                <div class="mytoggle">
                    <div data-slug="{{$apartment->slug}}" class="mytoggle_state off_state{{(!$apartment->is_showed)?' active':null}}">OFF</div>
                    <div data-slug="{{$apartment->slug}}" class="mytoggle_state standby_state">WAIT</div>
                    <div data-slug="{{$apartment->slug}}" class="mytoggle_state on_state{{($apartment->is_showed)?' active':null}}">ON</div>
                </div>
            </div>
        @endforeach
    @else
        <h3>non hai un cavolo di appartamento, morto di fame</h3>
    @endif
    <script src="js/app.js"></script>
    <script src="js/dashboard.js"></script>
@endsection