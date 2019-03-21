@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
    @include('searchInterno')
    <div class="wrapAll">
      <div class="container">
        <div class="wrapAllInterno">
          <aside>

          </aside>
          <div class="wrapResult">
            @foreach ($apartments as  $appartamento)
                <div class="wrapRisultato">
                  <div class="row ">
                  <div class="col-4 wrap-img">
                    <img class="img-fluid"src="{{asset("img/")}}/{{$appartamento->images()->first()->path}}" alt="">
                  </div>
                  <div class="col-8">
                    <h5>{{$appartamento->title}}</h5>
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
